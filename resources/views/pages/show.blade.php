@extends('layouts.app')
@section('meta_title', $page->meta_title ? $page->meta_title : $page->title)
@section('meta_description', $page->meta_description ? $page->meta_description : custom_truncate($page->body, 160))

@section('content')
  @if(!empty($page->image1))
  <article class="dynamic-page space-l bg04">
    <header>
      <div class="container header-overlay">
        <div class="text-center">
          <h2>{{{ $page->title }}}
            <small>
              <span class="black-underline">{{{ $page->intro }}}</span>
            </small>
          </h2>
        </div>
      </div>
      <img src="{{ $page->image('original') }}" class="img-responsive">
    </header>
    <div>
  @else
  <article class="dynamic-page space-l bg03">
    <header>
      <div class="container">
        <div class="text-center">
          <h2>{{{ $page->title }}}
            <small>
              <span class="black-underline">{{{ $page->intro }}}</span>
            </small>
          </h2>
        </div>
      </div>
    </header>
    <div class="space-m-top">
  @endif

    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          @if(Request::is('kob-sammen'))
          <div class="space">
            <div class="embed-container">
              <iframe width="1280" height="720" src="https://www.youtube.com/embed/h44lKiuez9E?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
            </div>
          </div>
          @endif
          <p>{!! nl2br($page->body) !!}</p>
        </div>
      </div>
    </div>
  </div>
</article>

<script>
  fbq('track', 'ViewContent');
</script>

@endsection
