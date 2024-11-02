<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
// api/v1/
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);
    Route::apiResource('users',UserController::class);
    Route::post('invoices/bulk', ['uses' => 'InvoiceController@bulkStore']);
});

Route::get('v1/customers',['uses'=>'App\Http\Controllers\Api\V1\CustomerController@index']);
Route::get('v1/customers/{customer}',['uses'=>'App\Http\Controllers\Api\V1\CustomerController@show']);
Route::get('v1/invoices/{invoice}',['uses'=>'App\Http\Controllers\Api\V1\InvoiceController@show']);
Route::post('v1/users',['uses'=>'App\Http\Controllers\Api\V1\UserController@store']);
Route::get('v1/invoices',['uses'=>'App\Http\Controllers\Api\V1\InvoiceController@index']);
