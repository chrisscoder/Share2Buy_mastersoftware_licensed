@extends('layouts.app')

@section('content')
  <section class="admin space-m">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 space">
          @if (Session::has('message'))
            <div class="alert alert-success"><svg class="icon icon-ios-checkmark-empty"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>{{ Session::get('message') }}</div>
          @endif
          <h2 class="sr-only">{{ trans('admin/blog.index.title') }}</h2><a class="btn btn-default pull-right" href="{{ route('admin.blog.create') }}">{{ trans('admin/blog.buttons.create') }}</a>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel">
            <header class="panel-heading text-center">
              <h3 class="manchet">
                <span>Posts</span>
              </h3>
            </header>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                  <tr>
                    <th><a class="dotted" href="{{ sortedRoute('admin.blog', 'title') }}">Title</a></th>
                    <th>Author</th>
                    <th><a class="dotted" href="{{ sortedRoute('admin.blog', 'created_at', 'desc') }}">Added</a></th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($posts as $post)
                    <tr>
                      <td><a class="dotted" href="{{ route('blog.show', [$post->slug])}}">{{ $post->title}}</a></td>
                      <td>{{ $post->authors->first()->name }}</td>
                      <td>{{ format_date($post->created_at) }}</td>
                      <td class="text-right"><a href="{{ route('admin.blog.edit', [$post->id])}}" class="edit"><svg class="icon icon-compose"><use xlink:href="#icon-compose"></use></svg><span class="sr-only">Edit</span></a></td>
                      <td class="text-right"><a href="{{ route('admin.blog.delete', [$post->id])}}" onclick="return confirm('Are you sure that you want to delete: {{$post->title}}?')" class="delete"><svg class="icon icon-android-delete"><use xlink:href="#icon-android-delete"></use></svg><span class="sr-only">Delete</span></a></td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                {!! $posts->links() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
