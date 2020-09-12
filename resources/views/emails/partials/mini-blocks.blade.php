<tr>
  <td class="w320">
    <table cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td class="mini-container-left">
          <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td class="mini-block-padding">
                <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
                  <tr>
                    <td class="mini-block">
                      <span class="header-sm">Shipping address</span><br />
                      {{$customer_name}} <br />
                      {{$customer_address}} <br />
                      {{$customer_city}} <br />
                      {{$customer_country}}
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td class="mini-container-right">
          <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td class="mini-block-padding">
                  <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
                      <tr>
                          <td class="mini-block">
                              <span class="header-sm">Order info</span><br/><br/>
                              <span style="color: #4d4d4d; font-weight:bold;">Order date</span> {{$order_date}}<br/>
                              <span style="color: #4d4d4d; font-weight:bold;">End date</span> {{$end_date}}<br/>
                              <span style="color: #4d4d4d; font-weight:bold;">Order nr.:</span> {{$id}}<br />
                          </td>
                      </tr>
                  </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </td>
</tr>
