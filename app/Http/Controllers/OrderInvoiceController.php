<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderInvoiceController extends Controller
{
    public function print(Order $order)
    {
        $order->load(['items', 'customer']);
        return view('orders.invoice', compact('order'));
    }
}