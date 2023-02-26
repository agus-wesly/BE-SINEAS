<?php

namespace App\Services\Role;

interface IRoleService
{
    public function getAllRole(): object;
    public function getRoleById(int $roleId): object;
    public function createRole(array $data): bool|null;
    public function updateRole(array $data, int $roleId): bool|null;
    public function deleteRole(int $roleId): bool|null;
}
