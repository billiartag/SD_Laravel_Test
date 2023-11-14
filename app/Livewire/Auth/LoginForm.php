<?php

namespace App\Livewire\Auth;

use App\Http\Controllers\Auth\AuthController;
use Livewire\Component;

class LoginForm extends Component
{
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.auth.login-form');
    }

    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        $response = app(AuthController::class)->login($credentials);
    }
}
