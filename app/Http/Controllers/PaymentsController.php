<?php

namespace App\Http\Controllers;

use App\Payment;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view('payments.index', [
            "payments" => Payment::latest()->paginate()
        ]);
    }

    public function show(Payment $payment)
    {
        return view('payments.show', [
            "payment" => $payment
        ]);
    }
}
