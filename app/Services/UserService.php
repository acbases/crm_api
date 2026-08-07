<?php

namespace App\Services;

use App\Repositories\AllproRhRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    protected $allproRhRepository;

    public function __construct(UserRepository $userRepository, AllproRhRepository $allproRhRepository)
    {
        $this->userRepository = $userRepository;
        $this->allproRhRepository = $allproRhRepository;
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

    public function importFromAllproRh()
    {
        $eligibleUsers = $this->allproRhRepository->getEligibleCommerciaux();

        $matricules = $eligibleUsers->pluck('matricule')->filter()->values()->all();

        $existingMatricules = $this->userRepository->findExistingMatricules($matricules);

        $missingUsers = $eligibleUsers->reject(function ($rhUser) use ($existingMatricules) {
            return in_array($rhUser->matricule, $existingMatricules, true);
        });

        $insertedUsers = [];
        $errors = [];

        foreach ($missingUsers as $rhUser) {
            try {
                $insertedUsers[] = $this->userRepository->create([
                    'name' => $rhUser->nom,
                    'firstname' => $rhUser->prenom,
                    'poste' => $rhUser->fonction_poste,
                    'matricule' => $rhUser->matricule,
                    'email' => $rhUser->email,
                    'password' => 'Aze12qsd',
                    'statut' => true,
                    'role_crm' => 'utilisateur',
                ]);
            } catch (\Throwable $e) {
                $errors[] = [
                    'matricule' => $rhUser->matricule,
                    'message' => $e->getMessage(),
                ];
            }
        }

        return [
            'total_eligible' => $eligibleUsers->count(),
            'already_existing' => $eligibleUsers->count() - $missingUsers->count(),
            'inserted' => count($insertedUsers),
            'inserted_users' => $insertedUsers,
            'errors' => $errors,
        ];
    }
}

