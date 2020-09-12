
@extends('layouts.app')

@section('content')
<section class="admin space-m space-m-top">
<div class="container-fluid">

  @if (Session::has('message'))
     <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

    <div class="row">
        <div class="col-sm-12 ">
          <form name="modsvar" method="post" action="{{ route('designers.add')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="panel">
                <div class="panel-body">
                <div class="row">
                  <div class="col-sm-8 main-panel">
                    @include('partials.form.input-email-validate',['label'=>'Email','name'=>'email','maxChars'=>'60'])
                    @include('partials.form.input-password-validate',['label'=>'Password','name'=>'password','helpMsg'=>'Well done! - You have chosen a strong password','errorMsg'=>'Choose a strong password between 8 and 64 characters. The password must contain one small and one uppercase letter and one number or a symbol'])

                    @include('partials.form.input-validate',['label'=>'Brand name','name'=>'title','maxChars'=>'40','helpMsg'=>'Your brand name'])
                    @include('partials.form.input-validate',['label'=>'VAT ID number','name'=>'vat_id','maxChars'=>'20','helpMsg'=>'Your value added tax (VAT) identification number'])
                    @include('partials.form.select-value',['label'=>'Profession','name'=>'profession','variable'=>Config::get('constants.professions'),'helpMsg'=>'Please select your brand profession.'])
                    @include('partials.form.input-validate',['label'=>'Brand headline','name'=>'intro','maxChars'=>'55','helpMsg'=>'Catch and inspire potential customers to read about you'])
                    @include('partials.form.textarea-validate',['label'=>'Brand story','name'=>'body','maxChars'=>'620','rows'=>'10', 'pattern' => true ,'helpMsg'=>'Your potential customers want to get to know you. Tell us your exciting story about your brand, what you do, and why you love doing what you do.'])

                  </div>
                  <div class="col-sm-4 panel-sidebar">
                    <img-upload-preview form-name="modsvar" input-name="image" label="Brand image" upload-text="Select image" help-text="Min 1300 x 1300 px and max 2 MB" aspect-ratio="1-1" required="true" ng-cloak></img-upload-preview>
                  </div>
                </div>

                @include('partials.seoform')
                <div class="form-group">
                  <button type="submit" class="btn btn-default btn-lg pull-right" ng-disabled="!modsvar.$valid">Add Brand</button>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>
</section>
@endsection
