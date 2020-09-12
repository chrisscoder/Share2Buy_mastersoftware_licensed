<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <title>@yield('meta_title','Quality & Sustainable products for him & her') - Modsvar</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  <meta content="@yield('meta_description','Free shipping | Buy with others online, support brave brands and make a great deal on the best quality and sustainable products')" name="description">

  <meta name="csrf-token" content="{{ csrf_token() }}" />

  {{-- Favicons --}}
  <link rel="apple-touch-icon" sizes="180x180" href="{{url('/')}}/images/browsericons/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="{{url('/')}}/images/browsericons/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="{{url('/')}}/images/browsericons/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="{{url('/')}}/images/browsericons/manifest.json">
  <link rel="mask-icon" href="{{url('/')}}/images/browsericons/safari-pinned-tab.svg" color="#00b298">
  <link rel="shortcut icon" href="{{url('/')}}/images/browsericons/favicon.ico">
  <meta name="msapplication-config" content="{{url('/')}}/images/browsericons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  {{-- Twitter card --}}
  <meta content="summary_large_image" name="twitter:card">
  <meta content="@modsvardk" name="twitter:site">
  <meta content="@modsvardk" name="twitter:creator">
  <meta content="@yield('meta_title','default title') - modsvar.com" name="twitter:title">
  <meta content="@yield('meta_description','default description')" name="twitter:description">
  <meta content="{{URL::to('/')}}@yield('social_image','/images/logo/modsvar-group-buy-marketplace-for-interior-design-and-fashion.png')" name="twitter:image">

  {{-- Open Graph protocol - Facebook/Google+ and LinkedIn --}}
  <meta content="{{url()->current()}}" property="og:url">
  <meta content="@yield('meta_title','default title') - modsvar.com" property="og:title">
  <meta content="@yield('meta_description','default description')" property="og:description">
  <meta content="Modsvar" property="og:site_name">
  <meta content="{{URL::to('/')}}@yield('social_image','/images/logo/modsvar-group-buy-marketplace-for-interior-design-and-fashion.png')" property="og:image">
  <meta content="956145601137403" property="fb:admins">
  <meta content="924474241031399" property="fb:app_id">
  <meta content="website" property="og:type">
  <meta content="da_DK" property="og:locale">

  {{-- Styles --}}
  <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
  {{-- Avoid flash --}}
  <style>
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
    display: none !important;
    }
  </style>

  {{-- Hotjar Tracking Code Production --}}
  @if (App::environment('production'))
  <script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:686190,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
  </script>
  @endif

  {{-- Hotjar Tracking Code Staging --}}
  @if (App::environment('staging'))
  <script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:686765,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
  </script>
  @endif

  {{-- Facebook Pixel Code --}}
  <script>
  !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
  n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
  document,'script','https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '423519137980736'); // Insert your pixel ID here.
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=423519137980736&ev=PageView&noscript=1"
  /></noscript>
  {{-- DO NOT MODIFY --}}
  {{-- End Facebook Pixel Code --}}

</head>
<body id="app-layout" data-ng-app="app">
  <!--[if lt IE 10]><div class="alert alert-warning"><p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p></div><![endif]-->

  @if (!Auth::guest())
    @include('partials.svg-symbols-backend')
  @endif
  @include('partials.svg-symbols')

  @include('partials.navbar')

  @if (Route::currentRouteName() == 'frontpage' OR Route::currentRouteName() == 'products' OR Route::currentRouteName() == 'products.show' OR Route::currentRouteName() == 'checkout')
    <main role="main" class="has-banner">
  @else
    <main role="main">
  @endif
    @if (Auth::check() && Auth::user()->role == 'admin' && str_contains(url()->current(), '/admin'))
      @include('partials.admin-nav')
    @endif
    @yield('content')
  </main>

  @include('partials.footer')

  {{-- JavaScripts --}}
  <script src="{{ elixir('js/app.js') }}"></script>
  @stack('scripts')

  @if (App::environment('production'))
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-93017514-1', 'auto');
    ga('send', 'pageview');

    </script>
  @endif

</body>
</html>
