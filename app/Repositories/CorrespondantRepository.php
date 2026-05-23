<?php

namespace App\Repositories;

use App\Models\Correspondant;

class CorrespondantRepository
{
    public function all()
    {
        return Correspondant::all();
    }

    public function find($id)
    {
        return Correspondant::find($id);
    }

    public function create(array $data)
    {
        return Correspondant::create($data);
    }
}
