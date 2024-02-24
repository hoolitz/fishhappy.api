<?php

namespace App\Http\Controllers;

use App\Order;

class OrderConfirmationsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function update(Order $order)
    {
        $order->update(["confirmed_at" => now()]);

        return redirect()->route('orders.index');
    }
}
