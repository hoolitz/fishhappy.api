<?php

Route::post("cstmr/login", "Api\LoginController");
Route::post("cstmr/register", "Api\RegisterController");
Route::get("cstmr", "Api\CustomerController");
Route::post("cstmr/change_password", "Api\ChangePasswordController");
Route::post("cstmr/password/reset", "Api\ResetPasswordController");
Route::post("cstmr/password/email", "Api\ForgotPasswordController");
Route::get("cstmr/categories", "Api\CategoriesController");
Route::get("cstmr/products", "Api\ProductsController@index");
Route::get("cstmr/products/{product}", "Api\ProductsController@show");
Route::get("cstmr/orders", "Api\OrdersController@index");
Route::get("cstmr/orders/{order}", "Api\OrdersController@show");
Route::post("cstmr/orders", "Api\OrdersController@store");
Route::post("cstmr/orders/{order}/cancel", "Api\OrderCancelController");
Route::post("cstmr/orders/{order}/confirm", "Api\OrderConfirmController");
Route::post("cstmr/products/{product}/favourites", "Api\ProductFavouriteController@store");
Route::delete("cstmr/products/{product}/favourites", "Api\ProductFavouriteController@destroy");
Route::get("cstmr/orders/{order}/payments", "Api\PaymentsController");



