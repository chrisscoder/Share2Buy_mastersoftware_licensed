@extends('emails.partials.master')

@section('mail_title', 'Your receipt')

@section('content')
<tr>
    <td align="center" valign="top" width="100%" style="background-color: #f4f4f4;" class="content-padding">
        <center>
            <table cellspacing="0" cellpadding="0" width="600" class="w320">
                <tr>
                    <td class="header-lg">
                        Your receipt
                    </td>
                </tr>
                <tr>
                    <td class="free-text">
                        Thank you for your purchase. Come back soon!
                        <br/><br/>
                        <span class="header-sm">Seller information</span><br/>
                        {{$designer}} <br/>
                        {{$designer_mail}} <br/>
                        {{$designer_vat_id ? 'VAT ID: '.$designer_vat_id : ''}}<br/><br/>

                        <i>For any inquiries concerning returns or complaints, please contact seller</i>
                        <br/><br/><br/>
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
                                                <span class="total-space">Price</span>
                                            </td>
                                            <td style="text-align: right;">
                                              <span class="total-space">{{$order_quantity}}</span><br/>
                                              <span class="total-space">{{ $order_price }}</span>
                                            </td>
                                        </tr>

                                        <tr style="border-top: 1px solid #cccccc;">
                                            <td style="text-align: left;">
                                                <span class="total-space">Subtotal</span>
                                                <br/>
                                                <span class="total-space">Vat (25%)</span>
                                            </td>
                                            <td style="text-align: right;">
                                                <span class="total-space">{{ $order_subtotal }}</span>
                                                <br/>
                                                <span class="total-space">{{ $order_subtotal_vat }}</span>
                                            </td>
                                        </tr>
                                        <tr style="border-top: 1px solid #cccccc;">
                                            <td style="text-align: left;">
                                                <span class="total-space">Commission</span>
                                                <br/>
                                                <span class="total-space">Vat (25%)</span>
                                            </td>
                                            <td style="text-align: right;">
                                                <span class="total-space">{{ $order_commision }}</span>
                                                <br/>
                                                <span class="total-space">{{ $order_commision_vat }}</span>
                                            </td>
                                        </tr>
                                        <tr style="border-top: 1px solid #cccccc;">
                                            <td style="text-align: left;">
                                                <span class="total-space" style="font-weight: bold; color: #4d4d4d">Total</span>
                                            </td>
                                            <td style="text-align: right;">
                                                <span class="total-space" style="font-weight:bold; color: #4d4d4d">{{ $order_total }}</span>
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
