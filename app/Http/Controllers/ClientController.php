<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

use App\Services\ClientService;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function getAllClients()
    {
    
        return response()->json(
            $this->clientService->getAllClients()
        );
    }

    public function createClient(StoreClientRequest $request)
    {
        $client = $this->clientService->createClient(
            $request->validated()
        );

        return response()->json($client, 201);
    }
    public function findClient($id)
    {
        $client = $this->clientService->findClient($id);

        if (!$client) {
            return response()->json([
                'message' => 'Client not found'
            ], 404);
        }

        return response()->json($client);
    }
    public function updateClient(UpdateClientRequest $request, $id)
    {
        $client = $this->clientService->updateClient(
            $id,
            $request->validated()
        );

        if (!$client) {
            return response()->json([
                'message' => 'Client not found',
            ], 404);
        }

        return response()->json($client);
    }
    public function getUniqueZones()
    {
        $zones = $this->clientService->getUniqueZones();

        return response()->json($zones);
    }
    public function getUniqueQuartiers()
    {
        $quartiers = $this->clientService->getUniqueQuartiers();

        return response()->json($quartiers);
    }

}
