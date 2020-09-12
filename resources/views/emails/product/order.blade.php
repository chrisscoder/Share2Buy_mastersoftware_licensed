@component('mail::message')
# Congrats

We are happy to let you know, that a customer just bought {{ $order_qty }} x {{ $product_title }}.<br />
Feel free to ship your product{{ $order_qty > 1 ? 's' : '' }}!

@component('mail::button', ['url' => $url])
View order
@endcomponent

Thank you for using our platform.

Team {{ config('app.name') }}
@endcomponent
