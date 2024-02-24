<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view('product-categories.index', [
            "categories" => ProductCategory::latest()->paginate()
        ]);
    }

    public function store(Request $request)
    {
        ProductCategory::create($request->validate([
            "name" => ["required", "string", "max:255"],
            "description" => ["required", "string"],
        ]));

        return redirect()->route('productCategories.index');
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->validate([
            "name" => "required",
            "description" => "required",
        ]));

        $request->session()->flash('productCategory.name', $productCategory->name);

        return redirect()->route('product-categories.index');
    }


    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        return redirect()->route('product-categories.index');
    }
}
