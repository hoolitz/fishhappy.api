@extends('layouts.app')

@section('content')
    <div>
        <div class="flex -mx-3">
            <div class="w-1/3 px-3">
                <div class="bg-purple-50 rounded shadow px-4 py-4">
                    <div class="flex justify-between items-baseline">
                        <h3 class="font-bold text-lg text-purple-700">Customers</h3>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 fill-current text-purple-700">
                                <path fill="none" d="M0 0h24v24H0z"/>
                                <path d="M12 17c3.662 0 6.865 1.575 8.607 3.925l-1.842.871C17.347 20.116 14.847 19 12 19c-2.847 0-5.347 1.116-6.765 2.796l-1.841-.872C5.136 18.574 8.338 17 12 17zm0-15a5 5 0 0 1 5 5v3a5 5 0 0 1-4.783 4.995L12 15a5 5 0 0 1-5-5V7a5 5 0 0 1 4.783-4.995L12 2zm0 2a3 3 0 0 0-2.995 2.824L9 7v3a3 3 0 0 0 5.995.176L15 10V7a3 3 0 0 0-3-3z"/></svg>
                        </span>
                    </div>
                    <div class="mt-4">
                        <span class="text-base font-medium">760</span>
                    </div>
                </div>
            </div>
            <div class="w-1/3 px-3">
                <div class="bg-purple-50 rounded shadow px-4 py-4">
                    <div class="flex justify-between items-baseline">
                        <h3 class="font-bold text-lg text-purple-700">Order</h3>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 fill-current text-purple-700">
                                <path fill="none" d="M0 0h24v24H0z"/>
                                <path d="M15 5h2a2 2 0 0 1 2 2v8.17a3.001 3.001 0 1 1-2 0V7h-2v3l-4.5-4L15 2v3zM5 8.83a3.001 3.001 0 1 1 2 0v6.34a3.001 3.001 0 1 1-2 0V8.83zM6 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 12a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm12 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            </svg>
                        </span>
                    </div>
                    <div class="mt-4">
                        <span class="text-base font-medium">12,456</span>
                    </div>
                </div>
            </div>
            <div class="w-1/3 px-3">
                <div class="bg-purple-50 rounded shadow px-4 py-4">
                    <div class="flex justify-between items-baseline">
                        <h3 class="font-bold text-lg text-purple-700">Sales</h3>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 fill-current text-purple-700">
                                <path fill="none" d="M0 0h24v24H0z"/>
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.5-6H14a.5.5 0 1 0 0-1h-4a2.5 2.5 0 1 1 0-5h1V6h2v2h2.5v2H10a.5.5 0 1 0 0 1h4a2.5 2.5 0 1 1 0 5h-1v2h-2v-2H8.5v-2z"/>
                            </svg>
                        </span>
                    </div>
                    <div class="mt-4">
                        <span class="text-base font-medium">Tsh 12,765,000.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Orders --}}
    <div class="bg-white shadow rounded mt-8">
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
