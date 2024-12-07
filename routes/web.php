<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ShippingAddresseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Shipping Address Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('shipping-addresses', [ShippingAddresseController::class, 'index']);
    Route::post('shipping-addresses', [ShippingAddresseController::class, 'store']);
    Route::get('all-shipping-addresses', [ShippingAddresseController::class, 'adminIndex']);
    Route::get('all-user-shipping-addresses', [ShippingAddresseController::class, 'userShippingIndex']);
    Route::get('shipping-addresses/{id}', [ShippingAddresseController::class, 'show']);
    Route::post('shipping-addresses/{id}', [ShippingAddresseController::class, 'update']);
    Route::delete('shipping-addresses/{id}', [ShippingAddresseController::class, 'destroy']);
});

// Order Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('all-orders', [OrderController::class, 'orderWithShippingAddress']);
    Route::get('all-user-orders', [OrderController::class, 'userOrderIndex']);
    //Route::get('all-user-orders-shipping-address', [OrderController::class, 'orderWithShippingAddress']);
    Route::post('create-orders', [OrderController::class, 'store']);
    Route::get('orders/{id}', [OrderController::class, 'show']);
    Route::post('update-orders/{id}', [OrderController::class, 'update']);
    Route::delete('orders/{id}', [OrderController::class, 'destroy']);
});

// Notification Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::get('all-notifications', [NotificationController::class, 'adminIndex']);
    Route::get('all-user-notifications', [NotificationController::class, 'userNotificationIndex']);
    Route::post('notifications', [NotificationController::class, 'store']);
    Route::get('notifications/{id}', [NotificationController::class, 'show']);
    Route::post('notifications/{id}', [NotificationController::class, 'update']);
    Route::delete('notifications/{id}', [NotificationController::class, 'destroy']);
    Route::post('notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);
});

require __DIR__.'/auth.php';
