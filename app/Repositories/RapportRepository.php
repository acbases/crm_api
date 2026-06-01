<?php

namespace App\Repositories;

use App\Models\Rapport;

class RapportRepository
{
    public function all()
    {
        return Rapport::with('visite')->get();
    }

    public function find($id)
    {
        return Rapport::with('visite')->find($id);
    }

    public function create(array $data)
    {
        return Rapport::create($data);
    }
}
