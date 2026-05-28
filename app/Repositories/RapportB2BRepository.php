<?php

namespace App\Repositories;

use App\Models\RapportB2B;

class RapportB2BRepository
{
    public function all()
    {
        return RapportB2B::all();
    }

    public function find($id)
    {
        return RapportB2B::with(['visite', 'correspondant'])->find($id);
    }

    public function create(array $data)
    {
        return RapportB2B::create($data);
    }
    public function getRapportB2BByIdVisite($id){
        return RapportB2B::where('idvisite', $id)->with([
            'visite',
            'correspondant'
        ])->get();
    }
}
