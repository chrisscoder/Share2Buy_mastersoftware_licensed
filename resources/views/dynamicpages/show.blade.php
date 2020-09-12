@extends('layouts.app')
@section('meta_title', $dynPage->meta_title ? $dynPage->meta_title : $dynPage->title)
@section('meta_description', $dynPage->meta_description ? $dynPage->meta_description : custom_truncate($dynPage->body, 160))

@section('content')
  @if(!empty($dynPage->image1))
  <article class="dynamic-page space-l bg04">
    <header>
      <div class="container header-overlay">
        <div class="text-center">
          <h2>{{{ $dynPage->title }}}
            <small>
              <span class="black-underline">{{{ $dynPage->intro }}}</span>
            </small>
          </h2>
        </div>
      </div>
      <img src="{{ $dynPage->image1 }}" class="img-responsive">
    </header>
    <div>
  @else
  <article class="dynamic-page space-l bg03">
    <header>
      <div class="container">
        <div class="text-center">
          <h2>{{{ $dynPage->title }}}
            <small>
              <span class="black-underline">{{{ $dynPage->intro }}}</span>
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
          <p>{!! nl2br($dynPage->body) !!}</p>
        </div>
      </div>
    </div>
  </div>
</article>

<script>
  fbq('track', 'ViewContent');
</script>

@endsection
