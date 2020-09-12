<div class="form-group" data-ng-class="{'has-error':!modsvar.{{$name}}.$valid && modsvar.{{$name}}.$dirty}">
  <label>{{ isset($label) ? $label : $name }}</label>
  <div class="inner-form-group">
    <input type="text" name="{{$name}}" class="form-control" data-ng-model="{{$name}}" data-ng-init="{{$name}} = <?= htmlspecialchars(json_encode(isset($old) ? $old : null)); ?>" data-ng-pattern="/^(([^<>()\[\]\\.,;:\s@']+(\.[^<>()\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/" {{ isset($autofocus) == true ? 'autofocus' : '' }} {{ isset($required) ? '' : 'required' }}>

    @if (isset($required))
      <span class="form-feedback form-feedback-sm" ng-hide="modsvar.{{$name}}.$dirty">Optional</span>
    @else
      <svg class="icon icon-ios-checkmark-empty form-feedback text-success" data-ng-cloak data-ng-if="modsvar.{{$name}}.$valid"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
    @endif

  </div>
  @if (isset($helpMsg))
    <span class="help-block" data-ng-cloak data-ng-hide="modsvar.{{$name}}.$invalid && modsvar.{{$name}}.$dirty">{{$helpMsg}}</span>
  @endif

  <span class="help-block" data-ng-cloak data-ng-if="modsvar.{{$name}}.$invalid && modsvar.{{$name}}.$dirty">{{ isset($errorMsg) ? $errorMsg : 'Please provide a valid email.' }}</span>
</div>
