<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegisterController extends Controller
{

    public function register(Request $request)
    {

        $customerValidator = Customer::validate($request->all());

        //CHECK FOR VALIDATION
        if ($customerValidator->fails()) {
            return response()->json([
                'status' => ResponseAlias::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $customerValidator->messages(),
            ])->setStatusCode(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY,
                Response::$statusTexts[ResponseAlias::HTTP_UNPROCESSABLE_ENTITY]);
        }

        try {

            //CREATING CUSTOMER FROM VALIDATED INPUTS
            $customer = Customer::create([
                'name' => $customerValidator->validated()['name'],
                'email' => $customerValidator->validated()['email'],
                'phone' => $customerValidator->validated()['phone'],
                'password' => $customerValidator->validated()['password']
            ]);

            $token = $customer->createToken('fish-happy-token')->accessToken;
            return response(compact("token"), 201);

        } catch (ValidationException $e) {
            \response()->json([
                'message'=> $e->getMessage(),
                'status' => ResponseAlias::HTTP_UNPROCESSABLE_ENTITY,
            ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }

        // RESPONSE FOR UNHANDLED SITUATIONS
        return \response()->json([
            'message'=> "Something went wrong please try again later.",
            'status' => ResponseAlias::HTTP_UNPROCESSABLE_ENTITY,
        ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);


    }
}
