<?php

namespace App\Services\User;

interface IUserService
{
    public function getAllUser(): object|null;
    public function getUserByEmail(string $email): object|null;
    public function editUser(array $request, string $id): void;
    public function addUser(array $data);
    public function updateUser(array $data, string $id);
}
