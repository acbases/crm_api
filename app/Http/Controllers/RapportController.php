<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRapportRequest;
use App\Services\RapportService;

class RapportController extends Controller
{
    protected $rapportService;

    public function __construct(RapportService $rapportService)
    {
        $this->rapportService = $rapportService;
    }

    public function getAllRapports()
    {
        return response()->json(
            $this->rapportService->getAllRapports()
        );
    }

    public function findRapport($id)
    {
        $rapport = $this->rapportService->findRapport($id);

        if (! $rapport) {
            return response()->json([
                'message' => 'Rapport not found',
            ], 404);
        }

        return response()->json($rapport);
    }

    public function createRapport(StoreRapportRequest $request)
    {
        $rapport = $this->rapportService->createRapport(
            $request->validated(),
            $request->file('sary')
        );

        return response()->json($rapport, 201);
    }
    public function getVueRapportProduitsByIdVisite($id)
    {
        $vueRapportProduitsByidVisite = $this->rapportService->getVueRapportProduitsByIdVisite($id);

        if (!$vueRapportProduitsByidVisite) {
            return response()->json([
                'message' => 'Visite not found',
            ], 404);
        }

        return response()->json($vueRapportProduitsByidVisite);
    }
    public function getVueRapportAutresProduitsByIdVisite($id)
    {
        $vueRapportAutresProduitsByidVisite = $this->rapportService->getVueRapportAutresProduitsByIdVisite($id);

        if (!$vueRapportAutresProduitsByidVisite) {
            return response()->json([
                'message' => 'Visite not found',
            ], 404);
        }

        return response()->json($vueRapportAutresProduitsByidVisite);
    }
    public function getVueRapportPlvByIdVisite($id)
    {
        $vueRapportPlvByidVisite = $this->rapportService->getVueRapportPlvByIdVisite($id);

        if (!$vueRapportPlvByidVisite) {
            return response()->json([
                'message' => 'Visite not found',
            ], 404);
        }

        return response()->json($vueRapportPlvByidVisite);
    }
    public function getRapportByIdVisite($id)
    {
        $rapport = $this->rapportService->getRapportByIdVisite($id);

        if (!$rapport) {
            return response()->json([
                'message' => 'Rapport not found',
            ], 404);
        }

        return response()->json($rapport);
    }
}
             
