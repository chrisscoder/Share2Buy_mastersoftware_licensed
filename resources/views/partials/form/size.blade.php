<div class="form-group" data-ng-class="{'has-error':!modsvar.type_value.$valid && modsvar.type_value.$dirty}">
  <label>{{$label}}</label>
  <div class="inner-form-group">
    <input type="text" name="type_value" data-ng-model="post.productTypeValue" data-ng-init="post.productTypeValue = <?= htmlspecialchars(json_encode(isset($old) ? $old : null)); ?>" class="form-control" data-ng-pattern="/^[a-zA-Z0-9\-\;\s]+$/" required>
    <svg class="icon icon-ios-checkmark-empty form-feedback text-success" data-ng-cloak data-ng-if="modsvar.type_value.$valid"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
  </div>
  <span class="help-block">Use semicolon (;) to separate sizes e.g. small;medium;large</span>
  <span class="help-block text-danger" data-ng-cloak data-ng-if="!modsvar.type_value.$valid && modsvar.type_value.$touched">Only letters, numbers, semicolons, hyphens and spaces are allowed.</span>
</div>
