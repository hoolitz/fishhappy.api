@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded">
        <div class="border-b border-gray-200">
            <h2 class="px-6 py-5 font-medium text-gray-700">Payments</h2>
        </div>

        <div class="text-sm mb-12">
            <table class="w-full">
                <thead>
                <tr>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-100 border-b border-gray-200">Customer</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-100 border-b border-gray-200">Product</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-100 border-b border-gray-200">Price</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-100 border-b border-gray-200">Quantity</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-100 border-b border-gray-200">Total amount</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-100 border-b border-gray-200">Status</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-100 border-b border-gray-200">Time</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-100 border-b border-gray-200"></th>
                </tr>
                </thead>
                <tbody>
                @foreach(range(1, 15) as $customer)
                    <tr>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-200">David Pella</td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-200">Kibua</td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-200">7500.00</td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-200">4KG</td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-200">
                            <span class="text-gray-800 font-medium">30,000.00</span>
                        </td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-200">Paid</td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-200">
                            <a href="#" class="text-sm font-medium text-purple-500">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
