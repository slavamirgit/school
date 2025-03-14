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
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . session('school_token')
                //'Authorization' => 'Bearer ' . 'EJzQorDDI3IYvVsGi3GxVcYwwf65Dn3ArIu5Cubl3e78317b'
            ],
            'verify' => false,
            'connect_timeout' => 20,
            'timeout' => 20
        ];

        if (count($props) > 0) {
            $options = array_merge($options, ['query' => $props]);
        }

        return $options;
    }
}
