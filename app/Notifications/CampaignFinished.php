<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CampaignFinished extends Notification
{
    use Queueable;

    public $product, $quantitySum;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($product, $quantitySum)
    {
        $this->product = $product;
        $this->quantitySum = $quantitySum;
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
        return (new MailMessage)->markdown('emails.campaign.finished',[
            'url' => url('/products/orders', [$this->product->id]),
            'product_title' => $this->product->title,
            'order_qty' => $this->quantitySum
        ]);
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
