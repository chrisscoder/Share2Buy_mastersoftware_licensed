@extends('layouts.app')

@section('content')


  @if (Session::has('message'))
    <div class="alert alert-success alert-fixed alert-animate" ng-hide="hidden"><svg class="icon icon-android-checkmark-circle space-xs-right"><use xlink:href="#icon-android-checkmark-circle"></use></svg>{{ Session::get('message') }}<svg class="icon icon-android-close pull-right" ng-click="hidden=true" ng-init="hidden=false"><use xlink:href="#icon-android-close"></use></svg></div>
  @endif
  @if(Auth::user()->stripe_code=='')
    <div class="alert alert-warning alert-fixed">
      <svg class="icon icon-ios-information-outline"><use xlink:href="#icon-ios-information-outline"></use></svg>
      <strong><a href="{{ $stripeLink}}">Connect your Stripe Account</a></strong> to receive payments
    </div>
  @endif
  <section class="admin space-m">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2 class="heading">Dashboard</h2>
          <span class="pull-right logout">
            <a class="dotted" href="{{ url('/logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </span>
          <div class="row flex-row">
            <div class="col-sm-6">
              <div class="panel">
                <header class="panel-heading text-center">
                  <h3 class="manchet">
                    <span>Get Started</span>
                  </h3>
                </header>
                <div class="panel-body">
                  <ul>
                    @foreach(App\Models\DynamicPage::all() as $page)
                      @if($page->menu_place=='designer')
                        <li>
                          <a class="dotted" href="{{ route('page',$page->slug) }}" target="_blank">{{ $page->title }}</a>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-sm-6 flex-panel">
              <div class="panel">
                <header class="panel-heading text-center">
                  <h3 class="manchet">
                    <span>Profile</span>
                  </h3>
                </header>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <ul>
                        <li><a class="dotted" href="{{ route('designers.edit', [Auth::user()->designer->id])}}">Update brand</a></li>
                        <li><a class="dotted" href="{{ route('admin.users.edit', [Auth::id()])}}">Update settings</a></li>
                      </ul>
                    </div>
                    <div class="col-sm-6">
                      <div class="pull-right">
                        @if(Auth::user()->stripe_code=='')
                          <a class="btn btn-sm btn-cta btn-default" href="{{ $stripeLink}}">Connect Stripe Account</a>
                        @else
                          {{-- Din Stripe-konto er tilknyttet. Vil du fjerne din Stripe-konto tilknytning --}}
                          <a class="dotted" href="/dashboard/stripe/remove">Disconnect Stripe Account</a>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="panel">
            <header class="panel-heading text-center">
              <h3 class="manchet">
                <span>Products</span>
              </h3>
            </header>
            <div class="panel-body">
              <table class="table">
                <thead>
                <tr>
                  <th></th>
                  <th>Name</th>

                  <th></th>
                  <th></th>
                  <th>Start date</th>
                  <th>End date</th>
                  <th class="text-right">Orders</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                  <tr>
                    <td><a href="{{ route('products.show', [$product->slug])}}"><img src="{{$product->image('sectionTopImage','thumb')}}" alt="thumb" class="thumb"></a></td>
                    <td><a class="dotted" href="{{ route('products.show', [$product->slug])}}">{{ $product->title}}</a></td>
                    <td><a class="edit" href="{{ route('products.edit', [$product->id])}}"><svg class="icon icon-compose"><use xlink:href="#icon-compose"></use></svg><span class="sr-only">Edit</span></a></td>
                    <td><a class="delete" href="{{ route('products.delete', [$product->id])}}" onclick="return confirm('Are you sure that you want to delete: {{$product->title}}?')"><svg class="icon icon-android-delete"><use xlink:href="#icon-android-delete"></use></svg><span class="sr-only">Delete</span></a></td>
                    <td>{{Carbon\Carbon::parse($product->start_date)->format('d M, Y - H.i')}}</td>
                    <td>{{Carbon\Carbon::parse($product->end_date)->format('d M, Y - H.i')}}</td>
                    <td class="text-right">
                      {{-- BUG Orders unhandled could be misinterpreted as order count --}}
                      <span class="badge{{ $product->orders_unhandled_count > 0 ? ' sale' : '' }}">{{ $product->orders_unhandled_count }}</span>
                    </td>
                    <td class="dotted text-right">
                      @if ($product->order_count > 0)
                        <a href="{{ action('ProductController@orders', [$product->id])}}" class="btn btn-sm {{$product->orders_unhandled_count > 0 ? 'btn-cta' : 'btn-default'}}">@if ($product->orders_unhandled_count > 0) Handle Orders @else View Orders @endif</a>
                      @endif
                    </td>
                  </tr>
                @endforeach

                </tbody>
              </table>
              <a href="{{ route('products.add')}}" class="btn btn-cta pull-right space-top">Add Product</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
