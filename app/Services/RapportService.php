<?php

namespace App\Services;

use App\Repositories\RapportRepository;
use Illuminate\Http\UploadedFile;
use Exception;
class RapportService
{
    protected $rapportRepository;

    public function __construct(RapportRepository $rapportRepository)
    {
        $this->rapportRepository = $rapportRepository;
    }

    public function getAllRapports()
    {
        return $this->rapportRepository->all();
    }

    public function findRapport($id)
    {
        return $this->rapportRepository->find($id);
    }

    public function createRapport(array $data, ?UploadedFile $sary = null)
    {
        try {

            if ($sary) {
                $data['sary'] = $sary->store('rapportRetail/files', 'public');
            }
            $rapport = $this->rapportRepository->create($data);

            return $rapport;

        } catch (Exception $e) {

            throw $e;
        }
    }
    public function getVueRapportProduitsByIdVisite($id)
    {
        return $this->rapportRepository->getVueRapportProduitsByIdVisite($id);
    }
    public function getVueRapportAutresProduitsByIdVisite($id)
    {
        return $this->rapportRepository->getVueRapportAutresProduitsByIdVisite($id);
    }
    public function getVueRapportPlvByIdVisite($id)
    {
        return $this->rapportRepository->getVueRapportPlvByIdVisite($id);
    }
    public function getRapportByIdVisite($id)
    {
        return $this->rapportRepository->getRapportByIdVisite($id);
    }
}
