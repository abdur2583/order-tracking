<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingAddresseController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Shipping Address Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('shipping-addresses', [ShippingAddresseController::class, 'index']);
    Route::post('shipping-addresses', [ShippingAddresseController::class, 'store']);
    Route::get('all-user-shipping-addresses', [ShippingAddresseController::class, 'userShippingIndex']);
    Route::get('shipping-addresses/{id}', [ShippingAddresseController::class, 'show']);
    Route::post('shipping-addresses/{id}', [ShippingAddresseController::class, 'update']);
    Route::delete('shipping-addresses/{id}', [ShippingAddresseController::class, 'destroy']);
});