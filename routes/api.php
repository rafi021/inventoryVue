<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::apiResource('/employee', 'API\EmployeeController');
Route::apiResource('/supplier', 'API\SupplierController');
Route::apiResource('/category', 'API\CategoryController');
Route::apiResource('/product', 'API\ProductController');
Route::apiResource('/expense', 'API\ExpenseController');
Route::apiResource('/salary', 'API\SalaryController');
Route::apiResource('/customer', 'API\CustomerController');

Route::get('/salary/details/{id}','API\SalaryController@showSalary');
Route::get('/getting/product/{id}','API\POSController@getProduct');
Route::get('/add-to-cart/{id}','API\CartController@alltToCart');
Route::get('/remove-from-cart/{id}','API\CartController@removeFromCart');
Route::get('/cart/product','API\CartController@allCartProduct');

Route::get('/add-to-cart/inc/{id}','API\CartController@incrementCart');
Route::get('/add-to-cart/dec/{id}','API\CartController@decrementCart');
Route::post('/order', 'API\POSController@orderStore');

Route::get('/orders/today', 'API\OrderController@todayOrders');
Route::get('/orders/all', 'API\OrderController@allOrders');
Route::get('/orders/details/{id}', 'API\OrderController@orderDetail');