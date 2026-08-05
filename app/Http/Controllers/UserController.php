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

    public function getUserByMatricule($matricule)
    {
        return response()->json(
            $this->userService->findByMatricule($matricule)
        );
    }

    public function updateRole(Request $request)
    {
        $user = $this->userService->updateRole($request->input('id'), $request->input('role_crm'));

        return response()->json($user);
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
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'current_password' => 'required',
            'new_password' => 'required'
        ]);

        $result = $this->userService->updatePassword(
            $request->email,
            $request->current_password,
            $request->new_password
        );

        if (!$result['success']) {
            return response()->json([
                'message' => $result['message']
            ], 400);
        }

        return response()->json([
            'message' => $result['message']
        ], 200);
    }
}
