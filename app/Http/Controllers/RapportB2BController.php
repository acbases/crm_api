<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRapportB2BRequest;
use App\Services\RapportB2BService;

class RapportB2BController extends Controller
{
    protected $rapportB2BService;

    public function __construct(RapportB2BService $rapportB2BService)
    {
        $this->rapportB2BService = $rapportB2BService;
    }

    public function getAllRapportB2B()
    {

        return response()->json(
            $this->rapportB2BService->getAllRapportB2B()
        );
    }

    

    public function findRapportB2B($id)
    {
        $rapportB2B = $this->rapportB2BService->findRapportB2B($id);

        if (! $rapportB2B) {
            return response()->json([
                'message' => 'RapportB2B not found',
            ], 404);
        }

        return response()->json($rapportB2B);
    }

    public function createRapportB2B(StoreRapportB2BRequest $request)
    {
        // dd($request->validated());
        $rapportB2B = $this->rapportB2BService->createRapportB2B(
            $request->validated(),
            $request->file('sary')
        );

        return response()->json($rapportB2B, 201);
    }
    public function getRapportB2BByIdVisite($id)
    {
        $rapportB2Bs = $this->rapportB2BService->getRapportB2BByIdVisite($id);

        if ($rapportB2Bs->isEmpty()) {
            return response()->json([
                'message' => 'No rapports found for this visit',
            ], 404);
        }

        return response()->json($rapportB2Bs);
    }
}
