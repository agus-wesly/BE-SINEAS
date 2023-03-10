<?php

namespace App\Services\User;

interface IUserService
{
    public function getAllUser(): object|null;
    public function editUser(array $request, string $id): void;
}
