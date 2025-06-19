<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;

Route::get('/', [ProductController::class, 'index']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/cart/add/{product_code}', [CartController::class, 'add']);
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/checkout', [CartController::class, 'checkout']);
Route::post('/cart/increase/{product_code}', [CartController::class, 'increase']);
Route::post('/cart/decrease/{product_code}', [CartController::class, 'decrease']);
Route::post('/cart/remove/{product_code}', [CartController::class, 'remove']);
Route::post('/cart/clear', [CartController::class, 'clear']);
Route::get('/orders', function () {
    $orders = \App\Models\Order::with('items.product')->where('user_id', Auth::id())->get();
    return view('orders.index', compact('orders'));
})->middleware('auth');

Route::get('/admin', [AdminController::class, 'dashboard']);
Route::get('/admin/products/create', [AdminController::class, 'create']);
Route::post('/admin/products', [AdminController::class, 'store']);
Route::get('/admin/products/{product_code}/edit', [AdminController::class, 'edit']);
Route::put('/admin/products/{product_code}', [AdminController::class, 'update']);
Route::delete('/admin/products/{product_code}', [AdminController::class, 'destroy']);
Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
