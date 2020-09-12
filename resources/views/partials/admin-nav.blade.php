<div class="admin-nav">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-9">
        <a class="admin-nav-button {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="admin-nav-button {{ Request::is('admin/products') ? 'active' : Request::is('admin/products/*') ? 'active' : '' }}" href="{{ route('admin.products') }}">Products</a>
        <a class="admin-nav-button {{ Request::is('admin/designers') ? 'active' : Request::is('admin/designers/*') ? 'active' : '' }}" href="{{ route('admin.designers') }}">Brands</a>
        <a class="admin-nav-button {{ Request::is('admin/blog') ? 'active' : Request::is('admin/blog/*') ? 'active' : '' }}" href="{{ route('admin.blog') }}">Blog</a>
        <a class="admin-nav-button {{ Request::is('admin/pages') ? 'active' : Request::is('admin/pages/*') ? 'active' : '' }}" href="{{ route('admin.pages') }}">Pages</a>
      </div>
      <div class="col-sm-3 text-right">
        <a class="admin-nav-button" href="{{ url('/logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
</div>
