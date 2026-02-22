<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     */
   public function updating(Order $order)
    {
        // When order status changes to "processing"
        if ($order->isDirty('status') && $order->status === 'processing') {
            foreach ($order->items as $item) {
                if ($item->product_variant_id) {
                    $variant = $item->variant;
                    $variant->stock -= $item->quantity;
                    $variant->save();
                }
            }
        }
    }


    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
