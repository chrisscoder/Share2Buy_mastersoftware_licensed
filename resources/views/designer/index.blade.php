
@extends('layouts.app')

@section('meta_title', 'Learn more about our sellers' )
@section('meta_description', 'Meet our sellers | Quality design and sustainable living and lifestyle' )
@section('content')

<section class="page">
  <header class="sr-only">
    <h2>Meet our Brands</h2>
  </header>

  <div class="container space-m">
    <div class="row flex-row">
      @each('partials/brand', $designers, 'designer')
    </div>
  </div>

  <script>
    fbq('track', 'ViewContent');
  </script>
</section>

@endsection
