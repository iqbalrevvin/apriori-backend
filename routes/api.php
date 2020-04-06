<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->post('login', 'UserController@index');
Route::get('product', 'ProductController@index');
Route::get('stock', 'StockController@index');
Route::get('transaction', 'TransactionController@index');
Route::get('iterasi1', 'TransactionController@iterasi1');
