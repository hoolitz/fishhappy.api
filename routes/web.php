<?php

Auth::routes();
Route::get('/', "welcomeController")->name("welcome");
Route::get('/home', 'HomeController')->name('home');
Route::get('users', 'UsersController@index')->name('users.index');
Route::post('users', 'UsersController@store')->name('users.store');
Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy');
Route::get('product-categories', 'ProductCategoriesController@index')->name('productCategories.index');
Route::post('product-categories', 'ProductCategoriesController@store')->name('productCategories.store');
Route::put('product-categories', 'ProductCategoriesController@update')->name('productCategories.update');



Route::delete('product-categories', 'ProductCategoriesController@destroy')->name('productCategories.destroy');
Route::get('products', 'ProductsController@index')->name("products.index");
Route::get('products/create', 'ProductsController@create')->name("products.create");
Route::post('products', 'ProductsController@store')->name("products.store");
Route::get('products/{product}', 'ProductsController@show')->name("products.show");
Route::get('products/{product}/edit', 'ProductsController@edit')->name("products.edit");
Route::put('products/{product}', 'ProductsController@update')->name("products.update");
Route::delete('products/{product}', 'ProductsController@destroy')->name("products.destroy");
Route::get('customers', 'CustomersController@index')->name('customers.index');
Route::get('customers/{customers}', 'CustomersController@show')->name('customers.show');
Route::get('orders', 'OrdersController@index')->name('orders.index');
Route::get('orders/{order}', 'OrdersController@show')->name('orders.show');
Route::put("order/update-status/{status}", 'OrdersController@updateStatu    s')->name('order.update.status');
Route::get('order-confirmations', 'OrderConfirmationsController@update')->name('orderConfirmations.update');
Route::get('payments', 'PaymentsController@index')->name('payments.index');
Route::get('payments/{payment}', 'PaymentsController@show')->name('payments.show');
