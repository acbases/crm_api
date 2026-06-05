<?php

namespace App\Http\Controllers;
use Laravel\Sanctum\HasApiTokens;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAllUsers()
    {
        return response()->json(
            $this->userService->all()
        );
    }

    public function getUser($id)
    {
        return response()->json(
            $this->userService->find($id)
        );
    }

    public function createUser(Request $request)
    {
        $user = $this->userService->create(
            $request->all()
        );

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = $this->userService->login($credentials);

        if ($user) {
            // $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                // 'token' => $token,
                // 'token_type' => 'Bearer'
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }
}
