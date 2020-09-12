@extends('layouts.app')
@section('meta_title', $post->meta_title ? $post->meta_title : $post->title)
@section('meta_description', $post->meta_description ? $post->meta_description : custom_truncate($post->body, 160))
@section('social_image', $post->image('hero', 'medium.16:9') )

@section('content')
  <article>

    <div class="container post space-m">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-lg-6 col-lg-offset-3">
          <picture class="post-hero">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{ $post->image('hero', 'small.16:9') }} 360w, {{ $post->image('hero', 'medium.16:9') }} 720w">
            <source sizes="100vw" srcset="{{ $post->image('hero', 'medium.16:9') }} 720w, {{ $post->image('hero', 'large.16:9') }} 1920w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{ $post->image('hero', 'medium.16:9') }} 720w, {{ $post->image('hero', 'large.16:9') }} 1920w" alt="{{$post->heroAlt}}">
          </picture>
          <h1 class="post-title">{{{ $post->title }}}</h1>
          <header class="post-meta">
            By {{$post->authors->first()->name}}
            <span class="dot-sep">·</span>
            <time class="datetime" datetime="{{Carbon\Carbon::parse($post->updated_at)->toW3cString()}}">
              {{ $post->datePostedHuman }}
            </time>
          </header>

          <div class="post-body">
            {!! $post->html('body') !!}
          </div>

          @if ($post->hasTags)
            <div class="post-tags">
            @foreach($post->tags as $tag)
              <a class="tag" href="{{ route('blog.tagged', [$tag->slug]) }}">#{{ $tag->name }}</a>
            @endforeach
            </div>
          @endif

        </div>
      </div>
    </div>
    <section class="space-l white">
      <div class="container relative">
        <div class="row">
          <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center signup-cta">
            <h2>Get more blog posts like this in your inbox</h2>
            @include('partials.newsletter-blog')
          </div>
        </div>
      </div>
    </section>
    <section class="space-l text-center">
      <div class="container">
        <div class="row">
          <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2 space-m-bottom">
            <h2>Show your support</h2>
            <p class="strong">Share this blog post, and let others read this great post too!</p>
          </div>
        </div>
        <div class="icon-row social-icons text-center">
          <ul>
            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ action('BlogController@show',$post->slug) }}" target="_blank"><span class="sr-only">Invite crowd shoppers on FaceBook</span><svg class="icon icon-social-facebook"><use xlink:href="#icon-social-facebook"></use></svg></a></li>
            <li><a href="https://twitter.com/home?status={{ $post->title }}%20by%20@%20{{$post->authors->first()->name}}%20{{ action('BlogController@show',$post->slug) }}" target="_blank"><span class="sr-only">Invite crowd shoppers on Twitter</span><svg class="icon icon-social-twitter"><use xlink:href="#icon-social-twitter"></use></svg></a></li>
            <li><a href="https://pinterest.com/pin/create/button/?url={{ action('BlogController@show',$post->slug) }}&media={{ url('/').$post->image('hero', 'medium.16:9') }}&description={{ $post->title }}%20by%20@%20{{$post->authors->first()->name}}%20{{ action('BlogController@show',$post->slug) }}" target="_blank"><span class="sr-only">Invite crowd shoppers on Pinterest</span><svg class="icon icon-social-pinterest"><use xlink:href="#icon-social-pinterest"></use></svg></a></li>
          </ul>
        </div>
      </div>
    </section>
    <section class="page space-l-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
            @if (!!$post->relatedPosts->count())
              <header class="text-center">
                <h2>
                  <small class="manchet">
                    <span>You might also like</span>
                  </small>
                </h2>
              </header>
              <div class="row row-flex space-l-top">
                @foreach($post->relatedPosts as $post)
                  @include('partials.post', ['post' => $post, 'colMax' => '3'])
                @endforeach
              </div>
            @endif
          </div>
        </div>
      </div>
    </section>
    <section class="page">
      <div class="container">
        @if (!!$post->relatedDesigners->count())
        <div class="row row-flex">
          <div class="col-md-12">
            <h3>Related designers</h3>
          </div>
          @foreach($post->relatedDesigners as $designer)
            <div class="col-xs-6 col-sm-4 col-lg-3 fig fig-space">
              <a href="{{ route('designers.show', [$designer->slug])}}">
                <figure class="fig-quote tint">
                  <!--[if IE 9]><video style="display: none;"><![endif]-->
                  <source media="(max-width: 480px)" sizes="100vw" srcset="{{ $designer->image('small.1:1') }} 360w, {{ $designer->image('medium.1:1') }} 650w">
                  <!--[if IE 9]></video><![endif]-->
                  <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{ $designer->image('medium.1:1') }} 1x, {{ $designer->image('large.1:1') }} 2x" alt="{{ $designer->title }}">
                  <figcaption>
                    <h3>{{ $designer->title }}</h3>
                    <h4>{{ $designer->profession }}</h4>
                    <p class="space-xs-top hyphens">{{$designer->bodyTruncated}}</p>
                  </figcaption>
                </figure>
              </a>
            </div>
          @endforeach
        </div>
        @endif

        @if (!!$post->relatedProducts->count())
          <div class="row row-flex">
            <div class="col-md-12">
              <h3>Related products</h3>
            </div>
            @each('partials/shop-module', $post->relatedProducts, 'product')
          </div>
        @endif
      </div>
    </section>
  </article>
<script>
  fbq('track', 'ViewContent');
</script>

@endsection
