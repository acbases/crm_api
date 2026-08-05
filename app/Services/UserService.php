<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        return $this->userRepository->all();
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    public function findByMatricule($matricule)
    {
        return $this->userRepository->findByMatricule($matricule);
    }

    public function updateRole($id, $role)
    {
        return $this->userRepository->updateRole($id, $role);
    }

    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            return Auth::user();
        }

        return null;
    }
    public function updatePassword(
        string $email,
        string $currentPassword,
        string $newPassword
    ) {
        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'User not found'
            ];
        }

        if (!Hash::check($currentPassword, $user->password)) {
            return [
                'success' => false,
                'message' => 'Current password is incorrect'
            ];
        }

        $this->userRepository->updatePassword(
            $user,
            Hash::make($newPassword)
        );

        return [
            'success' => true,
            'message' => 'Password updated successfully'
        ];
    }
}

