<?php

namespace App\Repository\User;

use App\Models\User;

interface IUserRepository
{
    public function allUser();
    public function getByEmail(string $email);
    public function getUserById(string $id);
    public function updateUser(array $data, User $user);
    public function createUser(array $data);
}
