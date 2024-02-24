<?php

namespace App\Http\Controllers;

use App\Order;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view('orders.index', [
            "orders" => Order::latest()->paginate()
        ]);
    }

    public function show(Order $order)
    {
        return view('orders.show', [
            "order" => $order
        ]);
    }
}
