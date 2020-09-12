
@extends('layouts.app')

@section('meta_title', 'Seller terms' )

@section('content')
<article class="page space-l">
  <div class="container">
      <div class="row">
          <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-xl-6 col-xl-offset-3">
            <h1 class="space-bottom">Seller terms</h1>
            <p class="text-center">Read more about how to become a <a href="{{ route('page', ['about']) }}">seller on MODSVAR</a></p>
            <ol>
              <li><strong>General terms</strong>
                <ol>
                  <li>The following conditions apply to any purchase made by the customer through MODSVAR IVS, CVR-no. 37591491 (hereinafter referred to as MODSVAR and its website). The conditions apply between The Designer and MODSVAR. The Designer is also familiar with the conditions that apply to the Customer, and The Designer guarantees that the conditions are observed by The Designer.</li>
                  <li>MODSVAR is an online platform (hereinafter referred to as "Communication Service") and acts solely as an intermediary between Designers - with a variety of assorted clothing, furniture, accessories, interior, etc. - and the customer. The products specified on the Communication Service are not products which MODSVAR have produced or requested to be produced, and MODSVAR is therefore not the designer or supplier of the products. Only the individual designers can be referred to as such.</li>
                  <li>When a designer has created an offer on the Communication Service, the product can be offered for a period of 7 or 14 days unless it is possible to choose another offer period. The offer period automatically ends when all 10 products are sold or when the offer period ends.</li>
                  <li>The Designer guarantees that any information about the product is correct. The Designer also guarantees that the products are in compliance with Danish legislation, as well as The Designer guarantees that its profile information is correct at any time.</li>
                  <li>By accepting MODSVAR’s seller terms, The Designer gives MODSVAR full permission and access to activate and re-activate product campaigns on The Designer’s behalf as a part of having PR and marketing tasks done by MODSVAR without any costs. cf. section 1.2.</li>
                </ol>
              </li>
              <li><strong>Discounts and fees</strong>
                <ol>
                  <li>The customer can obtain discounts on the products in connection with the time of the established price, and the discount depends on how many people wanting to buy the product when the offer expires. This discount is based on the following principles:
                    <ol>
                      <li>1 product sold is granted a discount of 15 % compared to the offer price.</li>
                      <li>Hereinafter there is a continuous percentage based on order quantity on 2,22%, every time a product is sold.</li>
                      <li>10 products sold are granted a discount of 35 % compared to the offer.</li>
                    </ol>
                  </li>
                </ol>
              </li>
              <li><strong>Terms of payment and pricing</strong>
                <ol>
                  <li>The customer's payment for the products is made directly to The Designer via the platform’s preferred payment system. To make this possible, it is a requirement that The Designer establishes their own account with the payment provider, Stripe.
The Designer receives a payment equal to the offering price of products sold net of customer discounts and transaction costs to Stripe of 1.4% + DKK 1.8, cf. section. 2.1. MODSVAR’s commission is 7 % of the tender price of the product.
Please note that it is a technical condition that The Designer pays Stripe’s transaction costs out of the contract price minus the discount, including MODSVAR’s kommission (7% of the contract price).
</li>
                  <li>The Designer's payment goes directly to The Designer through the payment system. In the event of a technical error, settlement is made to The Designer within 7 business days after the offer expires, or in the form of  separate agreement between The Designer and MODSVAR.</li>
                  <li>In the event of one or more customers evoke the cancellation right, cf. section 6, The Designer is not entitled to any financial claim against MODSVAR.</li>
                  <li>There is no fee for approved designers involved in creating a profile on MODSVAR’s platform. The first three months are considered a trial period.</li>
                </ol>
              </li>
              <li><strong>Cancellation</strong>
                <ol>
                  <li>During the trial period The Designer may cancel its agreement in writing to MODSVAR no later than 7 days prior to the expiration of the trial period.</li>
                  <li>After 7 days before the trial ends, the agreement may be terminated in writing with three months' notice to the end of a month.</li>
                </ol>
              </li>
              <li><strong>Delivery</strong>
                <ol>
                  <li>The Designer is obligated to ship the purchased products to the customer within 1-3 business days after the offer has expired, unless it is clearly stated that other terms apply.</li>
                  <li>All products are shipped through a recognised freight forwarder and are delivered to the address stated on the customer’s order, or through a recognised freight forwarder according to The Designers own terms.</li>
                  <li>The Designer is responsible for paying the shipping costs, unless other terms have been settled in the present order. If The Designer wishes to take out a transport insurance it is at the cost of The Designer.</li>
                  <li>Delivery is complete when the item is in the possession of the customer.</li>
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
              <li><strong>Limitation of liability</strong>
                <ol>
                  <li>The Designer is obligated to keep MODSVAR financially compensated in any dispute between the customer and The Designer.</li>
                </ol>
              </li>
              <li><strong>Default</strong>
                <ol>
                  <li>If The Designer does not uphold its obligations of this contract with the customer or with MODSVAR, then MODSVAR is entitled to terminate the agreement with The Designer.</li>
                  <li>Modsvar has full access to the Designers profile and his/hers campaigns. Modsvar reserves the right to interact with campaigns and to activate and deactivate campaigns, if necessary.</li>
                  <li>In the event of MODSVAR’s termination with The Designer due to negligence, MODSVAR is entitled to compensation in the amount of DKR 594.00. In addition, MODSVAR is entitled to remove all of The Designer’s current offers on the Communication Service and to delete The Designer’s profile.</li>
                  <li>MODSVAR is also entitled to compensation in the event of The Designer’s breach of contract.</li>
                </ol>
              </li>
              <li><strong>Law and Jurisdiction</strong>
                <ol>
                  <li>Any dispute under these terms and conditions must be settled by Danish law at the court in Aalborg.</li>
                </ol>
              </li>
            </ol>
          </div>
      </div>


  </div>
</article>
@endsection
