<?php

namespace App\Services;

use App\Repositories\RecensementPlvRepository;

class RecensementPlvService
{
    protected $recensementPlvRepository;

    public function __construct(RecensementPlvRepository $recensementPlvRepository)
    {
        $this->recensementPlvRepository = $recensementPlvRepository;
    }

    public function getAllRecensementPlv()
    {
        return $this->recensementPlvRepository->all();
    }

    public function findRecensementPlv($id)
    {
        return $this->recensementPlvRepository->find($id);
    }

    public function createRecensementPlv(array $data)
    {
        return $this->recensementPlvRepository->create($data);
    }
}
