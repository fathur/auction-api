<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\TokenTransformer;
use App\Extensions\JwtToken;
use App\Http\Requests\LoginRequest;
use Illuminate\Auth\AuthenticationException;

class AuthenticationController extends Controller
{

    public function login(LoginRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $token = auth()->claims([
            'usr' => $username
        ])->attempt([
            'username'  => $username,
            'password'  => $password
        ]);

        if (empty($token) || is_null($token)) {
            throw new AuthenticationException('User not found, or your combination is wrong.');
            
        }

        $token = new JwtToken($token);

        return response()->json(
            fractal($token, new TokenTransformer())->toArray()
        );
    }

    /**
     * Logout authenticated user
     */
    public function logout()
    {
        auth()->logout();

        return response()->json([]);
    }
}
