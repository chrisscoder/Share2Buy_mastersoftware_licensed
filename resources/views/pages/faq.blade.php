
@extends('layouts.app')

@section('meta_title', 'Prices drop for every order | Order today' )
@section('meta_description', 'Learn more about our marketplace and how you can make a great deal on quality and sustainable products right now' )

@section('content')
<article class="page space-l">
  <div class="container">
      <div class="row">
          <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-xl-6 col-xl-offset-3">
            <h1>FAQ - how it works</h1>
            <p>Modsvar is your online marketplace with the best quality and sustainable design, furniture, interior, accessories, beauty, and fashion. Buy directly from our sellers and save more by shopping with the crowd. Read our step-by-step FAQ and learn more about how it works.</p>

            <h3>How do I buy a product?</h3>
            <p>Simply click on the item, you wish to buy and follow the lead to checkout. You can pay with VISA, Mastercard or American Express. You won’t be charged before the campaign ends.</p>

            <h3>What is my final price?</h3>
            <p>Your final discount is reached, when the campaign ends. The more buyers, the more everyone saves. The price on your order confirmation is your maximum price.</p>

            <h3>How do I know, that I ordered a product?</h3>
            <p>You receive an order confirmation in an email as soon as you have ordered a product.</p>

            <h3>How do I know, when a campaign ends?</h3>
            <p>You receive a final receipt in an email as soon as the designer has processed your order.</p>

            <h3>How do I invite more people to join?</h3>
            <p>We made it really easy for you to invite more people, so you can lower your price even more. Just click on the social media icons, and they will take you directly you to your social media sites. Modsvar links to Facebook, twitter and Pinterest.</p>

            <h3>Do I have to invite people to buy a product?</h3>
            <p>You can buy all the products you wish without telling anyone. The products will not be shipped before 1-3 business days after the end of the campaign, though.</p>

            <h3>Why should I share the product that I just ordered?</h3>
            <p>When you share products in your social network, you help the designer to reach a bigger audience and your final price lowers, when more people join in.</p>

            <h3>When will I receive my order?</h3>
            <p>Your product will be shipped 1-3 business days after the campaign ends. You will receive your product(s) directly from the designer, you so kindly have supported.</p>

            <h3>What if I regret my order?</h3>
            <p>Your discount depends on the size of the crowd when the campaign ends. As a principle of loyalty it is not possible to jump out of a campaign after the order is confirmed. You can still return your product and request to get a refund within business 14 days, once you have received your product, though.</p>

            <h3>What if I have complaints concerning my product?</h3>
            <p>Please contact the designer for complaints regarding any errors or omissions. You will find the designers contact information on your receipt.</p>

            <h3>What if I need support?</h3>
            <p>Please contact: <a href="mailto:{{ config('constants.company_mail.support') }}">{{ config('constants.company_mail.support') }}</a></p>

          </div>
      </div>


  </div>
</article>
@endsection
