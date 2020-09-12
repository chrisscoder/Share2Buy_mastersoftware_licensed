@extends('layouts.app')

@section('content')
  <form name="modsvar" method="post" action="{{ route('admin.users.update', [$user->id]) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('put') }}
    @if (Auth::user()->designer->has_orders_not_handled)
    <div class="alert alert-warning alert-fixed">You can't delete your user with orders not handled yet</div>
    @endif
    <section class="admin space-l">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <h2 class="heading">Update settings</h2><span class="pull-right logout"><a href="{{ route('dashboard') }}" class="dotted">My dashboard</a></span>
            <div class="panel">
              <div class="panel-body">

                @include('partials.form.input-validate',['label'=>'Full name','name'=>'name','old'=>$user->name,'maxChars'=>'60'])
                @include('partials.form.input-password-validate',['label'=>'Password','name'=>'password','helpMsg'=>'Well done! - You have chosen a strong password','errorMsg'=>'Choose a strong password between 8 and 64 characters. The password must contain one small and one uppercase letter and one number or a symbol', 'required' => false])
                @include('partials.form.input-email-validate',['label'=>'Email','name'=>'email','old'=>$user->email,'maxChars'=>'60'])

                <div class="form-group">
                  @if (Auth::user()->designer->has_orders_not_handled)
                  <span class="btn btn-danger disabled pull-left">Delete</span>
                  @else
                  <a href="{{ route('admin.users.delete', [$user->id])}}" class="btn btn-danger pull-left" onclick="return confirm('Are you sure that you want to delete your profile: {{$user->name}} and all related products?')">Delete</a>
                  @endif
                  <button type="submit" class="btn btn-cta pull-right">Update</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
@endsection
