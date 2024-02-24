<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductFavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Product $product)
    {
        if ($product->favorites()->where("customer_id", auth("api")->id())->exists()) {
            return response([
                "message" => "Product already existed in your favourite list."
            ], 200);
        }

        $product->favorites()->attach(auth("api")->user());

        return response([], 200);
    }

    public function destroy(Product $product)
    {
        if ($product->favorites()->where("customer_id", auth("api")->id())->exists()) {
            $product->favorites()->detach(auth("api")->user());
        }

        return response([], 200);
    }
}
