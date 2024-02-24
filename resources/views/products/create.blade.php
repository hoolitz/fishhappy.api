@extends('layouts.app')

@section('content')
    <form action="{{ route('products.store') }}" method="POST" class="w-4/5 mx-auto bg-white shadow rounded overflow-hidden">
        @csrf

        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200">
            <h2 class="font-medium text-gray-700 leading-5">New product</h2>
        </div>

        <div class="text-sm">
            <div class="px-6 space-y-6 py-8">
                <div class="flex -mx-3">
                    <div class="w-2/3 px-3">
                        <label for="name" class="text-sm text-gray-600 font-medium">Name</label>
                        <input type="text" name="name" id="name" class="form-input w-full text-sm mt-2" placeholder="King fish..." />
                    </div>
                    <div class="w-1/3 px-3">
                        <label for="price" class="text-sm text-gray-600 font-medium">Price</label>
                        <input type="text" name="price" id="price" class="form-input w-full text-sm mt-2" placeholder="0.00" />
                    </div>
                </div>
                <div class="flex -mx-3">
                    <div class="w-1/3 px-3">
                        <label for="weight" class="text-sm text-gray-600 font-medium">Weight</label>
                        <div class="flex border mt-2 rounded">
                            <input
                                type="text"
                                name="weight"
                                id="weight"
                                class="form-input w-full text-sm border-0"
                                placeholder="0.00"
                            />
                            <select name="weight_unit" aria-label="weight_unit" class="form-select border-0 text-sm">
                                <option value="kg">KG</option>
                                <option value="gm">KG</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-2/3 px-3">
                        <label for="category_id" class="text-sm text-gray-600 font-medium">Category</label>
                        <select name="category_id" id="category_id" class="form-select w-full text-sm mt-2">
                            <option value="">Choose...</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex -mx-3">
                    <div class="w-full px-3">
                        <label for="description" class="text-sm text-gray-600 font-medium">Description</label>
                        <textarea name="description" id="description" class="form-input w-full text-sm mt-2" rows="5" placeholder="Type something..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 px-6 py-4">
            <button type="submit" class="bg-purple-600 text-sm text-white leading-6 font-medium py-2 px-4 rounded hover:bg-purple-500">Save changes</button>
        </div>
    </form>
@endsection
