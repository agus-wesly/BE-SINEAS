<?php

namespace App\Services\User;

interface IUserService
{
    public function getAllUser(): object|null;
    public function getUserByEmail(string $email): object|null;
    public function editUser(array $request, string $id): void;
    public function getCurrentUser();
    public function addUser(array $data);
    public function updateUser(array $data, string $id);
    public function forgetPassword(string $email): void;
    public function resetPassword($request);
    public function getUserByToken(string $token): string|null;
}
