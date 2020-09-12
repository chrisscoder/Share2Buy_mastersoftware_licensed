
@extends('layouts.app')

@section('meta_title', 'Sustainable lifestyle and living - a better choice' )
@section('meta_description', 'Buy directly from our sellers | Online marketplace with the best quality and sustainable interior design, furniture, accessories and fashion' )

@section('content')
<article class="page">
  <section class="space-l">
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-lg-8 col-lg-offset-2">
              <h1>We choose sustainability and long lasting products </h1>
              <div class="row">
                <div class="col-sm-6 hyphens">
                  <p>The future depends on us all - sellers as buyers. That is why we believe that we as new businesses must rethink the way we design, produce and sell goods and services. We have chosen to serve you an online platform, which connects and rewards conscious sellers and customers, all with the mission of limiting the manufacturing of unuseful goods, that we do not need.</p>
                </div>
                <div class="col-sm-6 hyphens">
                  <p>A good design and a quality product is sustainable because it is not produced just to be thrown away after it is purchased. Let’s work together and buy great products together. It’s a win-win.</p>
                </div>
              </div>
            </div>
        </div>
    </div>
  </section>
  <section class="space-l white relative text-center">
    <div class="container">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-lg-8 col-lg-offset-2">
          <h2 class="space-m-bottom">Online marketplace for quality and sustainability
          </h2>
        </div>
      </div>
      <div class="row is-flex icon-row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0 col-md-4">
          <div class="box">
            <svg class="icon icon-wallet"><use xlink:href="#icon-wallet"></use></svg>
            <h3>Thank you for your better choice</h3>
            <p class="text-center hyphens-xs">
              Find campaigns with the best quality and sustainable living, lifestyle and beauty products. As a thank you for your choice, we lower your price every time a product is sold. Find inspiration and check out sustainable living and lifestyle trends right now in our <a href="{{route('products')}}">marketplace</a> - we have already handpicked the best items for you.
            </p>
          </div>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0 col-md-4">
          <div class="box">
            <svg class="icon icon-sprout-1"><use xlink:href="#icon-sprout-1"></use></svg>
            <h3>Buy directly from brave brands</h3>
            <p class="text-center hyphens-xs">
              And here is the best part: Every time you buy a great product, you support great emerging brands to grow and scale their businesses. Instead of charging them substantial commissions and fees, we let them spoil you with a significant discount when you buy with the crowd. It’s a win-win. Remember: When you buy from a small business, an actual person does a little happy dance! <a href="{{route('designers')}}">Meet our sellers</a>
            </p>
          </div>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0 col-md-4">
          <div class="box">
            <svg class="icon icon-hierarchical-structure"><use xlink:href="#icon-hierarchical-structure"></use></svg>
            <h3>We reward you if you care and share</h3>
            <p class="text-center hyphens-xs">
              Order the product you wish to buy and invite more people from your social network, and spread the word of our great products, if you want to love your price even more. All buyers reach the lowest price when all items are sold in a campaign, and the first buyer is always guaranteed a great deal. This is our thank you for supporting our mission for a better future. Thank you for sharing.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>
  <section class="space-l">
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-lg-8 col-lg-offset-2">
              <h1>Join the Crowd</h1>
              <div class="row">
                <div class="col-sm-6 hyphens">
                  <p>Make a great deal today! Online shopping can be fun, sustainable and social!</p>
                  <p>Our vision is to build the world’s best social shopping community where passion for great design can be shared by people from all over the world - easy and simple.</p>
                  <p>Our mission with Modsvar is to help more brave brands to grow their businesses through cooperation and a great technology. Our pleasure is to give you the best collection of unique and hand picked interior design and sustainable fashion products.</p>
                </div>
                <div class="col-sm-6 hyphens">
                  <p>We just started this exciting journey and currently we are only open in Denmark. We will be opening for international sales and brands soon. So stay tuned!</p>
                  <p>If you have any questions please do not hesitate to get in touch <a href="mailto:{{Config::get('constants.company_mail.support')}}">{{Config::get('constants.company_mail.support')}}</a></p>
                </div>
              </div>
            </div>
        </div>
    </div>
  </section>
    <section class="space-l white">
      <div class="container relative">
        <div class="row">
          <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center signup-cta">
            <h2>Get our Newsletter</h2>
            <p class="text-uppercase space-bottom">Get insights about our designers, inspiration for your home, fashion trends and updates about new products.</p>
            @include('partials.newsletter')
          </div>
        </div>
      </div>
    </section>
    <div class="space-l">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <h2 class="space-l-bottom">Meet our Team</h2>
            <div class="row flex-row-sm">
              <div class="col-sm-3">
                <figure class="fig-quote tint">
                  <!--[if IE 9]><video style="display: none;"><![endif]-->
                  <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/press/staff/chrisstine-johannsen-modsvar-360w.jpg 360w, {{url('/')}}/images/press/staff/chrisstine-johannsen-modsvar-650w.jpg 650w">
                  <!--[if IE 9]></video><![endif]-->
                  <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/press/staff/chrisstine-johannsen-modsvar-360w.jpg 1x, {{url('/')}}/images/press/staff/chrisstine-johannsen-modsvar-650w.jpg 2x" alt="Chrisstine Johannsen CEO and founder Modsvar">
                  <figcaption>
                    <h3>Chrisstine Johannsen</h3>
                    <h4>CEO and Partner</h4>
                  </figcaption>
                </figure>
              </div>
              <div class="col-sm-3">
                <figure class="fig-quote tint">
                  <!--[if IE 9]><video style="display: none;"><![endif]-->
                  <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/press/staff/martin-lynge-jensen-modsvar-360w.jpg 360w, {{url('/')}}/images/press/staff/martin-lynge-jensen-modsvar-650w.jpg 650w">
                  <!--[if IE 9]></video><![endif]-->
                  <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/press/staff/martin-lynge-jensen-modsvar-360w.jpg 1x, {{url('/')}}/images/press/staff/martin-lynge-jensen-modsvar-650w.jpg 2x" alt="Martin Lynge CTO and partner Modsvar">
                  <figcaption>
                    <h3>Martin Lynge</h3>
                    <h4>CTO and Partner</h4>
                  </figcaption>
                </figure>
              </div>
              <div class="col-sm-3">
               <figure class="fig-quote tint">
                 <!--[if IE 9]><video style="display: none;"><![endif]-->
                 <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/press/staff/pernille-ravn-modsvar-360w.jpg 360w, {{url('/')}}/images/press/staff/pernille-ravn-modsvar-650w.jpg 650w">
                 <!--[if IE 9]></video><![endif]-->
                 <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/press/staff/pernille-ravn-modsvar-360w.jpg 1x, {{url('/')}}/images/press/staff/pernille-ravn-modsvar-650w.jpg 2x" alt="Pernille Ravn – Modsvar">
                 <figcaption>
                   <h3>Pernille Ravn</h3>
                   <h4>Communications and Press</h4>
                 </figcaption>
               </figure>
             </div>
              <div class="col-sm-3">
               <figure class="fig-quote tint">
                 <!--[if IE 9]><video style="display: none;"><![endif]-->
                 <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/press/staff/simone-modsvar-360w.jpg 360w, {{url('/')}}/images/press/staff/simone-modsvar-650w.jpg 650w">
                 <!--[if IE 9]></video><![endif]-->
                 <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/press/staff/simone-modsvar-360w.jpg 1x, {{url('/')}}/images/press/staff/simone-modsvar-650w.jpg 2x" alt="Simone Vestergaard – Intern at Modsvar">
                 <figcaption>
                   <h3>Simone Vestergaard</h3>
                   <h4>Intern</h4>
                 </figcaption>
               </figure>
             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</article>
@endsection
