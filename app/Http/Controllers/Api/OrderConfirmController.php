<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderConfirmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Order $order)
    {
        if ($order->status === 'confirmed') {
            abort(404, "This order is already confirmed");
        }

        $order->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);

        return response(['message' => 'Confirmed'], 200);
    }
}
