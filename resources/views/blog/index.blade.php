
@extends('layouts.app')

@section('meta_title', 'Blog about sustainable trends | Lifestyle and living' )
@section('meta_description', 'Read our blog posts and get insights about brands, quality design and sustainability' )

@section('content')
  <section class="page">
    <h2 class="sr-only">Blog</h2>
    <div class="container space-m">
      @if (isset($tag))
      <div class="row">
        <div class="col-xs-12">
          <h3>Showing posts tagged with {{ $tag->name }} <a href="{{ route('blog') }}">Show all</a></h3>
        </div>
      </div>
      @endif
      <div class="row flex-row">
      @each('partials/post', $posts, 'post')
      </div>
      @if ($posts->links())
        <div class="row">
          <div class="col-xs-12">
            {{ $posts->links() }}
          </div>
        </div>
      @endif
    </div>

    <script>
      fbq('track', 'ViewContent');
    </script>
  </section>

@endsection
