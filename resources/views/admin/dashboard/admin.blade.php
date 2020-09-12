@extends('layouts.app')

@section('content')
  <section class="admin space-m space-m-top">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          @if (Session::has('message'))
            <div class="alert alert-success"><svg class="icon icon-ios-checkmark-empty"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>{{ Session::get('message') }}</div>
          @endif
          <h2 class="sr-only">Dashboard</h2>
        </div>
      </div>
      <div class="row flex-row">
        <div class="col-sm-6">
          <div class="panel">
            <header class="panel-heading text-center">
              <h3 class="manchet">
                <span>Featured products</span>
              </h3>
            </header>
            <div class="panel-body">
              @if ($products_all->count() > 0)
                <form action="{{ route('featured.product') }}" method="post">
                  {{ method_field('put') }}
                  {{ csrf_field() }}
                  <select name="featured[]" id="featured" multiple>
                    @foreach($products_featured as $product)
                      <option value="{{ $product->product_id }}" selected>{{ $product->product->title }}</option>
                    @endforeach
                    @foreach($products_all as $product)
                      @if (!$products_featured->contains('product_id', $product->id))
                      <option value="{{ $product->id }}">{{ $product->title }}</option>
                      @endif
                    @endforeach
                  </select>
                  <button type="submit" class="btn btn-default pull-right space-top">Update</button>
                </form>
              @else
                No active products
              @endif
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel">
            <header class="panel-heading text-center">
              <h3 class="manchet">
                <span>Featured brand</span>
              </h3>
            </header>
            <div class="panel-body">
              <form action="{{ route('designers.featured') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="form-group">
                  <div class="select-option">
                    <select class="form-control select-option-control" name="featured_designer">
                      @foreach($designers_all as $designer)
                        <option value="{{ $designer->id}}" @if(sizeof($site_settings) > 0 && $site_settings[0]->featured_designer==$designer->id) selected @endif >{{ $designer->title}}</option>
                      @endforeach
                    </select>
                    <svg class="icon icon-ios-arrow-down"><use xlink:href="#icon-ios-arrow-down"></use></svg>
                  </div>
                </div>
                <button type="submit" class="btn btn-default pull-right space-top">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row flex-row">
        <div class="col-sm-12">
          <div class="panel">
            <header class="panel-heading text-center">
              <h3 class="manchet">
                <span>Newest Products</span>
              </h3>
            </header>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                  <tr>
                    <th>Sale</th>
                    <th>
                      Campaign
                    </th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($products as $product)
                    <tr>
                      <td><a href="{{ action('ProductController@orders', [$product->id])}}"><span class="badge{{ $product->orderCount > 0 ? ' sale' : '' }}">{{ $product->orderCount }}</span></a></td>
                      <td>  {{ (Carbon\Carbon::now()<$product->end_date&&$product->productOrders!=10) ? 'Yes' : ' No' }}</td>
                      <td><a class="dotted" href="{{ route('products.show', [$product->slug])}}">{{ $product->title}}</a></td>
                      <td>{{ $product->designer->title }}</td>
                      <td>{{ Carbon\Carbon::parse($product->start_date)->format('d/m/Y - H:i') }}</td>
                      <td>{{ Carbon\Carbon::parse($product->end_date)->format('d/m/Y - H:i') }}</td>
                      <td class="text-right"><a href="{{ route('products.edit', [$product->id])}}" class="edit"><svg class="icon icon-compose"><use xlink:href="#icon-compose"></use></svg><span class="sr-only">Edit</span></a></td>
                      <td class="text-right"><a href="{{ route('products.delete', [$product->id])}}" onclick="return confirm('Are you sure that you want to delete: {{$product->title}}?')" class="delete"><svg class="icon icon-android-delete"><use xlink:href="#icon-android-delete"></use></svg><span class="sr-only">Delete</span></a></td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <a href="{{ route('products.add') }}" class="btn btn-default pull-right space-top">{{ trans('admin/product.buttons.create') }}</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel">
            <header class="panel-heading text-center">
              <h3 class="manchet">
                <span>Newest Brands</span>
              </h3>
            </header>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                  <tr>
                    <th>Brand</th>
                    <th>Profession</th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($designers as $designer)
                    <tr>
                      <td><a class="dotted" href="{{ route('designers.show', [$designer->slug])}}">{{ $designer->title }}</a></td>
                      <td>{{$designer->profession}}</td>
                      <td class="text-right"><a href="{{ route('designers.edit', [$designer->id])}}" class="edit"><svg class="icon icon-compose"><use xlink:href="#icon-compose"></use></svg><span class="sr-only">Rediger</span></a></td>
                      <td class="text-right"><a href="{{ route('designers.delete', [$designer->id])}}" class="delete" onclick="return confirm('Are you sure that you want to delete: {{$designer->title}}?')"><svg class="icon icon-android-delete"><use xlink:href="#icon-android-delete"></use></svg><span class="sr-only">Slet</span></a></td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <a href="{{ route('designers.add') }}" class="btn btn-default pull-right space-top">{{ trans('admin/designer.buttons.create') }}</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel">
            <header class="panel-heading text-center">
              <h3 class="manchet">
                <span>Pages</span>
              </h3>
            </header>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                  <tr>
                    <th>Page Name</th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($pages as $page)
                    <tr>
                      <td><a class="dotted" href="{{ action('PageController@page', [$page->slug])}}">{{ $page->title}}</a></td>
                      <td class="text-right"><a href="{{ route('admin.pages.edit', [$page->id])}}" class="edit"><svg class="icon icon-compose"><use xlink:href="#icon-compose"></use></svg></a></td>
                      <td class="text-right"><a href="{{ route('admin.pages.delete', [$page->id])}}" class="delete" onclick="return confirm('Are you sure that you want to delete: {{$page->title}}?')"><svg class="icon icon-android-delete"><use xlink:href="#icon-android-delete"></use></svg></a></td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <a href="{{ route('admin.pages.create') }}" class="btn btn-default pull-right space-top">{{ trans('admin/page.buttons.create') }}</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

{{-- @push('styles')
<link rel="stylesheet" href="{{ asset('css/selectize.css') }}">
@endpush --}}

@push('scripts')
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>
<script>
  $(function() {
    $('#featured').selectize({
      plugins: ['drag_drop', 'remove_button'],
    });
  });
</script>
@endpush
