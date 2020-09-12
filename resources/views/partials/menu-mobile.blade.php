<ul class="text-uppercase">
  <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}" data-ng-click="toggle()">Forside</a></li>
  <li><a href="{{ url('/products') }}" class="{{ Request::is('produkter') ? 'active' : Request::is('produkter/*') ? 'active' : Request::is('checkout') ? 'active' : Request::is('checkout/*') ? 'active' : '' }}" data-ng-click="toggle()">Shop</a></li>
  <li><a href="{{ url('/designers') }}" class="{{ Request::is('designers') ? 'active' : Request::is('designers/*') ? 'active' : '' }}" data-ng-click="toggle()">Designers</a></li>
  @foreach(App\DynamicPage::all() as $page)
    @if($page->menu_place=='top')
      <li><a href="{{ $page->slug }}" class="{{ Request::is($page->slug) ? 'active' : '' }}" data-ng-click="toggle()">{{ $page->title }}</a></li>
    @endif
  @endforeach
</ul>
