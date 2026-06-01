<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VisiteStatutService;

class VisiteStatutController extends Controller
{
    protected $visiteStatutService;

    public function __construct(VisiteStatutService $visiteStatutService)
    {
        $this->visiteStatutService = $visiteStatutService;
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

        $visites = $this->visiteStatutService->getVisitesByIdClientAndIdUtilisateurAndStatutZero(
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
}
