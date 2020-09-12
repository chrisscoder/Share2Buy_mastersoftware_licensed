
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Dynamiske sider </div>
                <div class="panel-body">
                  <ul>
                    @foreach($dynPages as $dynPage)
                      <li> <a href="{{ action('DynamicPageController@show', [$dynPage->slug])}}">{{ $dynPage->title}}</a></li>
                    @endforeach
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
