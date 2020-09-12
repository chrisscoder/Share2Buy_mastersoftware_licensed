@extends('emails.partials.master')

@section('mail_title', 'Order confirmation')

@section('content')
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f4f4f4;" class="content-padding">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td class="header-lg">
              Thank you for your order!
            </td>
          </tr>
          <tr>
            <td class="free-text">
              We will send you an email with your receipt as soon as {{$designer}} has processed your order.
              {{$designer}} will ship your products 1-3 business days after the campaign ends.
              <br /><br />
              <span class="header-sm">Save even more!</span><br />
              Your current price is the absolute maximum price, and the price will only go down, when others join. The more products ordered during the campaign the better the price everyone gets!
              We call this Crowd Shopping!
              <br /><br />
              <div><!--[if mso]>
                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://www.facebook.com/sharer/sharer.php?u={{$product_url}}" style="height:45px;v-text-anchor:middle;width:155px;" arcsize="15%" strokecolor="#ffffff" fillcolor="#ffffff">
                  <w:anchorlock/>
                  <center style="color:#1a1a1a;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;">My Account</center>
                </v:roundrect>
              <![endif]--><a href="https://www.facebook.com/sharer/sharer.php?u={{$product_url}}"
              style="margin-top:20px;background-color:#ffffff;color:#1a1a1a;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:bold;text-transform:uppercase;line-height:45px;text-align:center;text-decoration:none;width:240px;-webkit-text-size-adjust:none;mso-hide:all;">Invite Crowd Shoppers <img width="20" height="20" src="{{ url('/').'/images/icons/social-facebook.png' }}" alt="facebook" style="vertical-align:text-bottom;" /></a></div>
              <br /><br /><br />
            </td>
          </tr>
          @include('emails.partials.mini-blocks')
        </table>
      </center>
    </td>
  </tr>
  <tr>
      <td align="center" valign="top" width="100%" style="background-color: #fcfcfc;">
          <center>
              <table cellpadding="0" cellspacing="0" width="600" class="w320">
                  <tr>
                      <td class="item-table">
                          <table cellspacing="0" cellpadding="0" width="100%">
                              <tr>
                                  <td class="mobile-hide-img" style="padding-right:15px;">
                                      <a href="{{$product_url}}"><img width="256" height="256" src="{{$product_image}}" alt="item1"></a>
                                  </td>
                                  <td class="item-col item">
                                      <table cellspacing="0" cellpadding="0" width="100%">
                                          <tr>
                                              <span class="header-sm">{{$product_title}}</span><br/>
                                              {{$designer}}<br/>
                                              @if (!empty($order_size))
                                                Size: {{$order_size}}
                                              @endif
                                              <br/><br/>
                                          </tr>
                                          <tr>
                                              <td style="text-align: left;">
                                                  <span class="total-space">Quantity</span><br/>
                                                  <span class="total-space">Order price</span>
                                              </td>
                                              <td style="text-align: right;">
                                                  <span class="total-space">{{$order_quantity}}</span><br/>
                                                  <span class="total-space">{{$order_price}}</span>
                                              </td>
                                          </tr>
                                          <tr style="border-top: 1px solid #cccccc;">
                                              <td style="text-align: left;">
                                                  <span class="total-space" style="font-weight: bold; color: #4d4d4d">Total</span>
                                              </td>
                                              <td style="text-align: right;">
                                                  <span class="total-space" style="font-weight:bold; color: #4d4d4d">{{$order_total}}</span>
                                              </td>
                                          </tr>
                                      </table>
                                  </td>
                              </tr>
                          </table>
                      </td>
                  </tr>
              </table>
          </center>
      </td>
  </tr>
@endsection

@section('footer_optional')
  @include('emails.partials.button')
@endsection
