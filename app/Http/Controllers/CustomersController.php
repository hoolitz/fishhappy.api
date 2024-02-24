<?php

namespace App\Http\Controllers;

use App\Customer;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view('customers.index', [
            'customers' => Customer::withCount(["orders"])->latest()->paginate()
        ]);
    }

    public function show(Customer $customer)
    {
        return view('customers.show', [
            "customer" => $customer
        ]);
    }
}
