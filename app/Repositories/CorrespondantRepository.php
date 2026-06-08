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
    public function update($id, array $data)
    {
        $correspondant = Correspondant::find($id);

        if (! $correspondant) {
            return null;
        }

        $correspondant->update($data);

        return $correspondant->fresh();
    }

}
