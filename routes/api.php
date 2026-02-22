<?php
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CheckoutController;


Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::post('/checkout', [CheckoutController::class, 'store']);