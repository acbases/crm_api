<?php

namespace App\Repositories;

use App\Models\Agence;

class AgenceRepository
{
    public function all()
    {
        return Agence::all();
    }

    public function find($id)
    {
        return Agence::find($id);
    }

    public function create(array $data)
    {
        return Agence::create($data);
    }
}
