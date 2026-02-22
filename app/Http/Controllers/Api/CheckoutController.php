<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array',
            'items.*.variant_id' => 'required|exists:product_variants,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Create order
            $order = Order::create([
                'customer_id' => $request->customer_id,
                'order_number' => 'ORD-' . now()->format('YmdHis'),
                'status' => 'pending',
                'total_amount' => 0, // will calculate later
            ]);

            $total = 0;
            foreach ($request->items as $item) {
                $variant = ProductVariant::find($item['variant_id']);

                // Stock validation
                if ($variant->stock < $item['quantity']) {
                    throw new \Exception("Variant ID {$variant->id} is out of stock.");
                }

                $price = $variant->price ?? $variant->product->base_price;
                $subtotal = $price * $item['quantity'];
                $total += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $variant->product_id,
                    'product_variant_id' => $variant->id,
                    'product_name' => $variant->product->name,
                    'variant_attributes' => $variant->attributes,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'total' => $subtotal,
                ]);
            }

            $order->update(['total_amount' => $total]);
            DB::commit();

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'total_amount' => $total,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}