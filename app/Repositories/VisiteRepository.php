<?php

namespace App\Repositories;

use App\Models\Visite;

class VisiteRepository
{
    
    public function all()
    {
        return Visite::all();
    }
    
    public function find($id)
    {
        return Visite::find($id);
    }

    public function create(array $data)
    {
        return Visite::create($data);
    }
}