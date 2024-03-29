<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Services\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected UserRepositoryInterface $userRepository;
    protected AuthServiceInterface $authService;

    public function __construct(UserRepositoryInterface $userRepository, AuthServiceInterface $authService)
    {
        $this->userRepository = $userRepository;
        $this->authService = $authService;
    }
    
    public function register(RegisterRequest $request): JsonResponse
    {
        // Validate the user
        $validatedData = $request->validated();

        // Hash the password
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Create the user
        $user = $this->userRepository->create($validatedData);

        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return the user and token
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        // Validate the user
        $credentials = $request->validated();

        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }

        // Attempt login using AuthService
        $authenticatedUser = $this->authService->login($user, $credentials['password']);

        // Create token
        $token = $authenticatedUser->createToken('auth_token')->plainTextToken;

        // Return the user and token
        return response()->json([
            'user' => $authenticatedUser,
            'token' => $token,
        ], Response::HTTP_OK);
    }
}
