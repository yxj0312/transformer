<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{
    public function login(User $user, string $password): User
    {
        // Attempt to login the user
        if (!Auth::attempt(['email' => $user->email, 'password' => $password])) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }

        // If login successful, retrieve the authenticated user
        return Auth::user();
    }
}