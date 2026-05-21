<?php

namespace App\Http\Controllers;

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
}
