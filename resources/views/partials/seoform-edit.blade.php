<div class="space-l">
  <div class="form-header">
    <header class=" text-center">
      <h2>
        <small class="manchet">
          <span>Improve your Ranking (SEO)</span>
        </small>
      </h2>
    </header>
  </div>
  @include('partials.form.input-validate',['label'=>'Meta title','name'=>'meta_title','old'=>$meta_title,'maxChars'=>'55','required'=>'false','helpMsg'=>'The meta title should ideally captivate potential buyers. Be descriptive and concise.'])
  @include('partials.form.input-validate',['label'=>'Meta Description','name'=>'meta_description','old'=>$meta_description,'maxChars'=>'155','required'=>'false','helpMsg'=>'With a intriguing meta description, you have the chance to motivate people looking for great design on Google to click through to your product...'])
</div>
