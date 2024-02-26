<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        // INPUT VALIDATIONS (EMAIL AND PASSWORD)
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if ($validator->fails()){
            return response()->json([
                'status' => ResponseAlias::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $validator->messages(),
            ])->setStatusCode(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY,
                Response::$statusTexts[ResponseAlias::HTTP_UNPROCESSABLE_ENTITY]);
        }


        if (auth()->guard('customer')->attempt($validator->validated())) {
            $customer = auth()->guard('customer')->user();

            $token = $customer->createToken('fish-happy-token')->accessToken;

            return response(compact("token"), 200);
        }

        return response([
            'error' => ['message' => 'Wrong email or password']
        ], 401);
    }
}
