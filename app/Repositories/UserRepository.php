<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function updateRole($id, $role)
    {
        $user = User::find($id);

        if (!$user) {
            return null;
        }

        $user->role_crm = $role;
        $user->save();

        return $user;
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function findByMatricule($matricule)
    {
        return User::where('matricule', $matricule)->first();
    }

    public function findExistingMatricules(array $matricules)
    {
        return User::whereIn('matricule', $matricules)
            ->pluck('matricule')
            ->all();
    }

    public function updatePassword(User $user, $hashedPassword)
    {
        $user->password = $hashedPassword;
        $user->save();

        return $user;
    }
}
