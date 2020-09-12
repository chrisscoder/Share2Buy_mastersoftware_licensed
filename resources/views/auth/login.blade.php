@extends('layouts.app')

@section('meta_title', 'Modsvar – Log In' )

@section('content')
<section class="auth login space-l bg02">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
        <div class="panel">
          <div class="panel-heading">
            <h3 class="text-center">Log in</h3>
          </div>
          <div class="panel-body">
            <form class="" role="form" method="POST" action="{{ url('/login') }}">
              {!! csrf_field() !!}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="control-label sr-only" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email " value="{{ old('email') }}">

                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="control-label sr-only" for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">

                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-cta btn-lg btn-block">Log in</button>
              </div>

              <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember"> Remember me
                  </label>
                </div>
                <a href="{{ url('/password/reset') }}" class="help-block">Forgotten your password?</a>
              </div>
            </form>
          </div>
        </div>
        <p class="link space-top">
          Don't yet have an account? Apply to <a href="{{ route('page', ['join']) }}" class="join">join Modsvar</a>
        </p>
      </div>
    </div>
  </div>
</section>

@endsection
