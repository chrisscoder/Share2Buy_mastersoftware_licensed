<div class="form-group" data-ng-class="{'has-error':!modsvar.{{$name}}.$valid && modsvar.{{$name}}.$dirty}">

  @php
    if (empty($old) && isset($selected)) {
      $old = $selected;
    }
  @endphp

  <label>{{$label}}</label>
  <div class="select-option">
    <select class="form-control select-option-control" name="{{$name}}" data-ng-model="{{$name}}" data-ng-init="{{$name}} = <?= htmlspecialchars(json_encode(isset($old) ? $old : null)); ?>" {{ isset($required) ? '' : 'required' }}>
      @foreach ($variable as $key => $value)
        <option value="{{$key}}">{{$value}}</option>
      @endforeach
    </select>
    <svg class="icon icon-ios-checkmark-empty text-success" data-ng-cloak data-ng-if="modsvar.{{$name}}.$valid"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
    <svg class="icon icon-ios-arrow-down"><use xlink:href="#icon-ios-arrow-down"></use></svg>
  </div>
  <span class="help-block">{{$helpMsg}}</span>
</div>
