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
}
