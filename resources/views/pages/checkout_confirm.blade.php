
@extends('layouts.app')

@section('content')
<section class="space-m-top space-m-bottom">

  <div class="container">

    <div class="row">

      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading">Produkt </div>

              <div class="panel-body">
                <table class="table">
                    <thead>
                      <tr>

                      </tr>
                        <th>Antal</th>
                        <th>Produkt</th>
                        <th>Pris</th>
                        <th>I alt</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{ Session::get('quantity') }} stk</td>
                        <td>{{ $product->title}}</td>
                        <td>{{ Session::get('price') }} DKK</td>
                        <td class="right">{{ $price }} DKK  </td>
                      </tr>
                    </tbody>
                </table>

              </div>
          </div>



          <div class="panel panel-default">
            <div class="panel-heading">Betal</div>
            <div class="panel-body">
              <form action="/checkout/order/create" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_CCE2BBKxmfl1nhM2BqjGyTIP"
                data-label="Reserver beløb"
                data-name="Modsvar"
                data-description="{{ Session::get('quantity') }} stk {{ $product->title}}"
                data-amount="{{$price*100}}"
                data-currency="DKK"
                data-locale="auto"
                data-allow-remember-me="false"
                data-email="{{ $ordre->email }}"
                data-image="https://scontent.cdninstagram.com/hphotos-xfp1/t51.2885-15/s320x320/e35/12446141_1542950119352690_752075706_n.jpg"
                >
              </script>
              </form>
            </div>
          </div>


        </div>
      </div>

</section>

@endsection
