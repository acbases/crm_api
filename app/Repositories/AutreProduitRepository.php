<?php

namespace App\Repositories;

use App\Models\AutreProduit;

class AutreProduitRepository
{
    public function all()
    {
        return AutreProduit::all();
    }

    public function find($id)
    {
        return AutreProduit::find($id);
    }

    public function create(array $data)
    {
        return AutreProduit::create($data);
    }
}