<?php

namespace App\Repositories;

use App\Models\TypeVisite;

class TypeVisiteRepository
{
    public function all()
    {
        return TypeVisite::all();
    }

    public function find($id)
    {
        return TypeVisite::find($id);
    }

    public function create(array $data)
    {
        return TypeVisite::create($data);
    }
}
