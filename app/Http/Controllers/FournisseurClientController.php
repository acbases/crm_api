<?php

namespace App\Http\Controllers;

use App\Services\FournisseurClientService;
use Illuminate\Http\Request;

class FournisseurClientController extends Controller
{
    protected $fournisseurClientService;

    public function __construct(FournisseurClientService $fournisseurClientService)
    {
        $this->fournisseurClientService = $fournisseurClientService;
    }

    public function createFournisseurClient(Request $request)
    {
        $fournisseurClient = $this->fournisseurClientService->create(
            $request->all()
        );

        return response()->json($fournisseurClient, 201);
    }
    public function getAllFournisseurClients()
    {
        return response()->json(
            $this->fournisseurClientService->all()
        );
    }
    public function getFournisseurClientByIdClient($id)
    {
        $fournisseurClients = $this->fournisseurClientService->getFournisseurClientByIdClient($id);

        if ($fournisseurClients->isEmpty()) {
            return response()->json([
                'message' => 'No fournisseur clients found for this client',
            ], 404);
        }
        return response()->json($fournisseurClients, 200);
    }
    public function getFournisseurClientById($id)
    {
        return response()->json(
            $this->fournisseurClientService->find($id)
        );
    }
    public function deleteFournisseurClient($id)
    {
        $deleted = $this->fournisseurClientService->delete($id);

        if ($deleted) {
            return response()->json([
                'message' => 'Fournisseur client deleted successfully',
            ], 200);
        }

        return response()->json([
            'message' => 'Fournisseur client not found',
        ], 404);
    }

    public function updateStatut($id)
    {
        $updatedFournisseurClient = $this->fournisseurClientService->updateStatut($id);

        if ($updatedFournisseurClient) {
            return response()->json([
                'message' => 'Fournisseur client statut updated successfully',
                'fournisseur_client' => $updatedFournisseurClient,
            ], 200);
        }

        return response()->json([
            'message' => 'Fournisseur client not found',
        ], 404);
    }
}

