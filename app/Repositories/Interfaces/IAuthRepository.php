<?php

namespace App\Repositories\Interfaces;

interface IAuthRepository{
    public function createUser(array $data);
    public function findUserByEmail(string $email);
}