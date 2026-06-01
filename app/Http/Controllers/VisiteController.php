<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisiteRequest;
use App\Http\Requests\UpdateVisiteRequest;
use App\Services\VisiteService;
use Illuminate\Http\Request;

class VisiteController extends Controller
{
    protected $visiteService;

    public function __construct(VisiteService $visiteService)
    {
        $this->visiteService = $visiteService;
    }

    public function getAllVisites()
    {

        return response()->json(
            $this->visiteService->getAllVisites()
        );
    }

    public function createVisite(StoreVisiteRequest $request)
    {
        $visite = $this->visiteService->createVisite(
            $request->validated()
        );

        return response()->json($visite, 201);
    }

    public function updateVisite(UpdateVisiteRequest $request, $id)
    {
        $visite = $this->visiteService->updateVisite(
            $id,
            $request->validated()
        );

        if (!$visite) {
            return response()->json([
                'message' => 'Visite not found',
            ], 404);
        }

        return response()->json($visite);
    }

    public function findVisite($id)
    {
        $visite = $this->visiteService->findVisite($id);

        if (!$visite) {
            return response()->json([
                'message' => 'Visite not found',
            ], 404);
        }

        return response()->json($visite);
    }
    public function getVisiteByIdClient($id)
    {
        $visites = $this->visiteService->getVisiteByIdClient($id);

        if ($visites->isEmpty()) {
            return response()->json([
                'message' => 'No visites found for this client',
            ], 404);
        }

        return response()->json($visites);
    }
    public function getVisiteByIdUtilisateur($id)
    {
        $visites = $this->visiteService->getVisiteByIdUtilisateur($id);

        if ($visites->isEmpty()) {
            return response()->json([
                'message' => 'No visites found for this user',
            ], 404);
        }

        return response()->json($visites);
    }
     public function getVisitesByIdClientAndIdUtilisateurAndStatutZero(Request $request)
    {
        $idClient = $request->query('idClient');
        $idUtilisateur = $request->query('idUtilisateur');

        if ($idClient === null || $idUtilisateur === null) {
            return response()->json([
                'message' => 'idClient and idUtilisateur are required query parameters',
            ], 422);
        }

        $visites = $this->visiteService->getVisitesByIdClientAndIdUtilisateurAndStatutZero(
            $idClient,
            $idUtilisateur
        );

        if ($visites->isEmpty()) {
            return response()->json([
                'message' => 'No visites found for this client, utilisateur and statut 0',
            ], 404);
        }

        return response()->json($visites);
    }
    public function getVisiteDetailsByIdVisite($id)
    {
        $visiteDetails = $this->visiteService->getVisiteDetailsByIdVisite($id);

        if (!$visiteDetails) {
            return response()->json([
                'message' => 'Visite details not found',
            ], 404);
        }

        return response()->json($visiteDetails);
    }
}


