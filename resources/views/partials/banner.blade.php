@if (Route::currentRouteName() == 'frontpage' OR Route::currentRouteName() == 'products' OR Route::currentRouteName() == 'products.show' OR Route::currentRouteName() == 'checkout')
<div class="banner">
  <ul>
    <li>
      Prices drop for every order
    </li>
    <li>
      1-3 days delivery
    </li>
    <li>
      Free shipping
    </li>
    <li>
      14 days return policy
    </li>
  </ul>
</div>
@endif
