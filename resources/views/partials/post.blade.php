<div class="col-xs-6 col-sm-4 fig fig-space {{ isset($colMax) && $colMax < 4 ? '' : 'col-lg-3' }} ">
  <a href="{{route('blog.show', [$post->slug])}}">
    <figure class="fig-quote">
      <!--[if IE 9]><video style="display: none;"><![endif]-->
      <source media="(max-width: 480px)" sizes="100vw" srcset="{{$post->image('cover','small.1:1') }} 360w, {{$post->image('cover','medium.1:1') }} 650w">
      <!--[if IE 9]></video><![endif]-->
      <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{ $post->image('cover','medium.1:1') }} 1x, {{ $post->image('cover','large.1:1') }} 2x" alt="{{ $post->coverAlt }}">
      <figcaption>
        <h3>{{ $post->title }}</h3>
        <p class="space-xs hyphens flex-grow">{{$post->bodyTruncated}}</p>
        <time class="datetime" datetime="{{ Carbon\Carbon::parse($post->updated_at)->toW3cString() }}">
          {{ $post->datePostedHuman }}
        </time>
      </figcaption>
    </figure>
  </a>
</div>
