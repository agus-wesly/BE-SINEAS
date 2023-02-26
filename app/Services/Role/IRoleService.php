<?php

namespace App\Services\Role;

interface IRoleService
{
    public function getAllRole(): object;
    public function getRoleById(int $roleId): object;
    public function createRole(array $data): void;
    public function updateRole(array $data, int $roleId): void;
    public function deleteRole(int $roleId): void;
}
