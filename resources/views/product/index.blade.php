
@extends('layouts.app')

@section('meta_title', 'Buy interior, fashion, accessories, kids and beauty' )
@section('meta_description', 'Find campaigns with the best sustainable interior design, furniture, accessories, fashion and beaut and get a discount. It’s simple and easy!' )
@section('content')

  <section class="products" data-ng-controller="ProductsController">
    <h2 class="sr-only">
      Crowd shopping marketplace for interior design and fashion
    </h2>

    <div class="space-top">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="select-option-group">
              <label for="productFilter" class="small-strong sr-only">Filter products</label>
              <div class="select-option select-space">
                <select class="select-option-control" id="productFilter" name="productFilter" data-ng-cloak data-ng-options="option.name for option in productFilter.availableOptions track by option.id" data-ng-model="productFilter.selectedOption"></select>
                <svg class="icon icon-ios-arrow-down"><use xlink:href="#icon-ios-arrow-down"></use></svg>
              </div>
            </div>
          </div>

          <div class="col-xs-12 col-sm-6">
            <div class="select-option-group">
              <label for="categorySelect" class="small-strong sr-only">Sort products by category</label>
              <div class="select-option">
                <select class="select-option-control" id="categorySelect" name="categorySelect" data-ng-cloak data-ng-options="option.name for option in categoryFilter.availableOptions track by option.id" data-ng-model="categoryFilter.selectedOption"></select>
                <svg class="icon icon-ios-arrow-down"><use xlink:href="#icon-ios-arrow-down"></use></svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container space-grid">
      <div class="row flex-row">

        <data-shop-module data-ng-if="isRouteLoading && products.length" data-ng-repeat="product in filterValue = (products | filter:filterCategory) | orderBy: productFilter.selectedOption.value | limitTo:loadCount track by product.id" data-info="product"></data-shop-module>

        <div data-ng-cloak data-ng-if="!filterValue.length && products.length" class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
          <h2 class="text-center space-l">There are no campaigns at the moment<br><small>Please choose another category</small></h2>
        </div>
        <div data-ng-cloak data-ng-if="isRouteLoading && !products.length" class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
          <h2 class="text-center space-l">There are no campaigns at the moment<br><small>Come back soon</small></h2>
        </div>
        <div class="loading" data-ng-show="!false && !isRouteLoading">
          <div class="logo-icon-init-container">
            <svg class="logo-icon-init" xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="302" height="302" viewBox="0 0 302 302" enable-background="new 0 0 302 302" xml:space="preserve"><path fill="none" stroke="#30383C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M1 1h300L151 197.6 1 1zM1 104.4h300L151 301 1 104.4z"/><line fill="none" stroke="#30383C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" x1="1" y1="1" x2="1" y2="104.4"/><line fill="none" stroke="#30383C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" x1="151" y1="197.6" x2="151" y2="301"/><line fill="none" stroke="#30383C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" x1="301" y1="1" x2="301" y2="104.4"/></svg>
          </div>
        </div>
      </div>
      <div class="row" data-ng-if="loadLimit() && isRouteLoading && filterValue.length && products.length">
        <div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4 space-btn-bottom">
          <button class="btn btn-primary btn-block btn-lg" data-ng-cloak data-ng-click="loadMore()">Show all</button>
        </div>
      </div>
    </div>
    <script>
      fbq('track', 'ViewContent');
    </script>
  </section>
@endsection
