<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            "email" => ["required"],
            "password" => ["required"],
        ]);

        if (auth()->guard('customer')->attempt($credentials)) {
            $customer = auth()->guard('customer')->user();

            $token = $customer->createToken('fish-happy-token')->accessToken;

            return response(compact("token"), 200);
        }

        return response([
            'error' => ['message' => 'Wrong email or password']
        ], 401);
    }
}
