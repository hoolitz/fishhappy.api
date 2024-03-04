@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded">
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <h2 class="font-medium text-gray-700 leading-5">Products</h2>

            <a
                href="{{ route("products.create") }}"
                class="bg-purple-600 text-sm text-white leading-6 font-medium py-2 px-4 rounded hover:bg-purple-500"
            >New product</a>
        </div>

        <div class="text-sm mb-12">
            <table class="w-full">
                <thead>
                <tr>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Image</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Name</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Category</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Price</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100">Weight</th>
                    <th class="py-3 px-4 text-left text-sm text-gray-500 font-medium bg-gray-50 border-b border-gray-100"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-100  ">
                            <img src="{{ asset('storage/'.$product->imageUrl) }}" class="h-8" alt="Example Image">
                        </td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-100">
                            {{ $product->name }}
                        </td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-100">
                            {{ $product->category->name }}
                        </td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-100">
                            Tsh {{ number_format($product->price, 2) }}
                        </td>
                        <td class="text-left text-sm text-gray-700 py-4 px-4 border-b border-gray-100">
                            {{ $product->weight .' '.  $product->weight_unit }}
                        </td>
                        <td class="text-left text-sm text-gray-700 py-4 px-6 border-b border-gray-100 flex items-center justify-between" >
                            <a href="#" class="text-sm font-medium text-purple-500 ">View</a>
                            <a href="{{ route('products.destroy', ['product' => $product->id]) }}"
                               onclick="event.preventDefault();
                               document.getElementById('delete-product-form-{{ $product->id }}').submit();"
                               class="bg-red-500 hover:bg-red-500 text-white font-bold py-2 px-4 rounded">Delete</a>
                        </td>
                    </tr>

                    <form id="delete-product-form-{{ $product->id }}"
                          action="{{ route('products.destroy', ['product' => $product->id]) }}"
                          method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




@endsection
