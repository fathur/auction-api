<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\UserTransformer;

class UserController extends Controller
{
    public function getProfile(Request $request)
    {
        $authUsername = auth()->payload()->get('usr');

        $user = (object)collect(config('auth.hard_code_users'))
            ->where('username', $authUsername)
            ->first();


        return response()->json(
            fractal($user, new UserTransformer)->toArray()
        );
    }
}
