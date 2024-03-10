<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

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


    public function updateStatus(Request $request){
        $order = Order::find((int)$request->order);
        $order->status = $request->status;
        $order->save();
        return redirect()->route('orders.index');
    }
}
