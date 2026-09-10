<?php

namespace App\Http\Controllers;

use App\Services\CorrespondantClientService;
use Illuminate\Http\Request;

class CorrespondantClientController extends Controller
{
    protected $correspondantClientService;

    public function __construct(CorrespondantClientService $correspondantClientService)
    {
        $this->correspondantClientService = $correspondantClientService;
    }

    public function createCorrespondantClient(Request $request)
    {
        $correspondantClient = $this->correspondantClientService->create(
            $request->all()
        );

        return response()->json($correspondantClient, 201);
    }
    public function getAllCorrespondantClients()
    {
        return response()->json(
            $this->correspondantClientService->all()
        );
    }
    public function getCorrespondantClientByIdClient($id)
    {
        $correspondantClients = $this->correspondantClientService->getCorrespondantClientByIdClient($id);

        if ($correspondantClients->isEmpty()) {
            return response()->json([
                'message' => 'No correspondant clients found for this client',
            ], 404);
        }

        return response()->json($correspondantClients, 200);
    }
    public function getCorrespondantClientById($id)
    {
        return response()->json(
            $this->correspondantClientService->find($id)
        );
    }
    public function deleteCorrespondantClient($id)
    {
        $deleted = $this->correspondantClientService->delete($id);

        if ($deleted) {
            return response()->json([
                'message' => 'Correspondant client deleted successfully',
            ], 200);
        }

        return response()->json([
            'message' => 'Correspondant client not found',
        ], 404);
    }

    public function updateStatut($id)
    {
        $updatedCorrespondantClient = $this->correspondantClientService->updateStatut($id);

        if ($updatedCorrespondantClient) {
            return response()->json([
                'message' => 'Statut updated successfully',
                'correspondant_client' => $updatedCorrespondantClient,
            ], 200);
        }

        return response()->json([
            'message' => 'Correspondant client not found',
        ], 404);
    }
}

