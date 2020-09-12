@extends('layouts.app')

@section('meta_title', 'Modsvar – Forgot Your Password' )

<!-- Main Content -->
@section('content')

@if (session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
  </div>
@endif
<section class="auth login space-l bg02">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
        <div class="panel">
          <div class="panel-heading text-center">
            <h3>Forgot your password?</h3>
            <p class="help-block">Enter your email that you used to sign up and we will send you an email with instructions</p>
          </div>
          <div class="panel-body">

            <form role="form" method="POST" action="{{ url('/password/email') }}">
              {!! csrf_field() !!}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="control-label sr-only" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-cta btn-lg btn-block">Send me instructions</button>
              </div>
            </form>

          </div>
        </div>
        <p class="link space-top">
          Did you mistype your email? <a href="/login" class="join">Try again</a>
        </p>
      </div>
    </div>
  </div>
</section>
@endsection
