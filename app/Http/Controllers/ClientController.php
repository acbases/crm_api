<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
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
    
}
