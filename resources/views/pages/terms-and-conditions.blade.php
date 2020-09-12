
@extends('layouts.app')

@section('meta_title', 'Terms and conditions' )

@section('content')
<article class="page space-l">
  <div class="container">
      <div class="row">
          <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-xl-6 col-xl-offset-3">
            <h1>Terms and conditions</h1>

            <ol>
              <li><strong>General</strong>
                <ol>
                  <li>The following conditions apply to any purchase made by the customer through MODSVAR IVS, CVR-no. 37591491 (hereinafter referred to as MODSVAR and its website).</li>
                  <li>MODSVAR is an online platform (hereinafter referred to as "Communication Service") and acts solely as an intermediary between Designers - with a variety of assorted clothing, furniture, accessories, interior, etc. - and the customer. The products specified on the Communication Service are not products which MODSVAR have produced or requested to be produced, and MODSVAR is therefore not the designer or supplier of the products. Only the individual designers can be referred to as such.</li>
                  <li>When a designer has created an offer on the Communication Service, the product can be offered for a period of 7 or 14 days unless it is possible to choose another offer period. The offer period automatically ends when all 10 products are sold or when the offer period ends.</li>
                  <li>The designer creates a product with an offer price. The offer price is the price incl. VAT and thus the price without discount.</li>
                </ol>
              </li>
              <li><strong>Agreement</strong>
                <ol>
                  <li>The Customer is obligated to the purchase when the customer has reserved a product and received an order confirmation. By reservations means that The Customer has filled in their payment information and completed the payment. The Payment is not charged before after the end of the offer period cf. section 4.3 and 4.4.</li>
                </ol>
              </li>
              <li><strong>Prices and fees</strong>
                <ol>
                  <li>The customer can obtain discounts on the products in connection with the time of the established price, and the discount depends on how many products sold when the offer expires.</li>
                  <li>The price with and without the discount is indicated incl. VAT, duties, fees, taxes and delivery costs.</li>
                  <li>Modsvar charges a flat fee of 7% of the offering price cf. section 1.4.</li>
                  <li>Modsvar takes reservations for printing errors in prices and product descriptions, and Modsvar is not responsible if there may be type or description errors. </li>
                </ol>
              </li>
              <li><strong>Payments and order confirmations</strong>
                <ol>
                  <li>The customer can pay by credit card, VISA / Dankort, EURO / MasterCard or American Express.</li>
                  <li>The customer receives an order confirmation as soon as the product is ordered. </li>
                  <li>The customer receives a receipt after the offer period when the designer has processed the order cf. section 1.3.</li>
                  <li>The customer will not be charged before after end of the offer period cf. section 1.3.</li>
                </ol>
              </li>
              <li><strong>Delivery</strong>
                <ol>
                  <li>The Designer is obligated to ship the purchased products to the customer within 1-3 business days after the offer has expired, unless it is clearly stated that other terms apply.</li>
                  <li>All products are shipped through a recognised freight forwarder and are delivered to the address stated on the customer’s order or according sellers delivery terms.</li>
                  <li>The Designer is responsible for paying the shipping costs, unless other terms have been settled in the present order. If The Designer wishes to take out a transport insurance it is at the cost of The Designer.</li>
                  <li>Delivery is complete when the item is in the possession of the customer.</li>
                </ol>
              </li>
              <li><strong>Security and data policy</strong>
                <ol>
                  <li>Customer's privacy is important to MODSVAR. Therefore, our payment solution based on the SSL standard, which means that the information that Customers provide in connection with its payment, is protected by encryption. As a form of encryption for electronic commerce is SSL standard very common and is considered a very secure solution.</li>
                  <li>In order to complete a purchase from MODSVAR, we need personal data for the purpose of Designers being able to deliver the product to the customer.</li>
                  <li>Personal information registered with MODSVAR is stored for 5 years.</li>
                  <li>The CEO of the Company Modsvar has access to the personal information and is also the main responsible for all personal data. </li>
                  <li>Modsvar does not hand over or sell any personal information to third parties. </li>
                  <li>Modsvar does not obtain or register any private or personal information.<br>Please also read our <a href="{{ route('page', ['cookie-privacy-policy']) }}">cookie policy</a></li>
                </ol>
              </li>
              <li><strong>Cancellations and returns</strong>
                <ol>
                  <li>According to the Consumer Contracts Act the customer is entitled to cancel and return the purchase no later than 14 days after purchase. The 14 days are counted from the day the customer physically receives the product. The Designer is at all times responsible for upholding the terms stated in the Consumer Contracts Act.</li>
                  <li>If the customer intends to use the right to cancel the order then the customer must make The Designer aware of this intention in a clear manner before the time of the right to cancel expires.</li>
                  <li>This message must be sent to The Designer’s contact information stated on the order confirmation. The Designer is, thereby, at all times obligated to update its profile if there are any changes. The customer may also use the standard cancellation form which The Designer is obligated to include in the package. The Designer is obligated to use the approved cancellation form.</li>
                  <li>Any cost in connection with returning the product is paid by the customer. If the products is accidentally lost or damaged during return shipping the customer is subject to covering the cost.</li>
                  <li>The customer is liable for any devaluation of the product if the use of the product is beyond of what is regarded as necessary in order to assess the nature, quality, and testing of the product. The cancellation right is upheld after this assessment in the way that The Designer is entitled to subtract this devaluation in the refund.</li>
                  <li>The Designer must transfer the purchase price back to the customer no later than 14 days after the date of the customer’s cancellation. The Designer is entitled to withhold the purchase price of the product until the return of the product or until the customer has adequately proven the return of the product.</li>
                  <li>However, The Designer is entitled to subtract the mentioned costs in the products’ purchase price cf. section 6.4 and section 6.5.</li>
                </ol>
              </li>
              <li><strong>Warranty</strong>
                <ol>
                  <li>The customer has a 2 year warranty to The Designer for defects under the Sale of Goods Act.</li>
                  <li>If the customer wished to invoke the warranty, the customer must notify The Designer within reasonable time.</li>
                  <li>The Designer is obligated to remedy the defect or replace the product with no regard to the defect statements in the Sale of Goods Act.</li>
                  <li>Reasonable costs of shipping with regards to the warranty are paid by The Designer.</li>
                </ol>
              </li>
              <li><strong>Liability</strong>
                <ol>
                  <li>Modsvar is not liable to the customer for conditions that can be attributed to the designer's acts or omissions.</li>
                </ol>
              </li>
              <li><strong>Complaints</strong>
                <ol>
                  <li>Complaints regarding a product bought by a Designer via Modsvars Service may be sent to:<br>Konkurrence- og Forbrugerstyrelsen<br>Carl Jacobsens Vej 35<br>DK-2500 Valby</li>
                  <li>European Commission's online complaint portal can also be used when filing a complaint. It is particularly relevant if you are a consumer residing in another EU country. Complaints can be sent to: <a href="http://ec.europa.eu/odr">Online Dispute Resolution</a></li>
                </ol>
              </li>
              <li><strong>Law and Jurisdiction</strong>
                <ol>
                  <li>Any dispute under these terms and conditions must be settled by Danish law at the court in Aalborg.</li>
                </ol>
              </li>
              <li><strong>Contact information</strong>
                <ol>
                  <li>
                    {{ config('constants.company.name') }}
                    {{ config('constants.company.type') }}<br>
                    {{ config('constants.company.address') }}<br>
                    {{ config('constants.company.zip') }} {{ config('constants.company.city') }}<br>
                    {{ config('constants.company.country') }}<br>
                    VAT ID: {{ config('constants.company.vat_id') }}<br><br>
                    <a href="mailto:{{ config('constants.company_mail.support') }}">{{ config('constants.company_mail.support') }}</a>
                  </li>
                </ol>
              </li>
            </ol>
          </div>
      </div>


  </div>
</article>
@endsection
