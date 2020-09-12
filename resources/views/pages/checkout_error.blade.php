
@extends('layouts.app')

@section('content')
<div class="space-l bg02">
  <div class="container">
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 text-center">
        <h2>Checkout issue</h2>
        <h3>Your order quantity exceeds available campaign products</h3>
        <p>
          Try to make the order again with a smaller amount of products.
        </p>
      </div>
      <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4 space-top">
        <a class="btn btn-lg btn-default btn-block" href="{{ action('ProductController@index') }}">Go to Shop</a>
      </div>
    </div>
  </div>
</div>
@endsection
