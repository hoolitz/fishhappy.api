@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded">
        <div class="border-b border-gray-100">
            <h2 class="px-6 py-5 font-medium text-gray-700">Orders</h2>
        </div>

        <div class="text-sm mb-12">
            <table class="w-full">
                <thead>
                <tr>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">
                        Customer
                    </th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">
                        Product
                    </th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">
                        Status
                    </th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">
                        Time
                    </th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-200 align-top">
                            <h4 class="font-medium text-gray-600">{{ $order->customer->name }}</h4>
                            <span class="text-xs">{{ $order->customer->phone }}</span>
                        </td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-200 align-top">

                            <table class="w-full">
                                @foreach($order->products as $product)
                                    <tr>
                                        <td class="pb-3 text-left w-40">
                                            <span class="text-gray-600">{{ $product->name }}</span>
                                        </td>
                                        <td class="pb-3 text-right">
                                            <span>{{ number_format($product->pivot->quantity) }}</span>
                                            <span>@</span>
                                            <span>{{ number_format($product->price, 2) }}</span>
                                        </td>
                                        <td class="pb-3 text-right">
                                            <span class="font-medium text-gray-700">
                                                {{ number_format(($product->price * $product->pivot->quantity), 2) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="2">
                                        <span class="font-medium text-gray-700">Total amount</span>
                                    </td>
                                    <td class="text-right">
                                       <span class="font-semibold">
                                           {{ $subTotal = number_format($order->products->sum(function ($product){ return ($product->price * $product->pivot->quantity); }), 2) }}
                                       </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-200 align-top">
                            <span class="capitalize">{{ $order->status }}</span>
                        </td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-200 align-top">
                            {{ $order->created_at->format("M d, Y H:m") }}
                        </td>
                        <td class="text-right text-sm text-gray-700 py-4 px-4 border-b border-gray-200 align-top">
                            <div class="space-x-2">

                                <div class="flex justify-center  ">
                                    <div x-data="{ dropdownOpen: false }" class="relative ">

                                        <button @click="dropdownOpen = !dropdownOpen" id="statusDropdown" @click.prevent
                                                class="relative z-10 block rounded-md bg-white p-2 focus:outline-none">
                                            <svg class="h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </button>

                                        <div @click="dropdownOpen = false" x-show="dropdownOpen"
                                             class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                                            <a href="" @click="updateOrderStatus('pending',{{ $order->id }})"
                                               @click.prevent
                                               class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white" disabled>
                                                Pending
                                            </a>
                                            <a href="{{ route('order.update.status', ['order' => $order->id, 'status'=>'processing']) }}"
                                               @click.prevent
                                               onclick="event.preventDefault();
                                                document.getElementById('delete-product-form-{{ $order->id }}').submit();"
                                               class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                                Processing
                                            </a>

                                            <a  href="{{ route('order.update.status', ['order' => $order->id, 'status'=>'shipping']) }}"
                                               @click.prevent
                                               onclick="event.preventDefault();
                                               document.getElementById('shipping-order-form-{{ $order->id }}').submit();"
                                               class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                                Shipping
                                            </a>
                                            <a href="{{ route('order.update.status', ['order' => $order->id, 'status'=>'delivered']) }}"
                                               @click.prevent
                                               onclick="event.preventDefault();
                                               document.getElementById('delivery-order-form-{{ $order->id }}').submit();"
                                               class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                                Delivered
                                            </a>
                                        </div>

                                        <form id="delete-product-form-{{ $order->id }}"
                                              action="{{ route('order.update.status', ['order' => $order->id,'status' => 'processing' ]) }}"
                                              method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>

                                        <form id="shipping-order-form-{{ $order->id }}"
                                              action="{{ route('order.update.status', ['order' => $order->id,'status' => 'shipping' ]) }}"
                                              method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>

                                        <form id="delivery-order-form-{{ $order->id }}"
                                              action="{{ route('order.update.status', ['order' => $order->id,'status' => 'delivered' ]) }}"
                                              method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script>

    function updateOrderStatus(status, id) {


        fetch('http://localhost:8000/api/cstmr/orders/update-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                orderId: id,
                newStatus: status
            })
        })
            .then(response => response.json())
            .then(data => {
                // Handle successful update (optional)
                console.log('Order status updated:', data);
                // Close the dropdown (optional)
                this.dropdownOpen = false;
            })
            .catch(error => {
                console.error('Error updating order status:', error);
            });


    }

</script>
