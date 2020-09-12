@component('mail::message')
# Congratulations! Your campaign sold out!

We're happy to let you know you that **{{$product_title}}** was so popular that it sold out before time.

@component('mail::button', ['url' => $url])
Complete your orders
@endcomponent

Please note, that your items must be shipped 1-3 business days from today.

Team {{ config('app.name') }}
@endcomponent
