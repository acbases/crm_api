<?php

namespace App\Http\Controllers;

use App\Services\QRCodeService;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    protected $qrCodeService;

    public function __construct(QRCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * Get the QR code image for a client.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getClientQRCode($id)
    {
        $qrCode = $this->qrCodeService->generateClientQRCode($id);

        if (!$qrCode) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        return response($qrCode)->header('Content-Type', 'image/png');
    }
}
