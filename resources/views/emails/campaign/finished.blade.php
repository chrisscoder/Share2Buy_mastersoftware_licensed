@component('mail::message')
# Your campaign just finished

It's our pleasure to let you know that you sold **{{$order_qty}} x {{$product_title}}** during your campaign.

@component('mail::button', ['url' => $url])
Complete your orders
@endcomponent

Please note, that your items must be shipped 1-3 business days from today.

Team {{ config('app.name') }}
@endcomponent
