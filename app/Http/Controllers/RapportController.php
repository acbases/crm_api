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
            $request->validated()
        );

        return response()->json($rapport, 201);
    }
}
