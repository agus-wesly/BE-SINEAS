<?php

namespace App\Services\User;

use App\Repository\User\IUserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

    public function getUserByEmail(string $email): object|null
    {
        try {
            return $this->userRepository->getByEmail($email);
        }catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'a server error occurred'
            ]);
        }
    }


    public function editUser(array $request, string $id): void
    {
        $user = $this->userRepository->getUserById($id);
        $this->userRepository->updateUser($request, $user);
    }

    public function addUser(array $data)
    {
        try {
            $data['password'] = Hash::make($data['password']);
            $data['role_id'] = 2;
            return $this->userRepository->createUser($data);
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'a server error occurred'
            ]);
        }
    }

    public function getCurrentUser()
    {
        try {
            return auth()->user();
        } catch (\Exception $e) {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'a server error occurred'
            ]);
        }
    }

    public function updateUser(array $data, string $id)
    {
        try {
            $user = $this->userRepository->getUserById($id);
//            $data['password'] = Hash::make($data['password']);
            return $this->userRepository->updateUser($data, $user);
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => 'a server error occurred'
            ]);
        }
    }

}
