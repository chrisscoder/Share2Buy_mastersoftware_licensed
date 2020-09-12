
@extends('layouts.app')

@section('content')
  <section class="space-l checkout-success">
    <h1 class="sr-only">Checkout</h1>
    <div class="space-l-bottom">
      <div class="container">
        <div class="row">
          <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3 text-center">
            <h3>Thank you for your order!</h3>
            <p>
              We’ll send you an order confirmation shortly. You'll receive your receipt with your final discount as soon as the designer has processed your order.
            </p>
          </div>
        </div>
      </div>
    </div>
    <section class="space-l white relative text-center">
      <div class="container">
        <div class="row">
          <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3 space-m-bottom">
            @if ($product->unhandledOrderCount == 10)
              <h2>WOOHOO!</h2>
              <p>You bought the last product! The crowd will definitely appreciate it!</p>
              <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                  <a class="btn btn-cta btn-block btn-lg space-top" href="{{action('ProductController@index')}}">Find more campaigns</a>
                </div>
              </div>
            @else
              <h2>Save even more!</h2>
              <p class="strong">Get one more to join the campaign, and the whole crowd will reach the next price: {{ number_format($product->priceIncCommission, 2, ',', '.') }} DKK</p>
            @endif
          </div>
        </div>
        @if ($product->unhandledOrderCount < 10)
        <div class="icon-row social-icons text-center">
          <ul>
            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ $product->absUrl }}" target="_blank"><span class="sr-only">Invite crowd shoppers on FaceBook</span><svg class="icon icon-social-facebook"><use xlink:href="#icon-social-facebook"></use></svg></a></li>
            <li><a href="https://twitter.com/home?status=Crowd%20shop%20%23{{ str_replace(' ', '', $product->designer->title)}}%20%23interiordesign%20and%20%23fashion%20on%20{{ $product->absUrl }}" target="_blank"><span class="sr-only">Invite crowd shoppers on Twitter</span><svg class="icon icon-social-twitter"><use xlink:href="#icon-social-twitter"></use></svg></a></li>
            <li><a href="https://pinterest.com/pin/create/button/?url={{ $product->absUrl }}&media={{ url('/').$product->images['sectionTopImage']['X2'] }}&description=Crowd%20shop%20interior%20design%20and%20fashion%20on%20modsvar.com%20by%20{{ str_replace(' ', '%20', $product->designer->title) }}" target="_blank"><span class="sr-only">Invite crowd shoppers on Pinterest</span><svg class="icon icon-social-pinterest"><use xlink:href="#icon-social-pinterest"></use></svg></a></li>
          </ul>
        </div>
        @endif
      </div>
    </section>
    <section class="space-l">
      <div class="container">
        <h2 class="text-center">
          <small class="manchet">
            <span>You might also like</span>
          </small>
        </h2>
        <div class="row space-l-top flex-row">
          @foreach ($popularProducts as $key => $product)
            @include('partials/shop-module')
          @endforeach

        </div>
        <div class="row">
          <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
            <a class="btn btn-default btn-block btn-lg space-top" href="{{action('ProductController@index')}}">Explore all</a>
          </div>
        </div>
      </div>
    </section>
  </section>

@endsection
