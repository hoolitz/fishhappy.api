<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
//        return response($request->user()->load([
//            'orders.products',
//            'favorites'
//        ]), 200);

        return response()->json(
            $request->user()->load([
                'orders.products', 'favorites'
            ]), 200);
    }

    public function updateFCMToken(Request $request) {
        $customer = Customer::find(auth()->id());
        $customer->device_id = $request->fcm_token;
        $customer->save();
        return response()->json([
            'fcm_token' => $customer->fcm_token,
        ], 200);
    }
}
