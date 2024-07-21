<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Stock;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateStock
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        Stock::query()->where('product_name', $event->order->product_name)->decrement('quantity', $event->order->quantity);
    }
}
