<div class="form-group" data-ng-class="{'has-error':!modsvar.{{$name}}.$valid && modsvar.{{$name}}.$dirty}">
  <label>{{ isset($label) ? $label : $name }}</label>
  <div class="inner-form-group">
    <input class="form-control" type="text" name="{{$name}}" data-date-time data-ng-model="{{$name}}.today" data-ng-init="{{$name}}.today = formatDate(<?= htmlspecialchars(json_encode(isset($old) ? $old : null)); ?>)" data-view="date" data-max-view="month" data-min-date="{{$name}}.minDate" data-timezone="Europe/Copenhagen" data-format="DD/MM/YYYY HH:mm" readonly data-ng-disabled="{{$product->campaignDisabled}}" data-ng-required="dateValidation({{$name}}.today,{{$name}}.minDate)">
    <svg class="icon icon-android-lock form-feedback form-feedback-sm" ng-if="{{$product->campaignDisabled}}"><use xlink:href="#icon-android-lock"></use></svg>
    <svg class="icon icon-android-unlock form-feedback form-feedback-sm" ng-if="{{!$product->campaignDisabled}}" data-ng-class="{'text-success':({{$name}}.today >= {{$name}}.minDate), 'text-danger':({{$name}}.today < {{$name}}.minDate)}"><use xlink:href="#icon-android-unlock"></use></svg>
  </div>
  <span class="help-block">Start date and time are locked on release and can only be changed before and after the sales period or when the product is sold out.</span>
</div>
