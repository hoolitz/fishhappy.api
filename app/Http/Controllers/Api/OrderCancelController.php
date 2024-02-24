<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderCancelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Order $order)
    {
        if ($order->status === 'cancelled') {
            abort(404, "This order is already canceled");
        }

        $order->update(['status' => 'cancelled']);

        return response(['message' => 'Cancelled'], 200);
    }
}
