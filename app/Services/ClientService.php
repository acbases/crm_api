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

    public function findClient($id)
    {
        return $this->clientRepository->find($id);
    }
    public function updateClient($id, array $data)
    {
        return $this->clientRepository->update($id, $data);
    }
    public function getUniqueZones()
    {
        return $this->clientRepository->getUniqueZones();
    }
    public function getUniqueQuartiers()
    {
        return $this->clientRepository->getUniqueQuartiers();
    }
}
