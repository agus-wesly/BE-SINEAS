<?php

namespace App\Repository\Role;

use App\Models\Role;

class RoleRepository implements IRoleRepository
{
    private Role $role;

    /**
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }


    public function allRole(): object
    {
        return $this->role->all();
    }

    public function roleById(int $roleId): object
    {
        return $this->role->findOrFail($roleId);
    }

    public function create(array $data): void
    {
        $this->role->create($data);
    }

    public function update(array $data, int $roleId): void
    {
        $this->role->findOrFail($roleId)->update($data);
    }

    public function delete(int $roleId): void
    {
        $this->role->findOrFail($roleId)->delete();
    }
}
