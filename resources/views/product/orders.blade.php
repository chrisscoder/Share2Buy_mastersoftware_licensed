@extends('layouts.app')
@section('content')
  @if (Session::has('order-approved') && !Session::has('orders-ready'))
      <div class="alert alert-info alert-fixed">
        <svg class="icon icon-ios-information-outline"><use xlink:href="#icon-ios-information-outline"></use></svg>
        {{ Session::get('order-approved') }}
      </div>
  @endif
  @if (Session::has('orders-ready'))
      <div class="alert alert-info alert-fixed">
        <svg class="icon icon-ios-information-outline"><use xlink:href="#icon-ios-information-outline"></use></svg>
        {{ Session::get('orders-ready') }}
      </div>
  @endif
  @if (Session::has('payment-success'))
      <div class="alert alert-success alert-fixed">
          <svg class="icon icon-ios-checkmark-empty"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
          Orders charged:
          <ul>
          @foreach(Session::get('payment-success') as $p)
              <li>{{ $p }}</li>
          @endforeach
          </ul>
      </div>
  @endif
  @if (Session::has('warning'))
      <div class="alert alert-warning alert-fixed">
          <ul>
          @foreach(Session::get('warning') as $w)
              <li>{{ $w }}</li>
          @endforeach
          </ul>
      </div>
  @endif
  @if(Auth::user()->stripe_code=='')
    <div class="alert alert-warning alert-fixed">
      <svg class="icon icon-ios-information-outline"><use xlink:href="#icon-ios-information-outline"></use></svg>
      <strong><a href="{{ $stripeLink}}">Connect Stripe Account</a></strong> to receive payment
    </div>
  @endif
  @if (!$hasOrders && !Session::has('payment-success'))
    <div class="alert alert-info alert-fixed">
      <svg class="icon icon-ios-information-outline"><use xlink:href="#icon-ios-information-outline"></use></svg> There are currently no orders to process
    </div>
  @endif

  <div class="alert alert-warning alert-fixed ng-cloak" ng-if="charging">
    <img src="{{ url('/').'/images/icons/ring-alt-orage.gif' }}" alt="GIF loader" width="24" height="24" class="gif-loader" style="display:inline-block; width:24px; height:24px;">
    <strong>Please wait</strong> We are processing your request.
  </div>
    <section class="admin space-m">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading">Orders</h2><span class="pull-right logout"><a href="{{ route('dashboard') }}" class="dotted">My Dashboard</a></span>
                    <div class="panel">
                        <div class="panel-body">
                          <div class="row space-m-bottom">
                            <div class="col-xs-4 col-sm-1">
                              <img src="{{$product->image('sectionTopImage','thumb')}}" alt="{{ $product->title}}" class="img-responsive">
                            </div>
                            <div class="col-xs-8 col-sm-6">
                              <ul>
                                <li><strong>{{ $product->title}}</strong></li>
                                {{-- <li>Campaign period: {{ $product->periode }} days</li>
                                <li>Start Date: {{ $productSalePriod['start_date'] }}</li> --}}
                                <li>End Date: {{ $productSalePriod['end_date'] }}</li>
                              </ul>
                            </div>
                          </div>
                          {{-- Only show if there are orders to process else show notice that there are no orders to be processed yet --}}
                          @if ($hasOrders)
                            <h2 class="text-center">
                                <small class="manchet">
                                    <span>Orders</span>
                                </small>
                            </h2>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Order nr.</th>
                                    <th>Ordered</th>
                                    <th>Customer</th>
                                    <th>Comment</th>
                                    <th>Size</th>
                                    <th>Qty</th>
                                    <th class="text-right">Sales</th>
                                    <th class="text-right">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productOrders as $o)
                                    @if($o->status!='charged')
                                        <tr>
                                            <td>#{{$o->id}}</td>
                                            <td>{{Carbon\Carbon::parse($o->created_at)->format('d M, Y')}}</td>
                                            <td>{{$o->name}}<br>{{$o->address}}, {{$o->postal}} {{$o->city}}<br>Email: {{$o->email}}</td>
                                            <td>{{$o->comment}}</td>
                                            <td>{{$o->size}}</td>
                                            <td>{{$o->quantity}}</td>
                                            <td class="text-right">{{ number_format($product->priceExclCommission, 2, ',', '.') }} DKK</td>
                                            <td class="text-right">
                                              {{-- Only show approve button if not handled. --}}
                                                @if($o->handled==0)
                                                  {{-- and if campaign has ended or all products has been sold. --}}
                                                  @if (!$productActive)
                                                    <form action="{{ action('ProductController@approveOrder')}}" method="post">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="id" value="{{ $o->id }}">
                                                        <input type="hidden" name="productId" value="{{ $product->id }}">
                                                        <input type="submit" value="Approve" class="btn btn-sm btn-default pull-right" />
                                                    </form>
                                                  @else
                                                    Active
                                                  @endif
                                                @else
                                                    @if($o->status=='charged')
                                                        Charged
                                                    @else
                                                      Approved {{Carbon\Carbon::parse($o->updated_at)->format('d M, Y')}}
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>
                                <tfoot>
                                  <tr>
                                    <td>
                                      Total<br><br>
                                      {{-- <em>*Commission in total</em> --}}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td class="text-right">
                                      {{ number_format($product->priceExclCommissionTotal, 2, ',', '.') }} DKK<br><br>
                                      {{-- <em>{{ number_format($product->commisionTotal, 2, ',', '.') }} DKK</em> --}}
                                      {{-- <strong>{{ $total }} DKK</strong> --}}
                                    </td>
                                    <td></td>
                                  </tr>
                                </tfoot>
                            </table>
                                {{-- Hide button unless all orders have been handled and all orders have not been charged --}}
                                @if(!Auth::user()->stripe_code=='')
                                    <form action="{{ action('ProductController@finishOrder')}}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <button class="btn btn-sm btn-cta btn-spa pull-right {{ !$orderReady ? 'hidden' : ''}}" data-ng-click="charging = true" data-ng-init="charging=false" type="submit">Charge</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>

                    {{-- Only show if some orders has been charged. --}}
                    @if ($productOrdersCharged)
                    <div class="panel">
                        <header class="panel-heading text-center">
                          <h3 class="manchet">
                            <span>Processed orders</span>
                          </h3>
                        </header>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                  <th>Order nr.</th>
                                  <th>Processed</th>
                                  <th>Ordered</th>
                                  <th>Customer</th>
                                  {{-- <th>Address</th> --}}
                                  <th>Comment</th>
                                  <th>Size</th>
                                  <th class="text-right">Qty</th>
                                  <th class="text-right">Sales</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productOrders->reverse() as $o)
                                    @if($o->status=='charged')
                                        <tr>
                                          <td>#{{$o->id}}</td>
                                          <td>{{Carbon\Carbon::parse($o->updated_at)->format('d M, Y')}}</td>
                                          <td>{{Carbon\Carbon::parse($o->created_at)->format('d M, Y')}}</td>
                                          <td>{{$o->name}}<br>{{$o->address}}, {{$o->postal}} {{$o->city}}<br>Email: {{$o->email}}</td>
                                          {{-- <td>{{$o->address}}, {{$o->postal}} {{$o->city}}</td> --}}
                                          <td>{{$o->comment}}</td>
                                          <td>{{$o->size}}</td>
                                          <td class="text-right">{{$o->quantity}}</td>
                                          <td class="text-right">
                                            {{-- total is calculated on charge and stored in orders table --}}
                                            {{$o->total}} DKK
                                          </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
