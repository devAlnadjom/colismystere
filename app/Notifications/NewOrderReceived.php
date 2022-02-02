<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderReceived extends Notification
{
    use Queueable;

    private Order $order;

    public function __construct($order)
    {
        //
        $this->order= $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("New Order")
                    ->from('Commercial@devalnadjom.com', 'Service de Notification')
                    ->greeting('Hi!')
                    ->line('A new order Has been placed.')
                    ->line('Order: '.$this->order->id. " - ".$this->order->sha_key)
                    ->line('Total: '.$this->order->total. " | Premium: ".$this->order->recipient_premium)
                    ->action('Notification Action', route("order.tracking",['id'=>$this->order->id,'key'=>$this->order->sha_key]))
                    ->line('Thank you.!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
