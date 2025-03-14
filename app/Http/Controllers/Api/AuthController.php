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
            $token = Auth::user()->createToken('School Token')->plainTextToken;
            return $this->sendResponse('User logged in successfully.', $token);
        }

        return $this->sendError('Incorrect login or password.', [401 => 'Unauthorized'], 401);
    }
}
