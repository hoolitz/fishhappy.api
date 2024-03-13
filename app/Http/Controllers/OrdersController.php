<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Helper\FirebaseHelper;
use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    use FirebaseHelper;
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

        //UPDATE ORDER'S STASTUS NOTIFICATION
        $payload = [];
        $payload['title'] = 'Order Placed Successfully';
        $payload['message'] = 'You can drop any message here';
        $payload['body'] = 'Your order is being '. $order->status .' You will here from us shortly';


        $device = Customer::where('id', auth()->id())->select('device_id')->first();
        $this->pushNotification($device->device_id,$payload);

        return redirect()->route('orders.index');
    }
}
