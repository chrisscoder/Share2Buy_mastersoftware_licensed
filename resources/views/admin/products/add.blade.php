@extends('layouts.app')

@section('content')
  <section class="admin space-m {{ Auth::user()->role == 'admin' ? 'space-m-top' : ''}}" data-ng-controller="ProductUIController">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
              @if (Auth::check() && Auth::user()->role == 'designer')
              <h2 class="heading">Add Product</h2><span class="pull-right logout"><a href="{{ route('dashboard') }}" class="dotted">My Dashboard</a></span>
              @endif
              <div class="panel">
                <div class="panel-body">
                  <form name="modsvar" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-sm-8 col-lg-9 main-panel">

                        @include('partials.form.input-validate',['label'=>'Product title','name'=>'title','maxChars'=>'40','helpMsg'=>'Keep it short and catchy'])
                        @include('partials.form.input-validate',['label'=>'Product headline','name'=>'intro','maxChars'=>'120','helpMsg'=>'Motivate users to read about your product...'])
                        @include('partials.form.textarea-validate',['label'=>'Product story','name'=>'body','maxChars'=>'620','rows'=>'10', 'pattern' => true,'helpMsg'=>'This is the time where you get a little creative and establish a personal voice for your brand. Try to engage the shoppers’ emotions. Try to answer questions like: Who is this product made for? Why is this product truly amazing? Describe the product’s basic details and key features.'])
                        @include('partials.form.input-validate',['label'=>'Materials','name'=>'materials','maxChars'=>'100','helpMsg'=>'Motivate users to read about your product...'])
                        @include('partials.form.size',['label'=>'Size','name'=>'size'])
                        @include('partials.form.input-num-validate',['label'=>'Price (DKK)','name'=>'price','helpMsg'=>'The price should not be changed while the campaign is active.'])
                        @include('partials.form.select-validate',['label'=>'Category','name'=>'category'])

                        <div class="form-header space-m-top">
                          <header class="text-center">
                            <h2>
                              <small class="manchet">
                                <span>Campaign settings</span>
                              </small>
                            </h2>
                          </header>
                        </div>

                        <div class="form-group" data-ng-class="{'has-error':!modsvar.dates.$valid && modsvar.dates.$dirty}">
                          <label>Start date and time</label>
                          <div class="inner-form-group">
                            <input class="form-control" type="text" name="start_date" data-date-time data-ng-model="dates.today" data-view="date" data-max-view="month" data-min-date="dates.minDate" data-timezone="Europe/Copenhagen" data-format="DD/MM/YYYY HH:mm" readonly data-ng-required="dateValidation(dates.today,dates.minDate)">
                            <svg class="icon icon-android-unlock form-feedback form-feedback-sm" data-ng-class="{'text-success':(dates.today >= dates.minDate), 'text-danger':(dates.today < dates.minDate)}"><use xlink:href="#icon-android-unlock"></use></svg>
                          </div>
                          <span class="help-block">Start date and time are locked on release and can only be changed before and after the sales period or when the product is sold out.</span>
                        </div>

                        @include('partials.form.select',['label'=>'Period','name'=>'periode','variable'=>['7'=>'7 days','14'=>'14 days'],'selected'=>'7','helpMsg'=>'Please do not edit price when your campaign is active.'])

                        @if (Auth::user()->role == 'admin')
                        <div class="form-header space-top">
                          <header class="text-center">
                            <h2>
                              <small class="manchet">
                                <span>Designer</span>
                              </small>
                            </h2>
                          </header>
                        </div>
                        <div class="form-group">
                          <label for="designer" class="sr-only">Designer</label>
                          <div class="input-group">
                            <select class="form-control" name="designer_id" id="designer" required>
                              @foreach($designers as $designer)
                                <option value="{{ $designer->id }}">{{ $designer->title }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        @else
                          <input type="hidden" name="designer_id" value="{{ Auth::user()->designer->id }}">
                        @endif

                      </div>
                      <div class="col-sm-4 col-lg-3 panel-sidebar">

                        <img-upload-preview form-name="modsvar" input-name="sectionTopImage" label="Primary image" upload-text="Select image" help-text="Min 1300 x 1300 px and max 2 MB" aspect-ratio="1-1" required="true" ng-cloak></img-upload-preview>
                        <img-upload-preview form-name="modsvar" input-name="headerImage" label="Secondary image" upload-text="Select image" help-text="Min 1920 x 1080 px and max 2 MB" aspect-ratio="16-9" required="true" ng-cloak></img-upload-preview>
                        <img-upload-preview form-name="modsvar" input-name="galleryLeftImage" label="Optional image" upload-text="Select optional image" help-text="Min 1300 x 1300 px and max 2 MB" aspect-ratio="1-1" ng-cloak></img-upload-preview>
                        <img-upload-preview form-name="modsvar" input-name="galleryRightImage" label="Optional image" upload-text="Select optional image" help-text="Min 1300 x 1300 px and max 2 MB" aspect-ratio="1-1" ng-cloak></img-upload-preview>

                      </div>
                    </div>
                    @include('partials.seoform')
                    <div class="form-group">
                      <button type="submit" class="btn btn-cta pull-right space-left">Publish Product</button>
                      {{-- <button class="btn btn-default pull-right">Save</button> --}}
                    </div>
                  </form>
                </div><!-- panel body -->
              </div><!-- panel -->
            </div>
          </div>
        </div>
  </section>
@endsection
