<?php

namespace App\Services;

use App\Repositories\RapportB2BRepository;
use Illuminate\Http\UploadedFile;

class RapportB2BService
{
    protected $rapportB2BRepository;

    public function __construct(RapportB2BRepository $rapportB2BRepository)
    {
        $this->rapportB2BRepository = $rapportB2BRepository;
    }

    public function getAllRapportB2B()
    {
        return $this->rapportB2BRepository->all();
    }

    
    public function findRapportB2B($id)
    {
        return $this->rapportB2BRepository->find($id);
    }

    public function createRapportB2B(array $data, ?UploadedFile $sary = null)
    {
        if ($sary) {
            $data['sary'] = $sary->store('rapportB2B/files', 'public');
        }

        return $this->rapportB2BRepository->create($data);
    }

}
