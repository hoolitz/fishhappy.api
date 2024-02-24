<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $customer = Customer::create($request->validate([
            'name' => ["required"],
            'email' => ["required", "email", Rule::unique("customers", "email")],
            'phone' => ["required"],
            'password' => ["required"]
        ]));

        $token = $customer->createToken('fish-happy-token')->accessToken;

        return response(compact("token"), 201);
    }
}
