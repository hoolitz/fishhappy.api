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
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Customer</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Product</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Status</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Time</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100"></th>
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
                                <a href="#" class="text-sm font-medium text-red-500">Cancel</a>
                                <a href="#" class="text-sm font-medium text-purple-500">Delivery</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
