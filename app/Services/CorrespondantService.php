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

    public function createCorrespondant(array $data)
    {
        return $this->correspondantRepository->create($data);
    }
    public function updateCorrespondant($id, array $data)
    {
        return $this->correspondantRepository->update($id, $data);
    }
}
