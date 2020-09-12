<div class="form-group" data-ng-class="{'has-error':!modsvar.{{$name}}.$valid && modsvar.{{$name}}.$dirty}">
  <label>{{ isset($label) ? $label : $name }} <span class="badge" data-ng-cloak data-ng-class="{'text-success': {{$name}}.length <= {{$maxChars}}, 'text-danger': {{$name}}.length > {{$maxChars}}}" data-ng-bind="({{$maxChars}} - {{$name}}.length)"></span></label>
  <div class="inner-form-group">
    <input type="text" name="{{$name}}" class="form-control" data-ng-model="{{$name}}" data-ng-init="{{$name}} = <?= htmlspecialchars(json_encode(isset($old) ? $old : null)); ?>" data-ng-pattern="/^[\w\0-9 æøåÆØÅéÉíÍ \' |\-\s]*$/" custom-maxlength="{{$maxChars}}" {{ isset($autofocus) == true ? 'autofocus' : '' }} {{ isset($required) ? '' : 'required' }}>
    @if (isset($required))
      <span class="form-feedback form-feedback-sm" ng-hide="modsvar.{{$name}}.$dirty">Optional</span>
    @else
      <svg class="icon icon-ios-checkmark-empty form-feedback text-success" data-ng-cloak data-ng-if="modsvar.{{$name}}.$valid && {{$name}}.length <= {{$maxChars}}"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
    @endif
  </div>
  @if (isset($helpMsg))
    <span class="help-block" data-ng-cloak data-ng-hide="modsvar.{{$name}}.$invalid && modsvar.{{$name}}.$dirty || {{$name}}.length > {{$maxChars}}">{{$helpMsg}}</span>
  @endif
  <span class="help-block" data-ng-cloak data-ng-if="{{$name}}.length > {{$maxChars}}">Please shorten the number of characters</span>
  <span class="help-block" data-ng-cloak data-ng-if="modsvar.{{$name}}.$invalid && modsvar.{{$name}}.$dirty">{{ isset($errorMsg) ? $errorMsg : 'Only the Danish alphabet, numbers, spaces and hyphens are allowed.' }}</span>
</div>
