<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;

trait ApiRequests
{
    protected function apiRequest($method, $url, $options = [])
    {
        $client = new Client();

        try {
            $response = $client->request($method, $url, $options);
            $result = json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            $result = json_decode($e->getResponse()->getBody()->getContents(), true);
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
        return 'qXKM52kI7ZPIuRlm4Dtx0neyS6xkrdwkCZgKe7bz91f5ffc1';
    }

    protected function getOptions($props = []): array
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getToken()
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

    protected function parseErrors($data)
    {
        $result = $data['message'] ?? 'Error.';

        if (isset($data['errors'])) {
            foreach ($data['errors'] as $error) {
                $result .= ' ' . implode(' ', $error);
            }
        }

        return $result;
    }
}
