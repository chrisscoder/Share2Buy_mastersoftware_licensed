@extends('layouts.app')

@section('content')
  <section class="admin space-m">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 space">
          @if (Session::has('message'))
            <div class="alert alert-success"><svg class="icon icon-ios-checkmark-empty"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>{{ Session::get('message') }}</div>
          @endif
          <h2 class="sr-only">{{ trans('admin/designer.index.title') }}</h2><a class="btn btn-default pull-right" href="{{ route('designers.add') }}">{{ trans('admin/designer.buttons.create') }}</a>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel">
            <header class="panel-heading text-center">
              <h3 class="manchet">
                <span>Brands</span>
              </h3>
            </header>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                  <tr>
                    <th><a class="dotted" href="{{ sortedRoute('admin.designers', 'title') }}">Brand</a></th>
                    <th><a class="dotted" href="{{ sortedRoute('admin.designers', 'profession') }}">Profession</a></th>
                    <th><a class="dotted" href="{{ sortedRoute('admin.designers', 'created_at', 'desc') }}">Added</a></th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($designers as $designer)
                    <tr>
                      <td><a class="dotted" href="{{ route('designers.show', [$designer->slug])}}">{{ $designer->title}}</a></td>
                      <td>{{$designer->profession}}</td>
                      <td>{{ format_date($designer->created_at) }}</td>
                      <td class="text-right"><a href="{{ route('designers.edit', [$designer->id])}}" class="edit"><svg class="icon icon-compose"><use xlink:href="#icon-compose"></use></svg><span class="sr-only">Edit</span></a></td>
                      <td class="text-right"><a href="{{ route('designers.delete', [$designer->id])}}" onclick="return confirm('Are you sure that you want to delete: {{$designer->title}}?')" class="delete"><svg class="icon icon-android-delete"><use xlink:href="#icon-android-delete"></use></svg><span class="sr-only">Delete</span></a></td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                {!! $designers->links() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
