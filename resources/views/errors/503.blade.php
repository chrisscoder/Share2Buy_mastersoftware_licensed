<!DOCTYPE html>
<html lang="da">
<head>
  <meta charset="utf-8">
  <title>@yield('meta_title','We are in maintenance') - modsvar.com</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  <meta content="@yield('meta_description','default description')" name="description">

  {{-- Favicons --}}
  <link rel="apple-touch-icon" sizes="180x180" href="{{url('/')}}/images/browsericons/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="{{url('/')}}/images/browsericons/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="{{url('/')}}/images/browsericons/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="{{url('/')}}/images/browsericons/manifest.json">
  <link rel="mask-icon" href="{{url('/')}}/images/browsericons/safari-pinned-tab.svg" color="#00b298">
  <link rel="shortcut icon" href="{{url('/')}}/images/browsericons/favicon.ico">
  <meta name="msapplication-config" content="{{url('/')}}/images/browsericons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <!-- Styles -->
  <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

</head>
<body id="app-layout" data-ng-app="app">
  <!--[if lt IE 10]><div class="alert alert-warning"><p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p></div><![endif]-->

  <div class="fullscreen bg02 vertical-align">
    <div class="container">
      <div class="row space-xl">
        <div class="col-sm-7 col-md-7 col-sm-offset-3">
          {{-- <h1 class="space-bottom">Modsvar is working on making your experience even greater</h1>
          <p>We expect to be back shortly. Please come back soon.</p> --}}
          <h1 class="space-bottom">Modsvar is temporarily unavailable</h1>
          <p>We are working on improving your experience.</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-93017514-1', 'auto');
    ga('send', 'pageview');

  </script>

</body>
</html>
