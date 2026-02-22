<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/order/{order}/invoice', [App\Http\Controllers\OrderInvoiceController::class, 'print']);