@extends('layouts.app')

@section('meta_title', 'Buy unique interior design and sustainable fashion and make a great deal' )
@section('meta_description', 'Crowd shop with others online, back designers and make a great deal on the best interior design, furniture, accessories and fashion items' )

@section('content')

@if($featured_product)
<section class="space-m-top">
  <div class="container">
    <div class="row flex-row-sm">
        <div class="col-xs-12">
          <div class="thumbnail featured">
            <a class="thumb-link" href="{{ $featured_product->url }}">
              <div class="ratio-container">
                <div class="ratio ratio-16-9">
                  <picture class="ratio-content">
                    <!--[if IE 9]><video style="display: none;"><![endif]-->
                    <source media="(max-width: 480px)" sizes="100vw" srcset="{{ $featured_product->image('headerImage', 'small.16:9') }} 360w, {{ $featured_product->image('headerImage', 'medium.16:9') }} 720w">
                    <source sizes="100vw" srcset="{{ $featured_product->image('headerImage', 'medium.16:9') }} 720w, {{ $featured_product->image('headerImage', 'large.16:9') }} 1920w">
                    <!--[if IE 9]></video><![endif]-->
                    <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{ $featured_product->image('headerImage', 'medium.16:9') }} 720w, {{ $featured_product->image('headerImage', 'large.16:9') }} 1920w" alt="{{ $featured_product->headerImageAlt}}">
                  </picture>
                </div>
              </div>
              <div class="caption">
                <h3 class="product-name">{{$featured_product->title}}</h3>
                <h4 class="designer">{{$featured_product->designer->title}}</h4>
                <p class="flex-text">
                  <span class="featured-description hidden-xs hidden-lg">
                    {{custom_truncate($featured_product->body,160)}}
                  </span>
                  <span class="featured-description visible-lg-block">
                    {{custom_truncate($featured_product->body,500)}}
                  </span>
                  <div>
                    <span class="price current-price">{{ number_format($featured_product->priceIncCommission, 2, ',', '.') }} kr</span>
                    <span class="price initial-price">{{ number_format($featured_product->price, 2, ',', '.') }} kr</span>
                  </div>
                </p>
                <div class="campaign-info">
                  <div class="campaign-countdown">
                    <svg class="icon icon-ios-clock-outline"><use xlink:href="#icon-ios-clock-outline"></use></svg>
                    <div class="countdown">
                      <span data-countdown data-date="{{$featured_product->endDateUTC}}" data-selected-period="{{$featured_product->periode}}"></span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
    </div>
  </div>
</section>
@endif

<section class="space-top space-l-bottom">
  <div class="container">
    <div class="row flex-row">
      @each('partials/shop-module', $popularProducts, 'product')
    </div>
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
        <a class="btn btn-default btn-block btn-lg space-top" href="{{action('ProductController@index')}}">Explore all</a>
      </div>
    </div>
  </div>
</section>

<section class="space-l white relative text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
        <h2 class="space-m-bottom">Quality and Sustainability<br />Living | Lifestyle | Beauty
        </h2>
      </div>
    </div>
    <div class="row is-flex icon-row">
      <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
        <div class="box">
          <svg class="icon icon-wallet"><use xlink:href="#icon-wallet"></use></svg>
          <h3>We reward consciousness</h3>
          <p class="text-center hyphens-xs">
            Buy quality design and sustainable products with others. The more buyers, the more discount for everyone.
          </p>
        </div>
      </div>
      <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
        <div class="box">
          <svg class="icon icon-sprout-1"><use xlink:href="#icon-sprout-1"></use></svg>
          <h3>Support brave brands</h3>
          <p class="text-center hyphens-xs">
            Support brands who believe in a better world. The future belongs to those who create it.
          </p>
        </div>
      </div>
      <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
        <div class="box">
          <svg class="icon icon-hierarchical-structure"><use xlink:href="#icon-hierarchical-structure"></use></svg>
          <h3>Help us increase Sustainability</h3>
          <p class="text-center hyphens-xs">
            Share your purchase with people from your social network, and make a difference by helping us increase sustainability.
          </p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
        <a class="btn btn-primary btn-block btn-lg space-m-top" href="{{ route('page', ['about']) }}">Read more</a>
      </div>
    </div>
  </div>
