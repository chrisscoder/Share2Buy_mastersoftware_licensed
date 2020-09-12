<ul class="text-uppercase">

  <li><a href="{{ url('/products') }}" class="{{ Request::is('produkter') ? 'active' : Request::is('produkter/*') ? 'active' : Request::is('checkout') ? 'active' : Request::is('checkout/*') ? 'active' : '' }}">Shop</a></li>
  @if (Auth::guest())
    <li><a href="{{ url('/login') }}">Designerlogin</a></li>
  @else
    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
  @endif
  {{-- <li><a href="{{ url('/designers') }}" class="{{ Request::is('designers') ? 'active' : Request::is('designers/*') ? 'active' : '' }}">Designers</a></li> --}}
  {{-- @foreach(App\DynamicPage::all() as $page)
    @if($page->menu_place=='top')
      <li><a href="/{{ $page->slug }}" class="{{ Request::is($page->slug) ? 'active' : '' }}">{{ $page->title }}</a></li>
    @endif
  @endforeach --}}

</ul>
