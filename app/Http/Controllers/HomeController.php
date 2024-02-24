<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function __invoke()
    {
        return view('home', [
            "orders" => Order::latest()->paginate()
        ]);
    }
}
