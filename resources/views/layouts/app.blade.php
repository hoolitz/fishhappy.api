@extends('layouts.base')

@section('body')
    <div class="container max-w-screen-lg mx-auto">
        <div class="flex items-center justify-between py-12">
            <ul class="flex items-center space-x-6">
                <li>
                    <a
                        href="{{ route('home') }}"
                        class="text-sm font-medium @if(Route::is("home")) text-purple-800 @endif"
                    >Dashboard</a>
                </li>
                <li>
                    <a
                        href="{{ route('customers.index') }}"
                        class="text-sm font-medium @if(Route::is("customers.*")) text-purple-800 @endif"
                    >Customers</a>
                </li>
                <li class="">
                    <a
                        href="{{ route('orders.index') }}"
                        class="text-sm font-medium @if(Route::is("orders.*")) text-purple-800 @endif"
                    >Orders</a>
                </li>
                <li class="">
                    <a
                        href="{{ route('payments.index') }}"
                        class="text-sm font-medium @if(Route::is("payments.*")) text-purple-800 @endif"
                    >Payments</a>
                </li>
                <li class="">
                    <a
                        href="{{ route('products.index') }}"
                        class="text-sm font-medium @if(Route::is("products.*")) text-purple-800 @endif"
                    >Products</a>
                </li>
                <li class="">
                    <a
                        href="{{ route('productCategories.index') }}"
                        class="text-sm font-medium @if(Route::is("productCategories.*")) text-purple-800 @endif"
                    >Categories</a>
                </li>
            </ul>

            <div>
                <a
                    class="text-sm font-medium"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >{{ __('Logout') }}</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        <div>
            @yield('content')
        </div>
    </div>
@endsection
