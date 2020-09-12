<div class="header-nav">
  <div class="container">
    <div class="nav-header">
      <div role="navigation">
        <div class="nav-primary">
          <div class="nav-brand" itemscope itemtype="http://schema.org/Organization">
            <a href="{{ route('frontpage') }}" itemprop="url" role="link">
              <h2 class="sr-only" itemprop="name">{{ Config::get('constants.company.name') }}</h2>
              <svg id="logo" class="hidden-xs icon icon-modsvarlogo"><use xlink:href="#icon-modsvarlogo"></use></svg>
              <svg class="visible-xs-block icon icon-modsvar-triangle"><use xlink:href="#icon-modsvar-triangle"></use></svg>
              <link href="images/logo/modsvarlogo.svg" itemprop="logo"/>
            </a>
          </div>
          <div class="nav-item"><a href="{{ route('products') }}" class="{{ Request::is('products') ? 'active' : Request::is('products/*') ? 'active' : Request::is('checkout') ? 'active' : Request::is('checkout/*') ? 'active' : '' }}">Shop</a></div>
          <div class="nav-item"><a href="{{ route('designers') }}" class="{{ Request::is('brands') ? 'active' : Request::is('brands/*') ? 'active' : '' }}">Brands</a></div>
          <div class="nav-item"><a href="{{ route('blog') }}" class="{{ Request::is('blog*') ? 'active' : '' }}">Blog</a></div>
          <div class="nav-item"><a href="{{ route('page', ['about']) }}" class="{{ Request::is('about') ? 'active' : '' }}">About us</a></div>
          <div class="nav-item"><a href="{{ route('page', ['join']) }}" class="{{ Request::is('join') ? 'active' : '' }}">For sellers</a></div>
          {{-- @if (Auth::guest())
            <div class="nav-item"><a href="{{ url('/login') }}">Log in</a></div>
          @else
            <div class="nav-item"><a href="{{ action('DashboardController@index') }}" class="{{ Request::is( 'dashboard' ) ? 'active' : '' }}">Dashboard</a></div>
          @endif --}}
        </div>
      </div>
    </div>
  </div>
  @include('partials.banner')
</div>
