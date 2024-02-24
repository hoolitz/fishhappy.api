<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view('products.index', [
            "products" => Product::latest()->paginate()
        ]);
    }

    public function create()
    {
        return view('products.create', [
            "categories" => ProductCategory::all()
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->only([
            'name',
            'price',
            'weight',
            'weight_unit',
            'description',
            'category_id',
        ]));

        $request->session()->flash('product.name', $product->name);

        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        return view('products.show', [
            "product" => $product
        ]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
            'categories' => ProductCategory::all()
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->all());

        $request->session()->flash('product.name', $product->name);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
