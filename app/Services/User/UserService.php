<?php

namespace App\Services\User;

use App\DataTransferObjects\ResetPasswordDto;
use App\Repository\User\IUserRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

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

    public function forgetPassword(string $email): void
    {
        try {
            $user = $this->userRepository->getByEmail($email);

            if (!$user) {
                throw new \Exception('user not found');
            }

            $token = $user->createToken('token', ['auth'])->plainTextToken;
            $this->userRepository->saveToken(ResetPasswordDto::createToken($user->email, $token));
            $user->sendPasswordResetNotification($token);
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function resetPassword($request)
    {
        try {
           return Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password)
                    ])->save();

                    $user->tokens()->delete();

                    event(new PasswordReset($user));
                }
            );
        } catch (\Exception $e)
        {
            report($e);
            throw ValidationException::withMessages([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getUserByToken(string $token = null): string|null
    {
        if ($token) {
            $personalAccessToken = PersonalAccessToken::findToken($token);
//            dd(!$personalAccessToken->created_at->addSeconds($personalAccessToken->expires_at)->isPast());
            if ($personalAccessToken) {
                return $personalAccessToken->tokenable_id;
            }
        }

        return null;
    }


}
