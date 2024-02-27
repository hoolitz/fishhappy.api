<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'cstmr'], function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/',[CustomerController::class,'__invoke']);

    Route::post("/change_password", "Api\ChangePasswordController");
    Route::post("/password/reset", "Api\ResetPasswordController");
    Route::post("/password/email", "Api\ForgotPasswordController");
    Route::get("/categories", "Api\CategoriesController");
    Route::get("/products", "Api\ProductsController@index");
    Route::get("/products/{product}", "Api\ProductsController@show");
    Route::get("/orders", "Api\OrdersController@index");
    Route::get("/orders/{order}", "Api\OrdersController@show");
    Route::post("/orders", "Api\OrdersController@store");
    Route::post("/orders/{order}/cancel", "Api\OrderCancelController");
    Route::post("/orders/{order}/confirm", "Api\OrderConfirmController");
    Route::post("/products/{product}/favourites", "Api\ProductFavouriteController@store");
    Route::delete("/products/{product}/favourites", "Api\ProductFavouriteController@destroy");
    Route::get("/orders/{order}/payments", "Api\PaymentsController");
});






