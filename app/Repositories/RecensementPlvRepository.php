<?php

namespace App\Repositories;

use App\Models\RecensementPlv;

class RecensementPlvRepository
{
    public function all()
    {
        return RecensementPlv::with(['visite', 'plv'])->get();
    }

    public function find($id)
    {
        return RecensementPlv::with(['visite', 'plv'])->find($id);
    }

    public function create(array $data)
    {
        return RecensementPlv::create($data);
    }
}
