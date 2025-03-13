<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class GradeController extends Controller
{
    public function index()
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . session('school_token')
            ]
        ];

        dump($options);

        $client = new Client($options);
        $response = $client->get(route('api.grades.index'));

        dump($response->getStatusCode());
        dump($response->getBody()->getContents());
    }
}
