<?php

namespace App\Repository\Role;

interface IRoleRepository
{
    public function allRole(): object;
    public function roleById(int $roleId): object;
    public function create(array $data): void;
    public function update(array $data, int $roleId): void;
    public function delete(int $roleId): void;
}
