@extends('layouts.app')
@section('meta_title', $designer->meta_title ? $designer->meta_title : $designer->title)
@section('meta_description', $designer->meta_description ? $designer->meta_description : custom_truncate($designer->body, 160))
@section('social_image', $designer->image('large.1:1') )
@section('content')
  <article class="space-m bg04">
    <div class="container">
      <div class="row vertical-align-sm">
        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-1 col-sm-push-5 col-lg-6 col-lg-offset-2 col-lg-push-4 product-image">
          <img src="{{ $designer->image('medium.1:1') }}"
            srcset="{{ $designer->image('medium.1:1') }} 1x, {{ $designer->image('large.1:1') }} 2x"
            alt="" class="img-responsive">
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-0 col-sm-pull-7 col-lg-4 col-lg-offset-0 col-lg-pull-8 space-m">
          <div class="box">
            <h2>
              {{{ $designer->title }}}
              <small>
                <span>{{{ $designer->intro }}}</span>
              </small>
            </h2>
            <p class="hyphens">
              {!! nl2br($designer->body) !!}
            </p>
          </div>
        </div>
      </div>
    </div>
    <section class="space-l-top">
      <div class="container">
        <div class="row vertical-align-sm">
          <div class="col-sm-12">
            <div class="row flex-row">
              @foreach ($designer->products->sortByDesc('updated_at') as $product)
                <div class="col-xs-6 col-md-4 col-lg-3">
                  <div class="thumbnail{{ $product->active ? ' active' : ' disabled' }}">
                    <a class="thumb-link" href="{{action('ProductController@show',$product->slug)}}">
                      <img src="{{ $product->image('sectionTopImage', 'small.1:1') }}"
                        srcset="{{ $product->image('sectionTopImage', 'small.1:1') }} 1x, {{ $product->image('sectionTopImage', 'medium.1:1') }} 2x"
                        alt="{{ $product->sectionTopImageAlt}}">
                      <div class="caption">
                        <h3 class="product-name">{{ $product->title }}</h3>
                        <h4 class="designer">{{ $designer->title }}</h4>
                        <p class="flex-text">
                          <span class="price initial-price">{{ number_format($product->price, 2, ',', '.') }} kr</span>
                          <span class="price current-price">{{ number_format($product->priceIncCommission, 2, ',', '.') }} kr</span>
                        </p>
                        <div class="campaign-info">
                          <p class="price current-saving">Save <strong>{{ number_format($product->discount, 2, ',', '.') }} kr</strong></p>
                          @if ($product->active)
                            <div class="campaign-countdown">
                              <svg class="icon icon-ios-clock-outline"><use xlink:href="#icon-ios-clock-outline"></use></svg>
                              <div class="countdown" data-countdown data-date="{{$product->end_date_UTC}}" data-selected-period="{{$product->periode}}"></div>
                            </div>
                          @endif
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
  </article>
<script>
  fbq('track', 'ViewContent');
</script>
@endsection
