<?php

namespace App\Http\Controllers\Api;

use Pesapal;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Order $order)
    {
        $customer = auth("api")->user();

        $subTotal = $order->products->sum(function ($product){
            return $product->price * $product->pivot->quantity;
        });

        $payment = Payment::create([
            'customer_id' => $customer->id,
            'order_id' => $order->id,
            'transaction_id' => Pesapal::random_reference(),
            'status' => "NEW",
            'amount' => $subTotal
        ]);

        return Pesapal::makePayment([
            'amount' => $payment->amount,
            'description' => 'New fish order Transaction',
            'type' => 'MERCHANT',
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'email' => $customer->email,
            'phonenumber' => $customer->phone,
            'reference' => $payment->transaction_id,
            'height'=>'400px',
            'currency' => 'TZS'
        ]);
    }

    /*
     *
     * Just tells u payment has gone thru..but not confirmed
     *
    */
    public function paymentsuccess(Request $request)
    {
        $payment = Payment::where('transaction_id', request('merchant_reference'))->first();

        $payment->update([
            'tracking_id' => $request->get('tracking_id'),
            'status' => "PENDING"
        ]);

        return response($payment, 200);
    }
    /*
     *
     * This method just tells u that there is a change in pesapal
     * for your transaction..you need to now
     * query status..retrieve the change...CANCELLED? CONFIRMED?
     *
     */
    public function paymentconfirmation()
    {
        $this->checkpaymentstatus(
            request('pesapal_transaction_tracking_id'),
            request('pesapal_merchant_reference'),
            request('pesapal_notification_type')
        );
    }
    /*
     *
     * Confirm status of transaction and update the DB
     *
     * */
    public function checkpaymentstatus($trackingid, $merchant_reference, $pesapal_notification_type)
    {
        Payment::where('tracking_id', $trackingid)->update([
            'status' => Pesapal::getMerchantStatus($merchant_reference),
            'payment_method' => "PESAPAL"
        ]);

        return response([], 200);
    }
}
