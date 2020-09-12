
@extends('layouts.app')

@section('content')
<section class="space-l checkout">

  <div class="container">
    <div class="row flex-row-sm">
      <div class="col-sm-12 col-lg-8 space-bottom">
        <div class="thumbnail featured">
          <a class="thumb-link" href="{{action('ProductController@show', $product->slug)}}">
            <div class="ratio-container">
              <div class="ratio ratio-16-9">
                <picture class="ratio-content">
                  <!--[if IE 9]><video style="display: none;"><![endif]-->
                  <source media="(max-width: 480px)" sizes="100vw" srcset="{{ $product->image('headerImage', 'small.16:9') }} 360w, {{ $product->image('headerImage', 'medium.16:9') }} 720w">
                  <source sizes="100vw" srcset="{{ $product->image('headerImage', 'medium.16:9') }} 720w, {{ $product->image('headerImage', 'large.16:9') }} 1920w">
                  <!--[if IE 9]></video><![endif]-->
                  <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{ $product->image('headerImage', 'medium.16:9') }} 720w, {{ $product->image('headerImage', 'large.16:9') }} 1920w" alt="{{ $product->headerImageAlt}}">
                </picture>
              </div>
            </div>
            <div class="caption">
              <h3 class="product-name">{{$product->title}}</h3>
              <h4 class="designer">{{$product->designer->title}}</h4>
              <p class="flex-text">
                <span class="block">Material: {{$product->materials}}</span><br>
                <span class="block">Size: {{$size}}</span>
              </p>
              <div class="campaign-info">
                <div class="campaign-countdown">
                  <svg class="icon icon-ios-clock-outline"><use xlink:href="#icon-ios-clock-outline"></use></svg>
                  <div class="countdown" data-countdown data-date="{{$product->endDateUTC}}" data-selected-period="{{$product->periode}}"></div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-12 col-lg-4 space-bottom">
        <div class="card card-overview">
          <h2 class="small">Order Summary</h2>
          <ul class="card-list">
            <li class="card-list-item"><span>Quantity</span><span class="text-left">{{ Session::get('quantity') }}</span></li>
            <li class="card-list-item"><span>Price per item</span><span class="">{{ number_format($priceIncCommission, 2, ',', '.') }} kr</span></li>
            <li class="card-list-item card-list-item-underline"><span>Shipping (within DK)</span><span class="green strong">Free</span></li>
            <li class="card-list-item"><span>Before</span><s>{{ number_format($product->price * Session::get('quantity'), 2, ',', '.') }} kr</s></li>
            <li class="card-list-item"><span class="strong text-uppercase">Total</span><span class="strong">{{ number_format($priceTotal, 2, ',', '.') }} kr</span></li>
            <li class="card-list-item"><span>You save</span><span class="">{{ number_format($discount, 2, ',', '.') }} kr</span></li>
          </ul>
        </div>
      </div>

      <div class="col-xs-12">
        <form name="modsvar" action="{{ action('PagesController@checkoutOrderReserve') }}" method="post" novalidate class="row">

          <div class="col-sm-12 col-lg-8">
            <div class="card">
              <h2 class="small">Billing and Shipping Info</h2>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group" data-ng-class="{'has-error':!modsvar.name.$valid && modsvar.name.$touched}">
                <label for="name">Full name</label>
                <div class="inner-form-group">
                  <input type="text" name="name" data-ng-model="post.name" data-ng-pattern="/^[a-zA-Z æøåäöÆØÅÄÖéÉíÍ \'\-\s]{4,55}$/" class="form-control" placeholder="" required autocomplete="shipping name">
                  <svg class="icon icon-ios-checkmark-empty form-feedback" data-ng-cloak data-ng-class="{'text-success success-reveal':modsvar.name.$valid, 'hidden':!modsvar.name.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                </div>
                <span class="help-block text-warning" data-ng-cloak data-ng-if="!modsvar.name.$valid && modsvar.name.$touched">* Please fill in your name. Only the Latin alphabet, spaces and hyphens are allowed.</span>
              </div>
              <div class="form-group" data-ng-class="{'has-error':!modsvar.address.$valid && modsvar.address.$touched}">
                <label for="address">Address</label>
                <div class="inner-form-group">
                  <input type="text" name="address" data-ng-model="post.address" data-ng-pattern="/^(?=.*[0-9])(?=.*[a-zA-Z æøåäöÆØÅÄÖéÉíÍ])([\w æøåäöÆØÅÄÖéÉíÍ .,\-\s]+)$/" class="form-control" placeholder="" required autocomplete="shipping street-address">
                  <svg class="icon icon-ios-checkmark-empty form-feedback" data-ng-cloak data-ng-class="{'text-success':modsvar.address.$valid, 'hidden':!modsvar.address.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                </div>
                <span class="help-block text-warning" data-ng-cloak data-ng-if="!modsvar.address.$valid && modsvar.address.$touched">* Please fill in your address and house number. Only the Latin alphabet, spaces, full stops, commas and hyphens are allowed.</span>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group" data-ng-class="{'has-error':!modsvar.postal.$valid && modsvar.postal.$touched}">
                    <label for="postal">Postcode / ZIP</label>
                    <div class="inner-form-group">
                      <input type="text" name="postal" data-ng-model="post.postal" data-ng-pattern="/^[0-9 \-\s]{3,10}$/" class="form-control" placeholder="" required autocomplete="shipping postal-code">
                      <svg class="icon icon-ios-checkmark-empty form-feedback" data-ng-cloak data-ng-class="{'text-success':modsvar.postal.$valid, 'hidden':!modsvar.postal.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                    </div>
                    <span class="help-block text-warning" data-ng-cloak data-ng-if="!modsvar.postal.$valid && modsvar.postal.$touched">* Please fill in your postcode/zip. Only numbers are allowed.</span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group" data-ng-class="{'has-error':!modsvar.city.$valid && modsvar.city.$touched}">
                    <label for="city">City</label>
                    <div class="inner-form-group">
                      <input type="text" name="city" data-ng-model="post.city" data-ng-pattern="/^[a-zA-Z æøåäöÆØÅÄÖéÉíÍ .,\-\s]{2,55}$/" class="form-control" placeholder="" required autocomplete="shipping address-level2">
                      <svg class="icon icon-ios-checkmark-empty form-feedback" data-ng-cloak data-ng-class="{'text-success':modsvar.city.$valid, 'hidden':!modsvar.city.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                    </div>
                    <span class="help-block text-warning" data-ng-cloak data-ng-if="!modsvar.city.$valid && modsvar.city.$touched">* Please fill in your city. Only the Latin alphabet, spaces and hyphens are allowed.</span>
                  </div>
                </div>
              </div>
              <div class="form-group" data-ng-class="{'has-error':!modsvar.email.$valid && modsvar.email.$touched}">
                <label for="email">Email</label>
                <div class="inner-form-group">
                  <input type="email" name="email" data-ng-model="post.email" data-ng-pattern="/^(([^<>()\[\]\\.,;:\s@']+(\.[^<>()\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/" class="form-control" id="email" placeholder="" required autocomplete="shipping home email">
                  <svg class="icon icon-ios-checkmark-empty form-feedback" data-ng-cloak data-ng-class="{'text-success':modsvar.email.$valid, 'hidden':!modsvar.email.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                </div>
                <span class="help-block text-warning" data-ng-cloak data-ng-if="!modsvar.email.$valid && modsvar.email.$touched">* Please fill in your email address.</span>
              </div>
              <div class="form-group">
                <label for="comment">Order notes (optional)</label>
                <textarea name="comment" id="comment" class="form-control" placeholder="" rows="2"></textarea>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-lg-8 space-top">
            <div class="card card-payment">
              <h2 class="small">Secure Credit Card Payment</h2>
              <div class="space-bottom">
                <div class="form-group">
                  <input type="checkbox" name="approve" id="approve" data-ng-model="post.approve" data-ng-class="{'text-success': modsvar.approve.$valid}" required>
                  <label for="approve" class="approve">By completing your order, you accept our <a style="display:inline; color: #30383c; text-decoration: none; border-bottom: 1px dotted #00b298;" href="{{url('terms-and-conditions')}}" target="_blank">Terms and Conditions</a></label>
                  <span class="help-block text-warning" data-ng-cloak data-ng-if="modsvar.approve.$invalid && modsvar.approve.$touched">* Please accept our Terms and Conditions. </span>
                  <span class="help-block text-warning" data-ng-cloak data-ng-if="!modsvar.$valid && modsvar.approve.$touched">* Please make sure you have filled in the correct information. </span>
                </div>
                <span class="help-block"><small><em>You will receive your order confirmation right away and a final receipt as soon as the campaign ends.</em></small></span>
              </div>

              <input  class="btn btn-cta btn-lg btn-block"
                      ng-disabled="!modsvar.$valid"
                      type="submit"
                      value="Order"
                      data-panel-label="Order"
                      data-key="{{ $stripePublicKey }}"
                      data-name="Modsvar"
                      data-description="{{ Session::get('quantity') }} stk {{ $product->title}}"
                      data-amount="{{$stripePrice*100}}"
                      data-currency="dkk"
                      data-locale="auto"
                      data-allow-remember-me="true"
                      data-email=""
                      data-image="{{url('/')}}/images/logo/modsvar-stripe-icon.png"
              />

              <div class="payments-container">
                <ul class="payments vertical-align">
                  {{-- <li><svg class="icon icon-lets-encrypt"><use xlink:href="#icon-lets-encrypt"></use></svg></li> --}}
                  <li><svg class="icon icon-powered_by_stripe"><use xlink:href="#icon-powered_by_stripe"></use></svg></li>
                  <li><svg class="icon icon-visa"><use xlink:href="#icon-visa"></use></svg></li>
                  <li><svg class="icon icon-mastercard"><use xlink:href="#icon-mastercard"></use></svg></li>
                  <li><svg class="icon icon-american-express"><use xlink:href="#icon-american-express"></use></svg></li>
                </ul>
              </div>

              <script src="https://checkout.stripe.com/v2/checkout.js"></script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
              <script>
              $(document).ready(function() {
                  $(':submit').on('click', function(event) {
                      event.preventDefault();
                      $(this).attr('data-email', $('#email').val());
                      var $button = $(this),
                          $form = $button.parents('form');
                      var opts = $.extend({}, $button.data(), {
                          token: function(result) {
                              $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                          }
                      });
                      StripeCheckout.open(opts);
                  });
              });
              </script>
            </div>
          </div>

        </form>
      </div>
    </div>

  </div>

</section>
@endsection
