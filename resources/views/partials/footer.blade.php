<footer>
  <div class="footer">
    <div class="container space-l">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0">
          <div class="box">
            <h6 class="no-margin-top">Secure credit card payment</h6>
            <ul class="payments">
              <li><svg class="icon icon-visa" aria-labelledby="visa-title" role="img"><title id="visa-title">VISA</title><desc id=""></desc><use xlink:href="#icon-visa"></use></svg></li>
              <li><svg class="icon icon-mastercard" aria-labelledby="mastercard-title" role="img"><title id="mastercard-title">MasterCard</title><use xlink:href="#icon-mastercard"></use></svg></li>
              <li><svg class="icon icon-american-express" aria-labelledby="american-express-title" role="img"><title id="american-express-title">American Express</title><use xlink:href="#icon-american-express"></use></svg></li>
            </ul>
          </div>
        </div>
        <div class="col-xs-5 col-xs-offset-1 col-sm-3 col-sm-offset-0">
          <div class="box text-left-xs">
            <h6>Service</h6>
            <ul>
              <li><a href="{{ route('page', ['faq']) }}">FAQ</a></li>
              <li><a href="{{ route('page', ['cookie-privacy-policy']) }}">Cookie and Privacy Policy</a></li>
              <li><a href="{{ route('page', ['terms-and-conditions']) }}">Terms and Conditions</a></li>
              <li><a href="{{ route('page', ['seller-terms']) }}">Seller Terms</a></li>
              @foreach($footerLinksLeft as $page)
                <li>
                  <a href="{{ route('page', [$page->slug]) }}">{{ $page->menu_title }}</a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="col-xs-5 col-sm-3">
          <div class="box text-left-xs">
            <h6>Company</h6>
            <ul>
              <li><a href="{{ route('page', ['about']) }}">About us</a></li>
              <li><a href="{{ route('page', ['join']) }}">Join us</a></li>
              @foreach($footerLinksRight as $page)
                <li>
                  <a href="{{ route('page', [$page->slug]) }}">{{ $page->menu_title }}</a>
                </li>
              @endforeach

              @auth
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
              @else
                <li><a href="{{ route('login') }}">Log in</a></li>
              @endauth
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="subfooter">
    <div class="container">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-sm-push-6 social-logos-wrapper">
          <div class="box">
            <ul class="social-logos">
              <li>
                <a href="{{ Config::get('constants.social_media.facebook') }}" title="Følge os på Facebook" target="_blank">
                  <svg class="icon icon-social-facebook"><use xlink:href="#icon-social-facebook"></use></svg>
                  <span class="sr-only">Facebook</span>
                </a>
              </li>
              <li>
                <a href="{{ Config::get('constants.social_media.twitter') }}" title="Følge os på Twitter" target="_blank">
                  <svg class="icon icon-social-twitter"><use xlink:href="#icon-social-twitter"></use></svg>
                  <span class="sr-only">Twitter</span>
                </a>
              </li>
              <li>
                <a href="{{ Config::get('constants.social_media.instagram') }}" title="Følge os på Instagram" target="_blank">
                  <svg class="icon icon-social-instagram-outline"><use xlink:href="#icon-social-instagram-outline"></use></svg>
                  <span class="sr-only">Instagram</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-sm-pull-6">
          <div class="box">
            <div class="logo">
              <svg id="logo" class="icon icon-modsvarlogo"><use xlink:href="#icon-modsvarlogo"></use></svg>
            </div>
            <p class="small">© {{ Carbon\Carbon::now()->year }} modsvar.com – All rights reserved</p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="cookie-concent-wrapper" data-consent="cookie-disclaimer" data-ng-cloak>
    <div class="cookie-concent" data-ng-if="$consent.hasNotAgreedYet()">
      <div class="cookie-disclaimer">
        <p>Like all webshops we use cookies. By continuing to use our site, you are agreeing to our cookie policy.<br />You can read more about this technical gimmick: <a href="{{ route('page', ['cookie-privacy-policy']) }}">here</a></p>
      </div>
      <button class="btn-close" data-ng-click="$consent.agree();"></button>
    </div>
  </div>
</footer>
