<?php

namespace App\Services;

use App\Repositories\QRCodeRepository;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class QRCodeService
{
    protected $qrCodeRepository;

    public function __construct(QRCodeRepository $qrCodeRepository)
    {
        $this->qrCodeRepository = $qrCodeRepository;
    }

    public function generateClientQRCode($id)
    {
        $client = $this->qrCodeRepository->getClientForQRCode($id);

        if (!$client) {
            return null;
        }

        $data = [
            'id' => $client->id,
            'nom' => $client->nom,
            'latitude' => (float) $client->latitude,
            'longitude' => (float) $client->longitude,
        ];

        $jsonContent = json_encode($data);

        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($jsonContent)
            ->size(300)
            ->margin(10)
            ->build();

        return $result->getString();
    }
}