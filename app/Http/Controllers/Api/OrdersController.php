<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Helper\FirebaseHelper;
use App\Http\Controllers\Controller;
use App\Notifications\OrderWasMade;
use App\Order;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Notification;

class OrdersController extends Controller
{
    use FirebaseHelper;
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $orders = Order::with(["products"])->where("customer_id", auth("api")->id())->get();

        return response($orders, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => ['required', 'array'],
            'products.*.id' => ["required", Rule::exists("products", "id")],
            'products.*.quantity' => ["required", "numeric"],
        ]);

        $customer = auth("api")->user();

        DB::beginTransaction();

        $order = Order::create([
            "status" => "pending",
            "customer_id" => $customer->id
        ]);

        collect(request('products'))->each(function ($product) use ($order) {
            $order->products()->attach($product['id'], [
                'quantity' => $product['quantity']
            ]);
        });

        //Notification::send($customer, new OrderWasMade($order));

        //$this->pushNotification($customer, $order);
        DB::commit();

        $payload = [];
        $payload['title'] = 'Order Placed Successfully';
        $payload['message'] = 'You can drop any message here';
        $payload['body'] = 'Your order is being processed, You will here from us shortly';

        //SEND GOOGLE CLOUD MESSAGE (NOTIFICATION TO ALL THE DEVICES)
        $device = Customer::where('id', $order->customer_id)->select('device_id')->first();
        $this->pushNotification([$device->device_id],$payload);

        return response($order, 200);
    }

    public function show(Order $order)
    {
        return response($order->load(["products"]), 200);
    }

    /*
    private function pushNotification($currentCustomer, Order $order)
    {
        $pusher = new Pusher(
            'cfe25be44d53f3cc4464',
            'ee053b7ef4ec3af58f87',
            '341208',
            ['cluster' => 'ap2', 'encrypted' => true]
        );

        $pusher->trigger("order-channel", "order-event", [
            "title" => "{$currentCustomer->name} made order",
            "body" => "The order contain {$order->products->count()} items",
        ]);
    }
    */
}
