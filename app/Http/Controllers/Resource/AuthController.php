<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponseHelpers;

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if ($email == null || $password == null) {
            return $this->respondUnAuthenticated('Email atau password tidak tersedia!');
        }
        $user = User::where('email', $email)->first();
        if ($user == null) {
            return $this->respondNotFound('Tidak ada user!');
        } else {
            if (Hash::check($password, $user->password)) {

                return $this->respondWithSuccess([
                    'message' => 'Sukses',
                    'token' => $user->createToken('login')->plainTextToken,
                ]);
            } else {

                return $this->respondUnAuthenticated('Password tidak sesuai!');
            }
        }
    }

    public function logout()
    {
        $user = auth('sanctum')->user();
        $result = $user->currentAccessToken()->delete();

        if ($result) {

            return $this->respondWithSuccess([
                'message' => 'Sukses',]);
        } else {

            return $this->respondError('Sistem gagal untuk logout');
        }


    }

    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');

        if ($email == null || $password == null || $name == null || $role == null) {
            return $this->respondUnAuthenticated('Data tidak lengkap!');
        }
        $validator = Validator::make($request->all(),

            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'role' => 'in:user,admin',
            ]
        );
        if ($validator->fails()) {
            return $this->respondFailedValidation('Gagal membuat user, format data tidak seesuai!');
        } else {
            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->role = $role;

            if (!$user->save()) {
                return $this->respondError('Gagal membuat user, gunakan email lain!');
            } else {
                return $this->respondCreated([
                    'message' => 'Sukses',
                    'token' => $user->createToken('login')->plainTextToken,
                ]);
            }
        }


    }
}
