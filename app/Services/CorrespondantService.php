<?php

namespace App\Services;

use App\Repositories\CorrespondantRepository;

class CorrespondantService
{
    protected $correspondantRepository;

    public function __construct(CorrespondantRepository $correspondantRepository)
    {
        $this->correspondantRepository = $correspondantRepository;
    }

    public function all()
    {
        return $this->correspondantRepository->all();
    }

    public function find($id)
    {
        return $this->correspondantRepository->find($id);
    }
}
