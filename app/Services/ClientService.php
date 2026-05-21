<?php

namespace App\Services;

use App\Repositories\ClientRepository;

class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function getAllClients()
    {
        return $this->clientRepository->all();
    }

    public function createClient(array $data)
    {
        return $this->clientRepository->create($data);
    }
}