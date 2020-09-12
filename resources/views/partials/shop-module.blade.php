<article class="col-xs-6 col-md-4 col-lg-3">
  <div class="thumbnail">
    <a class="thumb-link" href="{{action('ProductController@show', $product->slug)}}">
      <img src="{{ $product->image('sectionTopImage', 'small.1:1') }}"
        srcset="{{ $product->image('sectionTopImage', 'small.1:1') }} 1x, {{ $product->image('sectionTopImage', 'medium.1:1') }} 2x"
        alt="{{ $product->sectionTopImageAlt}}">
      <div class="caption">
        <h3 class="product-name">{{$product->title}}</h3>
        <h4 class="designer">{{$product->designer->title}}</h4>
        <p class="flex-text">
          <span class="price initial-price">{{ number_format($product->price, 2, ',', '.') }} kr</span>
          <span class="price current-price">{{ number_format($product->priceIncCommission, 2, ',', '.') }} kr</span>
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
</article>
