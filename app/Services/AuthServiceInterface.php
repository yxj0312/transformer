<?php

namespace App\Services;

use App\Models\User;

interface AuthServiceInterface
{
    /**
     * Attempt to login the user
     *
     * @param User $user
     * @param string $password
     * @return User
     */
    public function login(User $user, string $password): User;
}