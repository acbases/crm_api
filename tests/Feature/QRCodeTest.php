<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QRCodeTest extends TestCase
{
    public function test_can_get_client_qr_code()
    {
        $mockClient = (object) [
            'id' => 10,
            'nom' => 'Entreprise Rasoanaivo',
            'latitude' => -18.8792,
            'longitude' => 47.5079,
        ];

        $this->mock(\App\Repositories\QRCodeRepository::class, function ($mock) use ($mockClient) {
            $mock->shouldReceive('getClientForQRCode')->with(10)->andReturn($mockClient);
        });

        $response = $this->get("/api/client/10/qrcode");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'image/png');
    }

    public function test_returns_404_if_client_not_found()
    {
        $this->mock(\App\Repositories\QRCodeRepository::class, function ($mock) {
            $mock->shouldReceive('getClientForQRCode')->with(9999)->andReturn(null);
        });

        $response = $this->get("/api/client/9999/qrcode");

        $response->assertStatus(404);
    }
}
