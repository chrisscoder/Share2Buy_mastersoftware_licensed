@extends('layouts.app')

@section('content')
  <section class="admin space-m {{ Auth::user()->role == 'admin' ? 'space-m-top' : ''}}" data-ng-controller="ProductUIController">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @if (Auth::check() && Auth::user()->role == 'designer')
            <h2 class="heading">Update product</h2><span class="pull-right logout"><a href="{{ route('dashboard') }}" class="dotted">My dashboard</a></span>
            @endif
              <div class="panel">
                <div class="panel-body">
                  <form name="modsvar" method="post" action="{{ route('products.update', [$product->id]) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-sm-8 col-lg-9 main-panel">

                        @include('partials.form.input-validate',['label'=>'Product title','name'=>'title','old'=>$product->title,'maxChars'=>'40','helpMsg'=>'Keep it short and catchy'])
                        @include('partials.form.input-validate',['label'=>'Product headline','name'=>'intro','old'=>$product->intro,'maxChars'=>'120','helpMsg'=>'Motivate users to read about your product...'])
                        @include('partials.form.textarea-validate',['label'=>'Product story','name'=>'body','old'=>$product->body,'maxChars'=>'620','rows'=>'10', 'pattern' => true,'helpMsg'=>'This is the time where you get a little creative and establish a personal voice for your brand. Try to engage the shoppers’ emotions. Try to answer questions like: Who is this product made for? Why is this product truly amazing? Describe the product’s basic details and key features.'])
                        @include('partials.form.input-validate',['label'=>'Materials','name'=>'materials','old'=>$product->materials,'maxChars'=>'100','helpMsg'=>'Motivate users to read about your product...'])
                        @include('partials.form.size',['label'=>'Size','name'=>'size','old'=>$product->type_value])
                        @include('partials.form.input-num-validate',['label'=>'Price (DKK)','name'=>'price','old'=>$product->price,'helpMsg'=>'The price should not be changed while the campaign is active.'])
                        @include('partials.form.select-validate',['label'=>'Category','name'=>'category', 'oldCategory'=>$product->category, 'oldType'=>$product->type])

                        <div class="form-header">
                          <header class="text-center">
                            <h2>
                              <small class="manchet">
                                <span>Campaign settings</span>
                              </small>
                            </h2>
                          </header>
                        </div>

                        @include('partials.form.date',['label'=>'Start date and time','name'=>'start_date','old'=>(string)$product->start_date])

                        @include('partials.form.select',['label'=>'Period','name'=>'periode','old'=>(string)$product->periode,'variable'=>['7'=>'7 days','14'=>'14 days'],'helpMsg'=>'Please do not edit price when your campaign is active.'])
                      </div>
                      <div class="col-sm-4 col-lg-3 panel-sidebar">

                        <img-upload-preview form-name="modsvar" input-name="sectionTopImage" init-image="{{$product->sectionTopImage ? $product->image('sectionTopImage', 'small.1:1') : null}}" label="Primary image" upload-text="Select image" help-text="Min 1300 x 1300 px and max 2 MB" aspect-ratio="1-1" ng-cloak></img-upload-preview>
                        <img-upload-preview form-name="modsvar" input-name="headerImage" init-image="{{$product->headerImage ? $product->image('headerImage', 'small.16:9') : null}}" label="Secondary image" upload-text="Select image" help-text="Min 1920 x 1080 px and max 2 MB" aspect-ratio="16-9" ng-cloak></img-upload-preview>
                        <img-upload-preview form-name="modsvar" input-name="galleryLeftImage" init-image="{{$product->galleryLeftImage ? $product->image('galleryLeftImage', 'small.1:1') : null}}" label="Optional image" upload-text="Select optional image" help-text="Min 1300 x 1300 px and max 2 MB" aspect-ratio="1-1" ng-cloak></img-upload-preview>
                        <img-upload-preview form-name="modsvar" input-name="galleryRightImage" init-image="{{$product->galleryRightImage ? $product->image('galleryRightImage', 'small.1:1') : null}}" label="Optional image" upload-text="Select optional image" help-text="Min 1300 x 1300 px and max 2 MB" aspect-ratio="1-1" ng-cloak></img-upload-preview>

                      </div>
                    </div>

                    @include('partials.seoform-edit', array('meta_title' => $product->meta_title, 'meta_description' => $product->meta_description))

                    <div class="form-group">
                      <button type="submit" class="btn btn-cta pull-right space-left">Update Product</button>
                      {{-- <button class="btn btn-default pull-right">Save</button> --}}
                    </div>

                  </form>
                </div>{{-- panel body --}}
              </div>{{-- panel --}}
            </div>
          </div>
        </div>
  </section>
@endsection
