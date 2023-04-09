<?php

namespace App\Repository\User;

use App\DataTransferObjects\ResetPasswordDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function allUser()
    {
        return $this->user->all();
    }

    public function getByEmail(string $email)
    {
        return $this->user->where('email', $email)->first();
    }


    public function getUserById(string $id)
    {
        return $this->user->findOrFail($id);
    }

    public function updateUser(array $data, User $user)
    {
        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
    }

    public function createUser(array $data)
    {
       return $this->user->create($data);
    }

    public function saveToken(ResetPasswordDto $dto)
    {
        try {
            \DB::table('password_reset_tokens')
                ->updateOrInsert(['email' => $dto->email],[
                    'email' => $dto->email,
                    'token' => Hash::make($dto->token),
                    'created_at' => now()
                ]);
        } catch (\Exception $e)
        {
            report($e);
            throw new \Exception('a server error occurred');
        }
    }


}
