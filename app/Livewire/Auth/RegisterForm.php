<?php

namespace App\Livewire\Auth;

use App\Http\Controllers\Auth\AuthController;
use Livewire\Component;

class RegisterForm extends Component
{
    public $email;
    public $password;
    public $name;
    public $roles = 'user';

    public function render()
    {
        return view('livewire.auth.register-form');
    }

    public function register()
    {
        $credentials = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->roles,
        ];

        $response = app(AuthController::class)->register($credentials);
    }
}
