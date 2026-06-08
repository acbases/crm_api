<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CorrespondantService;
use App\Http\Requests\UpdateCorrespondantRequest;
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

    public function getCorrespondantById($id)
    {
        return response()->json(
            $this->correspondantService->find($id)
        );
    }

    public function createCorrespondant(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'poste' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
        ]);

        $correspondant = $this->correspondantService->createCorrespondant($data);

        return response()->json($correspondant, 201);
    }

    public function updateCorrespondant($id, UpdateCorrespondantRequest $request)
    {
        $data = $request->validated();

        $correspondant = $this->correspondantService->updateCorrespondant($id, $data);

        return response()->json($correspondant);
    }

}
