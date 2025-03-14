<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function sendResponse($message, $data = [], $code = 200)
    {
        $response = [
            'success' => true,
            'message' => $message
        ];

        if (filled($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    public function sendError($message, $errors = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        if (filled($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}
