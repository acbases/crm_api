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

    
}
