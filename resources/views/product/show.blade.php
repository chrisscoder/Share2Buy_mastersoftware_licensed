
@extends('layouts.app')
@section('meta_title', $product->meta_title ? $product->meta_title : 'Buy '. $product->title . ' by ' . $product->designer->title)
@section('meta_description', $product->meta_description ? $product->meta_description : custom_truncate($product->body, 160))
@section('social_image', $product->image('sectionTopImage', 'large.1:1') )
@section('content')

<article data-ng-controller="ProductsSingleController" class="product">
  <div class="product-description space-m">
    <div class="container">
      <div class="row vertical-align-sm">
        <div class="col-sm-6 product-image">
          <img src="{{ $product->image('sectionTopImage', 'medium.1:1') }}"
            srcset="{{ $product->image('sectionTopImage', 'medium.1:1') }} 1x, {{ $product->image('sectionTopImage', 'large.1:1') }} 2x"
            alt="{{ $product->sectionTopImageAlt}}">
          <p class="strong text-uppercase product-caption">{{$product->designer->title}}</p>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-5 col-lg-offset-1">
          <div class="box text-box">
            <h1>{{ $product->title }}</h1>
            <h2 class="small">{{ $product->intro }}</h2>
            <p class="hyphens">{{ $product->body }}</p>
            <div class="campaign-price">
              @if ($product->active && $product->buyable)
              <form name="order" data-ng-submit="submitForm()" novalidate>
                <div class="price-calc">
                  <div>
                    <p class="small-strong">Before</p>
                    <p class="price initial-price">{{ number_format($product->price, 2, ',', '.') }} kr</p>
                  </div>
                  <div>
                    <p class="small-strong">Now</p>
                    <p class="price current-price" data-ng-bind="formData.price=priceIncCommission({{$product->price}}, ({{$product->unhandledOrderCount}} + (currentCount - 1))) | currency:'kr':2">{{ number_format($product->priceIncCommission, 2, ',', '.') }} kr</p>
                  </div>
                  <div>
                    <p class="small-strong">Save</p>
                    <p class="price current-saving" data-ng-bind="discount({{$product->price}}, formData.price) * currentCount | currency:'kr':2">{{ number_format($product->discount, 2, ',', '.')}} kr</p>
                  </div>
                  <div>
                    <p class="small-strong">Total</p>
                    <p class="price total-price" data-ng-bind="formData.price * currentCount | currency:'kr':2">{{ number_format($product->priceIncCommission, 2, ',', '.') }} kr</p>
                  </div>
                </div>
                <div class="product-checkout">
                  @if(!empty($product->sizes) && count($product->sizes) > 1)
                    <div class="select-option-group" data-ng-class="{'has-error':order.size.$invalid && (order.$submitted || order.size.$touched)}">
                      <label for="size" class="small-strong lable-icon-wrapper">Size <svg class="icon icon-ios-checkmark-empty lable-icon text-success" data-ng-cloak data-ng-class="{'text-success success-reveal':order.size.$valid, 'hidden':!order.size.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg></label>
                      <div class="select-option">
                        <select class="select-option-control" data-ng-model="formData.size" name="size" required>
                          <option value="">Select size</option>
                          @foreach($product->sizes as $key => $size)
                            <option value="{{ $size }}">{{ $size }}</option>
                          @endforeach
                        </select>
                        <svg class="icon icon-ios-arrow-down"><use xlink:href="#icon-ios-arrow-down"></use></svg>
                      </div>
                    </div>
                  @endif
                  <div class="select-qty @if (!empty($product->sizes) && count($product->sizes) > 1)left-margin @endif">
                    <p class="small-strong">Qty</p>
                    <div class="product-amount-wrapper">
                      <div class="product-amount" data-ng-bind="currentCount">1</div>
                      <div class="select-product-amount">
                        <button class="increase-amount" name="increase-amount" type="button" data-ng-click="increment({{$product->unhandledOrderCount}})">
                          <svg class="icon icon-ios-arrow-up"><use xlink:href="#icon-ios-arrow-up"></use></svg>
                        </button>
                        <button class="decrease-amount" name="decrease-amount" type="button" data-ng-click="decrement()">
                          <svg class="icon icon-ios-arrow-down"><use xlink:href="#icon-ios-arrow-down"></use></svg>
                        </button>
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="price" data-ng-value="formData.price * currentCount" data-ng-model="formData.price">
                  <input type="hidden" name="productID" data-ng-value="formData.product_id={{$product->id}}" data-ng-model="formData.product_id">
                  <input type="hidden" name="amount" data-ng-value="formData.quantity=currentCount" data-ng-model="formData.quantity">
                  <button class="btn btn-lg btn-cta btn-block product-order" type="submit" value="submit">Checkout</button>
                </div>
              </form>
              @endif
            </div>

            <div class="campaign-info">
              @if ($product->active)
              <div class="campaign-countdown">
                <svg class="icon icon-ios-clock-outline"><use xlink:href="#icon-ios-clock-outline"></use></svg>
                <div class="countdown" data-countdown data-date="{{$product->endDateUTC}}" data-selected-period="{{$product->periode}}"></div>
              </div>
              @elseif (!$product->active && $product->buyable)
                <div class="campaign-countdown">
                  <svg class="icon icon-ios-clock-outline"><use xlink:href="#icon-ios-clock-outline"></use></svg>
                  <div class="countdown" data-countdown data-date="{{$product->endDateUTC}}" data-selected-period="{{$product->periode}}"></div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-sm-9">
        <picture>
          <!--[if IE 9]><video style="display: none;"><![endif]-->
          <source media="(max-width: 480px)" sizes="100vw" srcset="{{ $product->image('headerImage', 'small.16:9') }} 360w, {{ $product->image('headerImage', 'medium.16:9') }} 720w">
          <source sizes="100vw" srcset="{{ $product->image('headerImage', 'medium.16:9') }} 720w, {{ $product->image('headerImage', 'large.16:9') }} 1920w">
          <!--[if IE 9]></video><![endif]-->
          <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{ $product->image('headerImage', 'medium.16:9') }} 720w, {{ $product->image('headerImage', 'large.16:9') }} 1920w" alt="{{ $product->headerImageAlt}}">
        </picture>
      </div>
      <div class="col-sm-3">
        <h3>Material</h3>
        <p class="inline-xs">{{{ $product->materials }}}</p>

        @if(count($product->sizes) > 1)
        <h3>Sizes</h3>
        @else
        <h3>Size</h3>
        @endif

        <ol class="dimensions">
          @foreach($product->sizes as $size)
          <li>{{{ $size }}}</li>
          @endforeach
        </ol>
      </div>
    </div>
  </div>
  @if (!is_null($product->galleryLeftImage) || !is_null($product->galleryRightImage))
    <div class="space-l bg03">
      <div class="container">
        <div class="row">
          @if(!is_null($product->galleryLeftImage) && !empty($product->galleryLeftImage))
          <div class="col-sm-6 space-sm-hidden">
            <img src="{{ $product->image('galleryLeftImage', 'medium.1:1') }}"
              srcset="{{ $product->image('galleryLeftImage', 'medium.1:1') }} 1x, {{ $product->image('galleryLeftImage', 'large.1:1') }} 2x"
              alt="{{ $product->galleryLeftImageAlt}}">
          </div>
          @endif
          @if(!is_null($product->galleryRightImage) && !empty($product->galleryRightImage))
          <div class="col-sm-6 space-sm-top-hidden {{ is_null($product->galleryLeftImage) ? 'col-sm-offset-6' : '' }}">
            <img src="{{ $product->image('galleryRightImage', 'medium.1:1') }}"
              srcset="{{ $product->image('galleryRightImage', 'medium.1:1') }} 1x, {{ $product->image('galleryRightImage', 'large.1:1') }} 2x"
              alt="{{ $product->galleryRightImageAlt}}">
          </div>
          @endif
        </div>
      </div>
    </div>
  @endif

  <section class="space-m relative text-center">
    <div class="container">
      <div class="row is-flex icon-row">
        {{-- <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
          <div class="box">
            <svg class="icon icon-gift-card"><use xlink:href="#icon-gift-card"></use></svg>
            <h3>All fees included</h3>
            <p class="text-center">A 7% fee to Modsvar is included.</p>
          </div>
        </div> --}}
        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-2">
          <div class="box">
            <svg class="icon icon-delivery-truck"><use xlink:href="#icon-delivery-truck"></use></svg>
            <h3>Free shipping</h3>
            <p class="text-center">Your designer ships your product 1-3 days after the campaign ends.</p>
          </div>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
          <div class="box">
            <svg class="icon icon-package"><use xlink:href="#icon-package"></use></svg>
            <h3>14 days return policy</h3>
            <p class="text-center">You can always return your product within 14 business days to your designer.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="space-l text-center">
    <div class="container">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2 space-m-bottom">
          <h2>Show your support</h2>
          <p class="strong">{{ $product->designer->title }} worked hard to give us this great product, let’s spread the word by sharing their work, so that more people can enjoy it! Sharing will also encourage more content like this in the future.</p>
        </div>
      </div>
      <div class="icon-row social-icons text-center">
        <ul>
          <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ action('ProductController@show',$product->slug) }}" target="_blank"><span class="sr-only">Invite crowd shoppers on FaceBook</span><svg class="icon icon-social-facebook"><use xlink:href="#icon-social-facebook"></use></svg></a></li>
          <li><a href="https://twitter.com/home?status=Crowd%20shop%20%23{{ str_replace(' ', '', $product->designer->title)}}%20%23interiordesign%20and%20%23fashion%20on%20{{ action('ProductController@show',$product->slug) }}" target="_blank"><span class="sr-only">Invite crowd shoppers on Twitter</span><svg class="icon icon-social-twitter"><use xlink:href="#icon-social-twitter"></use></svg></a></li>
          <li><a href="https://pinterest.com/pin/create/button/?url={{ action('ProductController@show',$product->slug) }}&media={{ url('/').$product->images['sectionTopImage']['X2'] }}&description=Crowd%20shop%20interior%20design%20and%20fashion%20on%20modsvar.com%20by%20{{ str_replace(' ', '%20', $product->designer->title) }}" target="_blank"><span class="sr-only">Invite crowd shoppers on Pinterest</span><svg class="icon icon-social-pinterest"><use xlink:href="#icon-social-pinterest"></use></svg></a></li>
        </ul>
      </div>
    </div>
  </section>

  <article class="product-description space-l bg04">
    <div class="container">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0">
          <header class="text-center">
            <h2>
              <small class="manchet">
                @if (count($latestProducts) > 0)
                  <span>More items by {{ $product->designer->title }}</span>
                @else
                  <span>Meet the designer</span>
                @endif

              </small>
            </h2>
          </header>
        </div>
      </div>
      @if (count($latestProducts) > 0)
      <div class="row space-l-top vertical-align-sm">
        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
            <div class="box text-box">
              <h2>{{ $product->designer->title }}</h2>
              <h3>{{$product->designer->intro}}</h3>
              <p class="hyphens">{{ $product->designer->body }}</p>
            </div>
        </div>
        <div class="col-sm-8">
          <div class="row flex-row">
            @foreach ($latestProducts as $key => $latestProduct)
              <div class="col-xs-6 space-top">
                <div class="thumbnail{{ $latestProduct->active ? ' active' : ' disabled' }}">
                  <a class="thumb-link" href="{{$latestProduct->slug}}">
                    <img src="{{ $latestProduct->image('sectionTopImage', 'medium.1:1') }}"
                      srcset="{{ $latestProduct->image('sectionTopImage', 'medium.1:1') }} 1x, {{ $latestProduct->image('sectionTopImage', 'large.1:1') }} 2x"
                      alt="{{ $latestProduct->headerImageAlt}}">

                    <div class="caption">
                      <h3 class="product-name">{{$latestProduct->title}}</h3>
                      <h4 class="designer">{{ $product->designer->title }}</h4>
                      @if ($latestProduct->active)
                      <p class="flex-text">
                        <span class="price initial-price">{{ number_format($latestProduct->price, 2, ',', '.') }} kr</span>
                        <span class="price current-price">{{ number_format($latestProduct->priceIncCommission, 2, ',', '.') }} kr</span>
                      </p>
                      <div class="campaign-info">
                        {{-- <p class="price current-saving">Save <strong>{{ number_format($latestProduct->discount, 2, ',', '.') }} kr</strong></p> --}}
                          <div class="campaign-countdown">
                            <svg class="icon icon-ios-clock-outline"><use xlink:href="#icon-ios-clock-outline"></use></svg>
                            <div class="countdown" data-countdown data-date="{{$latestProduct->endDateUTC}}" data-selected-period="{{$latestProduct->periode}}"></div>
                          </div>
                      </div>
                      @endif
                    </div>
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
          <a class="btn btn-default btn-lg btn-block space-top" href="{{ action('DesignerController@show',$product->designer->slug)}}">View all products</a>
        </div>
      </div>
      @else
        <div class="row space-l-top vertical-align-sm">
          <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-1 col-sm-push-5 col-lg-6 col-lg-offset-2 col-lg-push-4 product-image">
            <img class="img-responsive" src="{{ $product->designer->image('medium.1:1') }}"
              srcset="{{ $product->designer->image('medium.1:1') }} 1x, {{ $product->designer->image('large.1:1') }} 2x"
              alt="">
          </div>
          <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-0 col-sm-pull-7 col-lg-4 col-lg-offset-0 col-lg-pull-8 space-m">
            <div class="box">
              <h2>
                {{ $product->designer->title }}
                <small>
                  <span>{{ $product->designer->intro }}</span>
                </small>
              </h2>
              <p class="hyphens">
                {{ $product->designer->body }}
              </p>
              <a class="btn btn-default btn-lg btn-block space-top" href="{{ action('DesignerController@show', $product->designer->slug) }}">Read more</a>
            </div>
          </div>
        </div>
      @endif
    </div>
  </article>

  <script>
    fbq('track', 'Lead');
  </script>

</article>
@endsection
