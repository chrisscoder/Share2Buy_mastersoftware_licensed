@extends('layouts.app')

@section('content')
  <section class="admin space-m">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 space">
          @if (Session::has('message'))
            <div class="alert alert-success"><svg class="icon icon-ios-checkmark-empty"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>{{ Session::get('message') }}</div>
          @endif
          <h2 class="sr-only">{{ trans('admin/page.index.title') }}</h2><a class="btn btn-default pull-right" href="{{ route('admin.pages.create') }}">{{ trans('admin/page.buttons.create') }}</a>
        </div>
      </div>
      <div class="row">
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
                    <th><a class="dotted" href="{{ sortedRoute('admin.pages', 'title') }}">Name</a></th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($pages as $page)
                    <tr>
                      <td><a class="dotted" href="{{ route('page', [$page->slug])}}">{{ $page->title}}</a></td>
                      <td class="text-right"><a href="{{ route('admin.pages.edit', [$page->id])}}" class="edit"><svg class="icon icon-compose"><use xlink:href="#icon-compose"></use></svg><span class="sr-only">Edit</span></a></td>
                      <td class="text-right"><a href="{{ route('admin.pages.delete', [$page->id])}}" onclick="return confirm('Are you sure?')" class="delete"><svg class="icon icon-android-delete"><use xlink:href="#icon-android-delete"></use></svg><span class="sr-only">Delete</span></a></td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                {!! $pages->links() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
