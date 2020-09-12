
@extends('layouts.app')

@section('content')
<section class="admin space-l">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
          <h2 class="heading">User</h2><span class="pull-right logout"><a href="{{ url('/dashboard') }}" class="text-uppercase">My Dashboard</a></span>

          <form name="modsvar" method="post" action="{{ action('DesignerController@update_user')}}" enctype="multipart/form-data">
            <div class="panel">
              <header class="panel-heading text-center">
                <h3 class="manchet">
                  <span>Update user info</span>
                </h3>
              </header>
              <div class="panel-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="form-group">
                  <label for="email">Email</label>
                  <div class="input-group">
                    <input type="email" name="email" data-ng-model="designer.email" data-ng-init="designer.email = <?= htmlspecialchars(json_encode($user->email)); ?>" class="form-control" placeholder="E-mail" required>
                    <span class="input-group-addon">
                      <svg class="icon icon-ios-checkmark-empty" data-ng-class="{'text-success':modsvar.email.$valid, 'text-danger':!modsvar.email.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <div class="input-group">
                    <input type="password" data-ng-model="designer.password" data-ng-minlength="8" data-ng-maxlength="64" data-ng-pattern="/(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z])/" name="password" class="form-control" required>
                    <span class="input-group-addon">
                      <svg class="icon icon-ios-checkmark-empty" data-ng-class="{'text-success':modsvar.password.$valid, 'text-danger':!modsvar.password.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                    </span>
                  </div>
                  <span class="help-block" data-ng-if="!modsvar.password.$valid">Choose a strong password between 8 and 64 characters. The password must contain one small and one uppercase letter and one number or a symbol</span>
                  <span class="help-block text-success" data-ng-if="modsvar.password.$valid">Well done! - You have chosen a strong password</span>
                </div>
                <div class="form-group">
                  <label for="name">Brand Name</label>
                  <div class="input-group">
                    <input type="text" name="name" data-ng-model="designer.name" class="form-control" placeholder="navn"  data-ng-init="designer.name = <?= htmlspecialchars(json_encode($user->name)); ?>" required>
                    <span class="input-group-addon">
                      <svg class="icon icon-ios-checkmark-empty" data-ng-class="{'text-success':modsvar.name.$valid, 'text-danger':!modsvar.name.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <a href="{{ action('DesignerController@delete', [$user->id])}}" class="delete pull-left" onclick="return confirm('Are you sure you want to delete your profile and all your products?')"><svg class="icon icon-android-delete"><use xlink:href="#icon-android-delete"></use></svg>Delete Profile</a>
                  <button type="submit" class="btn btn-default btn-lg pull-right">Update User</button>
                </div>
              </div>
            </div>
          </form>

        </div>
    </div>
</div>
</section>
@endsection
