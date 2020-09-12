<div class="form-group" data-ng-class="{'has-error':!modsvar.category.$valid && modsvar.category.$dirty}">
  <label>Main category</label>
  <div class="select-option">
    <select class="form-control select-option-control" name="category" data-ng-model="post.category" data-ng-init="post.category = <?= htmlspecialchars(json_encode(isset($oldCategory) ? $oldCategory : null)); ?>" required>
      <option value="lifestyle">Lifestyle</option>
      <option value="living">Living</option>
      <option value="beauty">Beauty</option>
      <option value="kids">Kids</option>
      <option value="kids">other</option>
    </select>
    <svg class="icon icon-ios-checkmark-empty text-success" data-ng-cloak data-ng-if="modsvar.category.$valid"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
    <svg class="icon icon-ios-arrow-down"><use xlink:href="#icon-ios-arrow-down"></use></svg>
  </div>
</div>

<div class="form-group" data-ng-class="{'has-error':!modsvar.type.$valid && modsvar.type.$dirty}">
  <label>Subcategory</label>
  <div class="select-option">
    <select class="form-control select-option-control" name="type" data-ng-model="post.productType" data-ng-init="post.productType = <?= htmlspecialchars(json_encode(isset($oldType) ? $oldType : null)); ?>" required>
      <option value="women" data-ng-if="post.category == 'lifestyle'">Women</option>
      <option value="men" data-ng-if="post.category == 'lifestyle'">Men</option>
      <option value="accessories" data-ng-if="post.category == 'lifestyle'">Accessories</option>
      <option value="jewelry" data-ng-if="post.category == 'lifestyle'">Jewelry</option>

      <option value="furniture" data-ng-if="post.category == 'living'">Furniture</option>
      <option value="interior" data-ng-if="post.category == 'living'">Interior</option>
      <option value="graphic" data-ng-if="post.category == 'living'">Graphic</option>

      <option value="makeup" data-ng-if="post.category == 'beauty'">Makeup</option>
      <option value="wellness" data-ng-if="post.category == 'beauty'">Wellness</option>

      <option value="kids-lifestyle" data-ng-if="post.category == 'kids'">Kids Living</option>
      <option value="kids-wellness" data-ng-if="post.category == 'kids'">Kids Lifestyle</option>

      <option value="other" data-ng-if="post.category == 'other'">Other</option>
    </select>
    <svg class="icon icon-ios-checkmark-empty text-success" data-ng-cloak data-ng-if="modsvar.type.$valid"><use xlink:href="#icon-ios-checkmark-empty"></use></svg>
    <svg class="icon icon-ios-arrow-down"><use xlink:href="#icon-ios-arrow-down"></use></svg>
  </div>
</div>
