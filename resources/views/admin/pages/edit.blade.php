@extends('layouts.app')

@section('content')
<section class="admin space-l">
<div class="container-fluid">

  @if (Session::has('message'))
     <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

  <div class="row">
  <div class="col-md-12">
    <h2 class="heading">Opdater side</h2><span class="pull-right logout"><a href="{{ route('dashboard') }}" class="text-uppercase">Mit dashboard</a></span>
    <form name="modsvar" method="post" action="{{ route('admin.pages.update', [$page->id]) }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="panel">
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-8">
              <input type="hidden" name="id" value="{{ $page->id }}">
              <div class="form-group">
                <label for="title">Overskrift</label>
                <div class="input-group">
                  <input type="text" name="title" id="title" class="form-control" data-ng-model="post.title" data-ng-init="post.title = <?= htmlspecialchars(json_encode($page->title)); ?>" data-ng-minlength="3" placeholder="Skriv overskrift her..." autofocus required>
                  <span class="input-group-addon" data-ng-class="{'text-success':post.title.length >= 3, 'text-danger':post.title.length >= 55}" data-ng-bind="55 - post.title.length"></span>
                  <span class="input-group-addon">
                    <svg class="icon icon-ios-checkmark-empty" data-ng-class="{'text-success':modsvar.title.$valid, 'text-danger':!modsvar.title.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                  </span>
                </div>
              </div>

              <div class="form-group">
                <label>Underoverskrift</label>
                <div class="input-group">
                  <input type="text" name="intro" data-ng-model="intro" data-ng-init="intro = <?= htmlspecialchars(json_encode($page->intro)); ?>" data-ng-minlength="3" class="form-control" placeholder="Skriv manchet her...">
                  <span class="input-group-addon" data-ng-class="{'text-success':intro.length >= 3, 'text-danger':intro.length > 120}" data-ng-bind="120 - intro.length"></span>
                </div>
              </div>

              <div class="row space-m-top">
                <header class="text-center col-sm-12">
                  <h2>
                    <small class="manchet">
                      <span>Topbillede</span>
                    </small>
                  </h2>
                </header>
                @if (!is_null($page->image1))
                <div class="col-sm-12 space-bottom">
                  <img src="{{ $page->image('large') }}" alt="{{ $page->imageAlt }}" />
                </div>
                @endif
                <input type="hidden" name="remove_image" value="false" />
                <div class="col-sm-12 space-bottom">
                  <input type="file" name="image" data-ng-model="post.image" id="image" class="inputfile" accept=".jpg,.jpeg,.png">
                  <label for="image" class="btn btn-default btn-block btn-file">
                    <svg class="icon icon-upload"><use xlink:href="#icon-upload"></use></svg>
                    <span data-ng-bind="post.image == null ? 'Skift billede' : (post.image | replaceFilePath)"></span>
                  </label>
                </div>
                <div class="col-sm-12">
                  <label for="imageAlt" class="sr-only">Alt</label>
                  <div class="input-group">
                    <input type="text" name="imageAlt" id="imageAlt" data-ng-model="post.imageAlt" class="form-control" placeholder="Improve your SEO and describe the image...">
                    <span class="input-group-addon" data-ng-class="{'text-success':post.imageAlt.length >= 3, 'text-danger':post.imageAlt.length > 100}" data-ng-bind="100 - post.imageAlt.length"></span>
                  </div>
                </div>
                <div class="col-sm-12">
                  <span class="help-block">Topbilledet skal være i (16:9) format i en opløgning på 1920 x 1080 px. Billedet skal være gemt til web i 72 pixels pr. tomme (ppi), og max fylde 10 MB.</span>
                </div>
              </div>

              <div class="form-group">
                <label>Brødtekst</label>
                <div class="input-group">
                  <textarea name="body" data-ng-model="post.body" data-ng-init="post.body = <?= htmlspecialchars(json_encode($page->body)); ?>" data-ng-minlength="3" rows="20" class="form-control" placeholder="Skriv brødtekst her..." required></textarea>
                  <span class="input-group-addon" data-ng-class="{'text-success':post.body.length >= 3}" data-ng-bind="post.body.length"></span>
                  <span class="input-group-addon">
                    <svg class="icon icon-ios-checkmark-empty" data-ng-class="{'text-success':modsvar.body.$valid, 'text-danger':!modsvar.body.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                  </span>
                </div>
                <span class="help-block">En tekstlængde på min. 300 ord anbefales i forbindelse med SEO.</span>
              </div>

            </div>
            <div class="col-sm-4">

              <div class="form-header">
                <header class="text-center">
                  <h2>
                    <small class="manchet">
                      <span>Menu placering</span>
                    </small>
                  </h2>
                </header>
              </div>
              <div class="form-group">
                <label for="menu_place" class="sr-only">Menu placering</label>
                <div class="input-group">
                  <select class="form-control" name="menu_place" id="menu_place" data-ng-model="post.menuPlacement" data-ng-init="post.menuPlacement = <?= htmlspecialchars(json_encode($page->menu_place)); ?>" required>
                    <option value="">-- Menu placering --</option>
                    <option value="designer">Designer dashboard</option>
                    <option value="left">Footer menu - Venstre</option>
                    <option value="right">Footer menu - Højre</option>
                  </select>
                  <span class="input-group-addon">
                    <svg class="icon icon-ios-checkmark-empty" data-ng-class="{'text-success':modsvar.menu_place.$valid, 'text-danger':!modsvar.menu_place.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="menu_title">Menu title</label>
                <div class="input-group">
                  <input type="input" data-ng-model="post.menuTitle" id="menu_title" data-ng-init="post.menuTitle= <?= htmlspecialchars(json_encode($page->menu_title)); ?>" data-ng-minlength="2" name="menu_title" class="form-control" required>
                  <span class="input-group-addon" data-ng-class="{'text-success':post.menuTitle.length >= 3, 'text-danger':post.menuTitle.length >= 55}" data-ng-bind="55 - post.menuTitle.length"></span>
                  <span class="input-group-addon">
                    <svg class="icon icon-ios-checkmark-empty" data-ng-class="{'text-success':modsvar.menu_title.$valid, 'text-danger':!modsvar.menu_title.$valid}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
                  </span>
                </div>
                <span class="help-block">Vælg et beskrivende og meningsfuldt menunavn</span>
              </div>
            </div>
          </div>
          @include('partials.seoform-edit', array('meta_title' => $page->meta_title, 'meta_description' => $page->meta_description))
          <div class="form-group">
            <button type="submit" class="btn btn-default btn-lg pull-right">Opdater side</button>
          </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
@endsection
