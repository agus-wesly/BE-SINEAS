<?php

namespace App\Services\Role;

interface IRoleService
{
    public function getAllRole(): object;
    public function getRoleById(int $roleId): object;
    public function createRole(array $data): bool;
    public function updateRole(array $data, int $roleId): bool;
    public function deleteRole(int $roleId): bool;
}
