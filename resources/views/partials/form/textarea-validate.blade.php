<div class="form-group" data-ng-class="{'has-error':!modsvar.{{$name}}.$valid && modsvar.{{$name}}.$dirty}">
  <label>
    {{ isset($label) ? $label : $name }}
    @if (isset($maxChars))
      <span class="badge" data-ng-cloak data-ng-class="{'text-success': {{$name}}.length <= {{$maxChars}}, 'text-danger': {{$name}}.length > {{$maxChars}}}" data-ng-bind="({{$maxChars}} - {{$name}}.length)"></span>
    @endif
  </label>
  <div class="inner-form-group">
    <textarea name="{{$name}}" data-ng-model="{{$name}}" data-ng-init="{{$name}} = <?= htmlspecialchars(json_encode(isset($old) ? $old : null)); ?>" @if (isset($pattern) && $pattern) data-ng-pattern="/^[\w\0-9 æøåÆØÅéÉíÍ ;:’'–\—\?\©\®\™\s]*$/" @endif rows="{{$rows}}"
      class="form-control" {{ isset($required) ? '' : 'required' }}></textarea>
    <svg class="icon icon-ios-checkmark-empty form-feedback text-success" data-ng-cloak data-ng-if="modsvar.{{$name}}.$valid @if (isset($maxChars))&& {{$name}}.length <= {{$maxChars}}@endif"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
  </div>
  @if (isset($helpMsg))<span class="help-block" data-ng-cloak data-ng-hide="modsvar.{{$name}}.$invalid && modsvar.{{$name}}.$dirty @if (isset($maxChars))|| {{$name}}.length > {{$maxChars}}@endif">{{$helpMsg}}</span>@endif
  @if (isset($maxChars))<span class="help-block" data-ng-cloak data-ng-if="{{$name}}.length > {{$maxChars}}">Please shorten the number of characters</span>@endif
  @if (isset($pattern))<span class="help-block" data-ng-cloak data-ng-if="modsvar.{{$name}}.$invalid && modsvar.{{$name}}.$dirty">{{ isset($errorMsg) ? $errorMsg : 'Only the Danish alphabet, numbers, spaces and hyphens are allowed.' }}</span>@endif
</div>