</section>



@if ($endingCampaigns->count() > 0)
  <section class="space-l">
    <div class="container ">
      <header class=" text-center">
        <h2>
          <small class="manchet">
            <span>Ending campaigns</span>
          </small>
        </h2>
      </header>
      <div class="row space-l-top flex-row">
        @each('partials/shop-module', $endingCampaigns, 'product')
      </div>
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
          <a class="btn btn-default btn-block btn-lg space-top" href="{{action('ProductController@index')}}">Explore all</a>
        </div>
      </div>
    </div>
  </section>
@endif

@if(!is_null($best_selling))
<article class="bg02 space-l-top space-m-bottom">
  <header class="text-center">
    <div class="container">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0">
          <h2 class="margin-none">
            <small class="manchet">
              <span>Trending brand</span>
            </small>
          </h2>
        </div>
      </div>
    </div>
  </header>

  <section class="product-description space-m-top">
    <div class="container">
      <div class="row vertical-align-sm">
        <div class="col-sm-6 col-sm-push-6 col-lg-6 col-lg-push-6 product-image">
          <div class="row">
            <div class="col-xs-5 col-xs-offset-1 col-sm-4 col-sm-offset-0 img-offset-top">
              <a href="{{ $best_selling->designer->url }}">
                <img class="img-responsive img-border-light" src="{{ $best_selling->designer->image('small.1:1') }}"
                  srcset="{{ $best_selling->designer->image('small.1:1') }} 1x, {{ $best_selling->designer->image('medium.1:1') }} 2x"
                  alt="">
              </a>
            </div>
            <div class="col-xs-8 col-xs-offset-3 col-sm-10 col-sm-offset-2 img-offset-bottom">
              <a href="{{ $best_selling->url }}">
                <img class="img-responsive" src="{{ $best_selling->image('sectionTopImage', 'medium.1:1') }}"
                   srcset="{{ $best_selling->image('sectionTopImage', 'medium.1:1') }} 1x, {{ $best_selling->image('sectionTopImage', 'large.1:1') }} 2x"
                   alt="">
              </a>
            </div>
          </div>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-0 col-sm-pull-6 col-lg-4 col-lg-offset-0 col-lg-pull-6 space-m">
          <div class="box">
            <h2 class="space-m-bottom">{{ $best_selling->designer->title }}
              <small>
                {{ $best_selling->title }}
              </small>
            </h2>
            <p class="hyphens">
              {{ custom_truncate($best_selling->designer->body, 340) }}
            </p>
            <a class="btn btn-default btn-block btn-lg space-m-top" href="{{ $best_selling->designer->url }}">Read more</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</article>
@endif

<section class="page space-m-top space-l-bottom">
  <div class="container">
    <header class="text-center">
      <h2>
        <small class="manchet">
          <span>New brands</span>
        </small>
      </h2>
    </header>
    <div class="row flex-row space-top">
      @each('partials/brand', $latestDesigners, 'designer')
    </div>
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
        <a class="btn btn-default btn-block btn-lg space-top" href="{{action('DesignerController@index')}}">Explore all</a>
      </div>
    </div>
  </div>
</section>

<section class="space-l white">
  <div class="container relative">
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center signup-cta">
        <h2>Get our newsletter</h2>
        <p class="text-uppercase space-bottom">Get insights about our designers, inspiration for your home, fashion trends and updates about new products</p>
        @include('partials.newsletter')
      </div>
    </div>
  </div>
</section>

<section class="page space-m-top space-l-bottom">
  <div class="container">
    <header class="text-center">
      <h2>
        <small class="manchet">
          <span>Latest posts</span>
        </small>
      </h2>
    </header>
    <div class="row flex-row space-top">
      @each('partials/post', $latestPosts, 'post')
    </div>
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
        <a class="btn btn-default btn-block btn-lg space-top" href="{{action('BlogController@index')}}">Explore all</a>
      </div>
    </div>
  </div>
</section>

@endsection
