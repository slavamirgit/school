<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;
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

    protected function getToken()
    {
        if (session()->missing('school_token')) {
            $token = Auth::user()->createToken('School Token')->plainTextToken;
            session()->put('school_token', explode('|', $token)[1]);
        }

        return session('school_token');
    }

    protected function getRemoteToken(): string
    {
        return 'x5dQwl0TFsxhKduDOXnUQhCklNLLokIZkyp40xpwb962dc43';
    }

    protected function getOptions($props = []): array
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getRemoteToken()
            ],
            'verify' => false,
            'connect_timeout' => 20,
            'timeout' => 20
        ];

        if (filled($props)) {
            $options = array_merge($options, ['query' => $props]);
        }

        return $options;
    }
}
