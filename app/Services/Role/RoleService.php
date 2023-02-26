<?php

namespace App\Services\Role;

use App\Repository\Role\IRoleRepository;

class RoleService implements IRoleService
{
    private IRoleRepository $roleRepository;

    /**
     * @param IRoleRepository $roleRepository
     */
    public function __construct(IRoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }


    public function getAllRole(): object
    {
       return $this->roleRepository->allRole();
    }

    public function getRoleById(int $roleId): object
    {
        try {
            return $this->roleRepository->roleById($roleId);
        } catch (\Exception $e) {
            report($e);
            throw new \Exception($e->getMessage());
        }
    }

    public function createRole(array $data): bool
    {
        try {
            $this->roleRepository->create($data);
        } catch (\Exception $e) {
            report($e);
            return 1;
            throw new \Exception($e->getMessage());
        }
    }

    public function updateRole(array $data, int $roleId): bool
    {
        try {
            $this->roleRepository->update($data, $roleId);
        } catch (\Exception $e) {
            report($e);
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteRole(int $roleId): bool
    {
        try {
            $this->roleRepository->delete($roleId);
        } catch (\Exception $e) {
            report($e);
            throw new \Exception($e->getMessage());
        }
    }
}
