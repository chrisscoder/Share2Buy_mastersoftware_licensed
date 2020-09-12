<div class="form-group" data-ng-class="{'has-error':!modsvar.{{$name}}.$valid && modsvar.{{$name}}.$dirty}">
  <label>{{ isset($label) ? $label : $name }}</label>
  <div class="inner-form-group">
    <input type="number" step="any" name="{{$name}}" data-ng-model="{{$name}}" data-ng-init="{{$name}} = <?= htmlspecialchars(json_encode(isset($old) ? $old : null)); ?>" data-ng-pattern="/^[0-9 ,]{1,}$/" class="form-control" placeholder="0" {{ isset($required) ? '' : 'required' }}>
    <svg class="icon icon-ios-checkmark-empty form-feedback text-success" data-ng-cloak data-ng-if="modsvar.{{$name}}.$valid"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
  </div>
  <span class="help-block" data-ng-cloak data-ng-hide="modsvar.{{$name}}.$invalid && modsvar.{{$name}}.$dirty">{{$helpMsg}}</span>
  <span class="help-block" data-ng-cloak data-ng-if="modsvar.{{$name}}.$invalid && modsvar.{{$name}}.$dirty">{{ isset($errorMsg) ? $errorMsg : 'Only numbers and commas are allowed.' }}</span>
</div>
