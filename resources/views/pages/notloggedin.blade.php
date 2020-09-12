@extends('layouts.app')

@section('content')
<section class="auth login space-l bg02">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
        <h2 class="text-center">Du er ikke logget ind længere - Login igen?</h2>
      </div>
      <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
        <div class="panel">
          <div class="panel-body">
            <form class="" role="form" method="POST" action="{{ url('/login') }}">
              {!! csrf_field() !!}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="control-label sr-only" for="email">E-mailadresse</label>
                <input type="email" class="form-control" name="email" placeholder="Indtast din e-mailadresse" value="{{ old('email') }}">

                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="control-label sr-only" for="password">Adgangskode</label>
                <input type="password" class="form-control" name="password" placeholder="Adgangskode">

                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-opposite btn-lg btn-block">Log ind</button>
              </div>

              <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember"> Husk mig
                  </label>
                </div>
                <a href="{{ url('/password/reset') }}" class="help-block">Har du glemt din adgangskode?</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 space-m">
        <p>
          Er du vores næste designer? <a href="/join-modsvar" class="join">Join Modsvar</a>
        </p>
      </div>
    </div>
  </div>
</section>

@endsection
