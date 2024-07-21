<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class OrderNotification extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new notification instance.
     */
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Bạn đã đặt hàng thành công.')
                    ->line('Tên sản phẩm:' . $this->order->product_name)
                    ->line('Giá:' . $this->order->price)
                    ->line('Số lượng:' . $this->order->quantity)
                    ->action('Notification Action', url('/'))
                    ->line('Cảm ơn bạn đã đặt hàng!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         'order_id' => $this->order->id,
    //         'message' => 'Your order has been placed successfully!'
    //     ];
    // }

    public function toDatabase(object $notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'Your order has been placed successfully!',
        ];
    }
}
