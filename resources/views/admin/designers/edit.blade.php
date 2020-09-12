
@extends('layouts.app')

@section('content')
<section class="admin space-m  {{ Auth::user()->role == 'admin' ? 'space-m-top' : ''}}">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        @if (Auth::check() && Auth::user()->role == 'designer')
        <h2 class="heading">Update Brand</h2><span class="pull-right logout"><a href="{{ route('dashboard') }}" class="dotted">My Dashboard</a></span>
        @endif

        <form name="modsvar" method="post" action="{{ route('designers.update', [$designer->id])}}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-8 main-panel">
                  @include('partials.form.input-validate',['label'=>'Brand name','name'=>'title','old'=>$designer->title,'maxChars'=>'40','helpMsg'=>'Your brand name'])
                  @include('partials.form.input-validate',['label'=>'VAT ID number','name'=>'vat_id','old'=>$designer->vat_id,'maxChars'=>'20','helpMsg'=>'Your value added tax (VAT) identification number'])
                  @include('partials.form.select-value',['label'=>'Profession','name'=>'profession','old'=>(string)$designer->profession,'variable'=>Config::get('constants.professions'),'helpMsg'=>'Please select your brand profession.'])
                  @include('partials.form.input-validate',['label'=>'Brand headline','name'=>'intro','old'=>$designer->intro,'maxChars'=>'55','helpMsg'=>'Catch and inspire potential customers to read about you'])
                  @include('partials.form.textarea-validate',['label'=>'Brand story','name'=>'body','old'=>$designer->body,'maxChars'=>'620','rows'=>'10', 'pattern' => true ,'helpMsg'=>'Your potential customers want to get to know you. Tell us your exciting story about your brand, what you do, and why you love doing what you do.'])
                </div>
                <div class="col-sm-4 panel-sidebar">
                  <img-upload-preview form-name="modsvar" input-name="image" init-image="{{$designer->image1 ? $designer->image('small.1:1') : null}}" label="Brand image" upload-text="Select image" help-text="Min 1300 x 1300 px and max 2 MB" aspect-ratio="1-1" ng-cloak></img-upload-preview>
                </div>
              </div>

              @include('partials.seoform-edit', array('meta_title' => $designer->meta_title, 'meta_description' => $designer->meta_description))

              <div class="form-group">
                <button type="submit" class="btn btn-cta pull-right" ng-disabled="!modsvar.$valid">Update Brand</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
