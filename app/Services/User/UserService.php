<?php

namespace App\Services\User;

use App\Repository\User\IUserRepository;

class UserService implements IUserService
{
    private IUserRepository $userRepository;

    /**
     * @param IUserService $userService
     */
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function getAllUser(): object|null
    {
        return $this->userRepository->allUser();
    }

    public function editUser(array $request, string $id): void
    {
        $user = $this->userRepository->getUserById($id);
        $this->userRepository->updateUser($request, $user);
    }
}
