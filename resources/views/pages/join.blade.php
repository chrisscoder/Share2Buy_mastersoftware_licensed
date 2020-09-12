@php
$descriptions = [
    4 => [
        'quote' => 'Modsvar is a great and completely unselfish project, that is actually helping small upcoming designers reach out to the world.',
    ],
    24 => [
        'quote' => 'Modsvar has created a new an innovative business model that helps designers to reach out to their customers. It’s fun and social, letting people shop in groups while they support creative designers and save a lot of money.',
    ],
    33 => [
        'quote' => 'Modsvar gave me the platform i needed to follow my dreams. Now I have a shop where I can sell and promote my posters to a bigger audience. Modsvar reminded me, that graphic design is my passion and that it doesn\'t have to be that difficult to follow your dreams.',
    ],
    54 => [
        'quote' => 'Just as Solve, Modsvar is focused on changing paradigms regarding the way we shop and bringing it to a more personal and responsible approach. We are all about innovation and bringing more value to the customer, so the decision to join Modsvar came organically. The fresh concept of shopping with a crowd enables us, as a brand, to offer something back to our faithful customers: A great discount!',
    ],
    39 => [
      'quote' => 'Our products are for sale at Modsvar, because we celebrate great and innovative initiatives.
We believe that there will be many changes in the coming years - not just in the fashion industry but also in the entire distribution chain. Modsvar is a great example of this, because consumers can get together and buy quality designs and thus save money. I believe, that cooperation is the leading way, and it is really inspiring to see all the passionate and fiery souls who are successful with sustainable, social and economic-sharing products.'
    ]
];
@endphp
@extends('layouts.app')

@section('meta_title', 'Become a seller | Sell more online and reach out to a bigger audience' )
@section('meta_description', 'Sell online for free | Sell your products online and grow a bigger audience. Contact us now' )

@section('content')
<article class="page">
  <section class="space-l">
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-lg-8 col-lg-offset-2">
              <h1>Join our great team of sellers</h1>
              <div class="row">
                <div class="col-sm-6 hyphens">
                  <p>
                    Modsvar is your new online marketplace for quality design and sustainable living and lifestyle. We are here because of you. Our pleasure is to support independent businesses to grow and to earn more through the concept of crowd shopping! <a href="{{ route('page', ['about']) }}">Read more about the concept</a>.
                  </p>
                </div>
                <div class="col-sm-6 hyphens">
                  <p>
                    Modsvar is a platform founded in Denmark. We are opening for more countries soon. If you are a brand from outside Denmark interested in becoming a seller at Modsvar - send us an email, and we will contact you as soon as we’re ready. Stay tuned!
                  </p>
                </div>
              </div>
            </div>
        </div>
    </div>
  </section>
  <div class="space-l-bottom">
    <div class="container">
      <div class="row flex-row">

        @foreach ($designers as $key => $designer)
          <div class="col-md-4">
            <figure class="fig-quote tint">
              <!--[if IE 9]><video style="display: none;"><![endif]-->
              <source media="(max-width: 480px)" sizes="100vw" srcset="{{ $designer->image('small.1:1') }} 360w, {{ $designer->image('medium.1:1') }} 650w">
              <!--[if IE 9]></video><![endif]-->
              <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{ $designer->image('medium.1:1') }} 1x, {{ $designer->image('large.1:1') }} 2x" alt="{{ $designer->title }}">
              <figcaption>
                <blockquote>
                  <p>{{ $descriptions[$designer->id]['quote'] }}</p>
                </blockquote>
                <h3><a href="{{ route('designers.show', [$designer->slug]) }}">{{ $designer->title }}</a></h3>
                <h4>{{ $designer->profession }}</h4>
              </figcaption>
            </figure>
          </div>
        @endforeach

      </div>
    </div>
  </div>
  <section class="space-l white relative text-center">
    <div class="container">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-lg-8 col-lg-offset-2">
          <h2 class="space-m-bottom">Why you Should Join us</h2>
        </div>
      </div>
      <div class="row is-flex icon-row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
          <div class="box">
            <svg class="icon icon-coin"><use xlink:href="#icon-coin"></use></svg>
            <h3>No commissions or fees</h3>
            <p class="text-center hyphens-xs">It’s completely free to sell your products in our marketplace. Instead of charging you, we turn the business model around, so your customers earn a discount every time they buy a product from you. </p>
          </div>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
          <div class="box">
            <svg class="icon icon-coding"><use xlink:href="#icon-coding"></use></svg>
            <h3>No technical hassle</h3>
            <p class="text-center hyphens-xs">We take care off all the transactions and customer details, making it really easy for you to sell your products. All payments are directly and securely transferred between you and your customers.</p>
          </div>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0">
          <div class="box">
            <svg class="icon icon-team"><use xlink:href="#icon-team"></use></svg>
            <h3>Reach a bigger audience</h3>
            <p class="text-center hyphens-xs">The crowd invites more buyers to your campaigns by sharing your products in their social networks. Crowd shopping is all about sharing and caring about great design.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="space-l">
    <div class="container">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-lg-8 col-lg-offset-2">
          <h2>Does this sound like you?</h2>
          <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
              <p>To become a seller at Modsvar, you have to be selected or permitted access to the platform.</p>
              <p>If you can nod “Yes” to these, you are almost there:<br><br></p>
              <ul>
                <li>Quality is my middle name.</li>
                <li>I am highly committed to sell responsible products that are ethically or sustainably produced or/and designed.</li>
                <li>I am able to deliver a high quality photo material to my brand profile and to my products.</li>
                <li>I am responsible for my brand profile at Modsvar and I will make sure, every description and photo is correct.</li>
                <li>I am committed to my shop at Modsvar and I will regularly update my campaigns, photos and descriptions.</li>
                <li>I am responsible for my activities concerning my shop at Modsvar.</li>
                <li>Yes, I will read and accept the <a href="{{ route('page', ['seller-terms']) }}">Seller Terms</a>. </li>
              </ul>
              <br>
              <p>Did you nod “Yes”? Then send us an email to <a href="mailto:{{Config::get('constants.company_mail.info')}}">{{Config::get('constants.company_mail.info')}}</a>, with a short description and a collection of product photos, and we will get back to you.</p>
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
          <h2>Get our Newsletter for Sellers</h2>
          <p class="text-uppercase space-bottom">Get exciting insights about future platform updates, and be the first to know when we're opening for more countries.</p>
          @include('partials.newsletter-designer')
        </div>
      </div>
    </div>
  </section>

</article>
@endsection
