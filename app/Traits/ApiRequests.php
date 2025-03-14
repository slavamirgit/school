<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

trait ApiRequests
{
    protected function apiRequest($method, $url, $options = [])
    {
        $client = new Client();

        try {
            $response = $client->request($method, $url, $options);
            $result = json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            $result['error'] = $e->getMessage();
        }

        return $result ?? [];
    }

    protected function getOptions($props = []): array
    {
        if (count($props) > 0) {
            $props['query'] = $props;
        }

        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . session('school_token')
            ],
            'verify' => false
        ];

        return array_merge($options, $props);
    }
}
