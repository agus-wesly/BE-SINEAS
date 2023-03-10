<?php

namespace App\Repository\User;

use App\Models\User;

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
}
