@extends('layouts.app')

@section('content')
  <section class="admin space-m">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 space">
          @if (Session::has('message'))
            <div class="alert alert-success"><svg class="icon icon-ios-checkmark-empty"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>{{ Session::get('message') }}</div>
          @endif
          <h2 class="sr-only">{{ trans('admin/product.index.title') }}</h2><a class="btn btn-default pull-right" href="{{ route('products.add') }}">{{ trans('admin/product.buttons.create') }}</a>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel">
            <header class="panel-heading text-center">
              <h3 class="manchet">
                <span>Products</span>
              </h3>
            </header>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                  <tr>
                    <th><a class="dotted" href="{{ sortedRoute('admin.products', 'sale', 'desc') }}">Sale</a></th>
                    <th><a class="dotted" href="{{ sortedRoute('admin.products', 'campaign') }}">Campaign</a></th>
                    <th><a class="dotted" href="{{ sortedRoute('admin.products', 'title') }}">Product Name</a></th>
                    <th><a class="dotted" href="{{ sortedRoute('admin.products', 'designer') }}">Brand</a></th>
                    <th><a class="dotted" href="{{ sortedRoute('admin.products', 'start_date') }}">Start Date</a></th>
                    <th><a class="dotted" href="{{ sortedRoute('admin.products', 'end_date') }}">End Date</a></th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($products as $product)
                    <tr>
                      <td><a href="{{ action('ProductController@orders', [$product->id])}}"><span class="badge{{ $product->orderCount > 0 ? ' sale' : '' }}">{{ $product->orderCount }}</span></a></td>
                      <td>{{ $product->active ? 'yes' : 'no' }}</td>
                      <td><a class="dotted" href="{{ route('products.show', [$product->slug])}}">{{ $product->title}}</a></td>
                      <td>{{ $product->designer->title }}</td>
                      <td>{{ format_date($product->start_date) }}</td>
                      <td>{{ format_date($product->end_date) }}</td>
                      <td class="text-right"><a href="{{ route('products.edit', [$product->id])}}" class="edit"><svg class="icon icon-compose"><use xlink:href="#icon-compose"></use></svg><span class="sr-only">Edit</span></a></td>
                      <td class="text-right"><a href="{{ route('products.delete', [$product->id])}}" onclick="return confirm('Are you sure that you want to delete: {{$product->title}}?')" class="delete"><svg class="icon icon-android-delete"><use xlink:href="#icon-android-delete"></use></svg><span class="sr-only">Delete</span></a></td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                {!! $products->links() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
