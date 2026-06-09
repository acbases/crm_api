<?php

namespace App\Services;

use App\Repositories\CorrespondantClientRepository;

class CorrespondantClientService
{
    protected $correspondantClientRepository;

    public function __construct(CorrespondantClientRepository $correspondantClientRepository)
    {
        $this->correspondantClientRepository = $correspondantClientRepository;
    }

    public function create(array $data)
    {
        return $this->correspondantClientRepository->create($data);
    }
    public function getCorrespondantClientByIdClient($id)
    {
        return $this->correspondantClientRepository->getCorrespondantClientByIdClient($id);
    }
    public function find($id)
    {
        return $this->correspondantClientRepository->find($id);
    }
    public function delete($id)
    {
        return $this->correspondantClientRepository->delete($id);
    }
}

