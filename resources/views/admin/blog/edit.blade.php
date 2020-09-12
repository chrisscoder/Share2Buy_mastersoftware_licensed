
@extends('layouts.app')

@section('content')
<section class="admin space-m  {{ Auth::user()->role == 'admin' ? 'space-m-top' : ''}}">
<div class="container">
    <div class="row">
      <div class="col-sm-12">
        @if (Session::has('message'))
           <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        @if (Auth::check() && Auth::user()->role == 'designer')
        <h2 class="heading">{{ trans('admin/blog.create.title') }}</h2><span class="pull-right logout"><a href="{{ url('/dashboard') }}" class="text-uppercase">My Dashboard</a></span>
        @endif
        <form name="modsvar" method="post" action="{{ route('admin.blog.update', [$post->id])}}" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('put') }}
          <div class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-8 main-panel">
                  @include('partials.form.input-validate',['label'=>'Title','name'=>'title','maxChars'=>'100','helpMsg'=>'Keep it short and catchy','old' => old('title', $post->title)])
                  @include('partials.form.textarea-validate',['label'=>'Body','name'=>'body','old'=>old('body',$post->body),'rows'=>'10', 'pattern' => false])
                  <div class="form-group">
                    <label for="tags">Tags</label>
                    <select class="selectize-tags" name="tags[]" id="tags" multiple>
                      @foreach($tags as $tag)
                        @if ($post->tags->contains('id', $tag->id))
                          <option value="{{ $tag->slug }}" selected>{{ $tag->name }}</option>
                        @else
                          <option value="{{ $tag->slug }}">{{ $tag->name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Author</label>
                    <div class="select-option">
                      <select class="form-control select-option-control" name="authors" required>
                        @foreach ($users as $user)
                          @if (is_null(old('authors')) && $user->id == Auth::id())
                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                          @elseif(old('authors') == $user->id)
                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                          @else
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                          @endif
                        @endforeach
                      </select>
                      <svg class="icon icon-ios-checkmark-empty text-success" data-ng-cloak data-ng-if="modsvar.kategori.$valid"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                      <svg class="icon icon-ios-arrow-down"><use xlink:href="#icon-ios-arrow-down"></use></svg>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4 sidebar-panel">
                  <img-upload-preview form-name="modsvar" input-name="cover" init-image="{{ $post->cover ? $post->image('cover', 'small.1:1') : null }}" label="Cover" upload-text="Select cover image" help-text="Min 1300 x 1300 px and max 2 MB" aspect-ratio="1-1" ng-cloak></img-upload-preview>
                  <img-upload-preview form-name="modsvar" input-name="hero" init-image="{{ $post->hero ? $post->image('hero', 'small.16:9') : null }}" label="Hero image" upload-text="Select hero image" help-text="Min 1920 x 1080 px and max 2 MB" aspect-ratio="16-9" ng-cloak></img-upload-preview>
                </div>
              </div>
              <div class="space-l">
                <div class="form-header">
                  <header class=" text-center">
                    <h2>
                      <small class="manchet">
                        <span>Related to this blog post</span>
                      </small>
                    </h2>
                  </header>
                </div>
                <div class="form-group">
                  <label for="tags">Blog posts</label>
                  <select class="selectize" name="posts[]" id="posts" multiple>
                    @foreach($posts as $related_post)
                      @if ($post->relatedPosts->contains('id', $related_post->id))
                      <option value="{{ $related_post->slug }}" selected>{{ $related_post->title }}</option>
                      @else
                      <option value="{{ $related_post->slug }}">{{ $related_post->title }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="tags">Designers</label>
                  <select class="selectize" name="designers[]" id="designers" multiple>
                    @foreach($designers as $designer)
                      @if ($post->relatedDesigners->contains('id', $designer->id))
                      <option value="{{ $designer->slug }}" selected>{{ $designer->title }}</option>
                      @else
                      <option value="{{ $designer->slug }}">{{ $designer->title }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="tags">Products</label>
                  <select class="selectize" name="products[]" id="products" multiple>
                    @foreach($products as $product)
                      @if ($post->relatedProducts->contains('id', $product->id))
                        <option value="{{ $product->slug }}" selected>{{ $product->title }}</option>
                      @else
                        <option value="{{ $product->slug }}">{{ $product->title }} by {{ $product->designer->title }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              @include('partials.seoform-edit', array('meta_title' => $post->meta_title, 'meta_description' => $post->meta_description))
              <div class="form-group">
                <button type="submit" class="btn btn-cta btn-lg pull-right" ng-disabled="!modsvar.$valid">Update</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
</section>
@endsection

{{-- @push('styles')
<link rel="stylesheet" href="{{ asset('css/selectize.css') }}">
@endpush --}}

@push('scripts')
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>
<script>
  $(function() {
    $('.selectize').selectize({
      plugins: ['remove_button'],
    });
    $('.selectize-tags').selectize({
      create: true,
      plugins: ['remove_button'],
    });
  });
</script>
@endpush
