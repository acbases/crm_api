<?php

namespace App\Http\Controllers;

use App\Services\CorrespondantService;

class CorrespondantController extends Controller
{
    protected $correspondantService;

    public function __construct(CorrespondantService $correspondantService)
    {
        $this->correspondantService = $correspondantService;
    }

    public function getAllCorrespondants()
    {
        return response()->json(
            $this->correspondantService->all()
        );
    }

    public function getCorrespondant($id)
    {
        return response()->json(
            $this->correspondantService->find($id)
        );
    }
}
