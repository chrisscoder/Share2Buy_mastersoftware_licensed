<label>{{$label}}</label>
<input type="file" name="{{$name}}" data-ng-model="{{$name}}" valid-file id="{{$name}}" class="inputfile" accept=".jpg,.jpeg,.png" {{ isset($required) ? '' : 'required' }}>
<div class="form-group img-form-group">
  <label for="{{$name}}" class="btn btn-default btn-block btn-file">
    <svg class="icon icon-upload"><use xlink:href="#icon-upload"></use></svg>
    <span data-ng-bind-html="{{$name}} == null ? '{{$btnLabel}}' : ({{$name}} | replaceFilePath)"></span>
  </label>
</div>
<span class="help-block">{{$helpMsg}}</span>
