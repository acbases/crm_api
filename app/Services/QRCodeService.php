<?php

namespace App\Services;

use App\Repositories\QRCodeRepository;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QRCodeService
{
    protected $qrCodeRepository;

    public function __construct(QRCodeRepository $qrCodeRepository)
    {
        $this->qrCodeRepository = $qrCodeRepository;
    }

    /**
     * Generate a QR code image for a specific client (PNG format).
     *
     * @param int $id
     * @return string|null
     */
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

        // Create QR code
        $qrCode = QrCode::create($jsonContent)
            ->setSize(300)
            ->setMargin(10);

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        return $result->getString();
    }
}
