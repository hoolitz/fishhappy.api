<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductFavouriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'cstmr'], function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/',[CustomerController::class,'__invoke']);
    Route::get("/categories", [CategoriesController::class, '__invoke']);
    Route::get("/products", [ProductsController::class,"index"]);
    Route::get("/products/{product}", [ProductsController::class,"show"]);
    Route::get("/orders", [OrdersController::class,"index"]);

    Route::post("/orders", [OrdersController::class,"store"]);


    Route::get("/orders/{order}", [OrdersController::class,"show"]);
    //End-points to test.
    Route::post("/products/{product}/favourites", [ProductFavouriteController::class,'store']);
    Route::delete("/products/{product}/favourites", [ProductFavouriteController::class,'destroy']);


    Route::post("/change_password", "Api\ChangePasswordController");
    Route::post("/password/reset", "Api\ResetPasswordController");
    Route::post("/password/email", "Api\ForgotPasswordController");



//    Route::get("/products/{product}", "Api\ProductsController@show");
//    Route::get("/orders", "Api\OrdersController@index");
//    Route::get("/orders/{order}", "Api\OrdersController@show");
//    Route::post("/orders", "Api\OrdersController@store");
    Route::post("/orders/{order}/cancel", "Api\OrderCancelController");
    Route::post("/orders/{order}/confirm", "Api\OrderConfirmController");
    Route::get("/orders/{order}/payments", "Api\PaymentsController");
});






