@extends('layouts.app')

@section('meta_title', 'Modsvar – Reset Password' )

@section('content')
  <section class="auth login space-l bg02">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                <div class="panel">
                    <div class="panel-heading text-center">
                      <h3>Reset Your Password</h3>
                    </div>

                    <div class="panel-body">
                        <form role="form" method="POST" action="{{ url('/password/reset') }}">
                            {!! csrf_field() !!}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="control-label sr-only">E-Mail Address</label>
                                <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="control-label sr-only">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                              <label class="control-label sr-only">Confirm Password</label>
                              <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">

                              @if ($errors->has('password_confirmation'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                                  </span>
                              @endif
                            </div>

                            <div class="form-group">
                              <button type="submit" class="btn btn-cta btn-lg btn-block">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection
