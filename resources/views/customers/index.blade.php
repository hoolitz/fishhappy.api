@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded">
        <div class="border-b border-gray-100">
            <h2 class="px-6 py-5 font-medium text-gray-700">Customers</h2>
        </div>

        <div class="text-sm mb-12">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Name</th>
                        <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Email</th>
                        <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Phone</th>
                        <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Orders</th>
                        <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-100">{{ $customer->name }}</td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-100">{{ $customer->email }}</td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-100">{{ $customer->phone }}</td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-100">{{ $customer->orders_count }}</td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-100">
                            <a href="#" class="text-sm font-medium text-purple-500">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
