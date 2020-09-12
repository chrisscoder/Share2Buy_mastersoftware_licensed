
@extends('layouts.app')
@section('meta_title', 'Page not found' )

@section('content')

  <div class="fullscreen bg02 vertical-align">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 col-md-3 col-sm-offset-3">
          <h2>Oops!
            <small>We can't seem to find the page you were looking for</small>
          </h2>
          <p>Error code: 404 – Page not found</p>
          <a class="btn btn-lg btn-default space-top" href="{{ url('/') }}">Take me home</a>
        </div>
      </div>
    </div>
  </div>

@endsection
