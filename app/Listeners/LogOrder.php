<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Notifications\PushOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogOrder
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
        $content = "Người dùng {$event->user->id} đã tạo đơn hàng {$event->order->id}";
        Log::channel('db')->info($content);
    }
}
