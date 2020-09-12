<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Carbon\Carbon;

class CampaignActivated extends Notification implements ShouldQueue
{
    use Queueable;

    public $product;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
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
        $url = url('/admin/dashboard/');
        $dateTimeFormat = 'D, M d, Y H:i';

        return (new MailMessage)
                    ->greeting('Hi ' . $this->product->designer->title)
                    ->line('Your product ' . $this->product->title . ' is now active at modsvar.com')
                    ->line('Campaign period: ' . Carbon::parse($this->product->start_date)->format($dateTimeFormat) . ' – ' . Carbon::parse($this->product->end_date)->format($dateTimeFormat))
                    ->action('Go to dashboard ', $url)
                    ->line('Thank you for using our platform!');
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
