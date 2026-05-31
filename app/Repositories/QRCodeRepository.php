<?php

namespace App\Repositories;

use App\Models\Client;

class QRCodeRepository
{
    /**
     * Get client data for QR code generation.
     *
     * @param int $id
     * @return Client|null
     */
    public function getClientForQRCode($id)
    {
        return Client::select('id', 'nom', 'latitude', 'longitude')->find($id);
    }
}
