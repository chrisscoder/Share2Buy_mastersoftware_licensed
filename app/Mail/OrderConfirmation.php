<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    protected $product;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, Product $product)
    {
        $this->order = $order;
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        setlocale(LC_MONETARY, 'da_DK');

        return $this->from('support@modsvar.com')
                    ->view('emails.orders.confirm')
                    ->with([
                        'id' => $this->order->id,
                        'customer_name' => $this->order->name,
                        'customer_address' => $this->order->address,
                        'customer_postal' => $this->order->postal,
                        'customer_city' => $this->order->city,
                        'customer_country' => 'Denmark',
                        'order_date' => Carbon::createFromFormat('Y-m-d H:i:s', $this->order->created_at)->format('D, M d, Y H:i'),
                        'order_quantity' => $this->order->quantity,
                        'order_price' => money_format('%.2n', $this->order->price),
                        'order_total' => money_format('%.2n', $this->order->total),
                        'order_currency' => 'DKK',
                        'order_size' => $this->order->size,
                        'end_date' => Carbon::createFromFormat('Y-m-d H:i:s', $this->product->end_date)->format('D, M d, Y H:i'),
                        'designer' => $this->product->designer->title,
                        'product_title' => $this->product->title,
                        'product_url' => action('ProductController@show',$this->product->slug),
                        'product_image' => $this->product->image('sectionTopImage', 'thumb')
                    ]);
    }
}
