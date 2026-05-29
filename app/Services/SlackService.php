<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
class SlackService 
{
    protected $webhookUrl;

    public function __construct()
    {
        // Pull the secret URL securely from environment variables
        $this->webhookUrl = env('SLACK_WEBHOOK_URL');
    }

    public function sendNotification(string $message)
    {
        if (empty($this->webhookUrl)) {
            return;
        }

        // Example using a standard HTTP client (like Guzzle or Laravel Http facade)
        Http::withoutVerifying()->post($this->webhookUrl, [
            'text' => $message
        ]);
    }
}
