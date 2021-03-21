<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\TokenTransformer;
use App\Extensions\JwtToken;

class AuthenticationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => ['login']
        ]);
    }

    public function login(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $token = auth()->attempt([
            'username'  => $username,
            'password'  => $password
        ]);

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
