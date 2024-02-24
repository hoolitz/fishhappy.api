<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return response(Product::all(), 200);
    }

    public function show(Product $product)
    {
        return response($product, 200);
    }
}
