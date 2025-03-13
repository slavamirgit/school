<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $data = [
                'token' => $user->createToken('School Token')->plainTextToken,
                'name' => $user->name
            ];

            return $this->sendResponse($data, 'User logged in successfully.');
        }

        return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }
}
