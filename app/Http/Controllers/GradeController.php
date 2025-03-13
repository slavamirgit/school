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

        $client = new Client($options);
        $response = $client->get(route('api.grades.index'));

        // dump($response->getStatusCode());
        // dump($response->getBody()->getContents());

        $result = json_decode($response->getBody()->getContents(), true);

        return view('site.grades', [
            'title' => 'Grades',
            'grades' => $result['data'] ?? []
        ]);
    }
}
