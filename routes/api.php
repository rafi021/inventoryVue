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

Route::get('/salary/details/{id}','API\SalaryController@showSalary');