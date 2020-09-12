<div class="col-xs-6 col-sm-4 col-lg-3 fig fig-space">
  <a href="{{ route('designers.show', [$designer->slug])}}">
    <figure class="fig-quote">
      <!--[if IE 9]><video style="display: none;"><![endif]-->
      <source media="(max-width: 480px)" sizes="100vw" srcset="{{ $designer->image('small.1:1') }} 360w, {{ $designer->image('medium.1:1') }} 650w">
      <!--[if IE 9]></video><![endif]-->
      <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{ $designer->image('medium.1:1') }} 1x, {{ $designer->image('large.1:1') }} 2x" alt="{{ $designer->title }}">
      <figcaption>
        <h3>{{ $designer->title }}</h3>
        <h4>{{ $designer->profession }}</h4>
        <p class="space-xs-top hyphens">{{$designer->bodyTruncated}}</p>
      </figcaption>
    </figure>
  </a>
</div>
