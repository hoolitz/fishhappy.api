<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __invoke()
    {
        return response(ProductCategory::all(), 200);
    }
}
