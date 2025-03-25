<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IAuthRepository;
use App\Models\User;

class AuthRepository implements AuthRepositoryInterface
{
    public function createUser(array $data)
    {
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role'],
        ]);
    }
}
