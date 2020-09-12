
@extends('layouts.app')

@section('meta_title', 'Cookies and Privacy Policy' )

@section('content')
<article class="page space-l">
  <div class="container">
      <div class="row">
          <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-xl-6 col-xl-offset-3">
            <h1>Cookies and Privacy Policy</h1>

            <h3>Company information</h3>

            <p>
              {{ config('constants.company.name') }}
              {{ config('constants.company.type') }}<br>
              {{ config('constants.company.address') }}<br>
              {{ config('constants.company.zip') }} {{ config('constants.company.city') }}<br>
              {{ config('constants.company.country') }}<br>
              VAT ID: {{ config('constants.company.vat_id') }}<br><br>
              <a href="mailto:{{ config('constants.company_mail.support') }}">{{ config('constants.company_mail.support') }}</a>
            </p>

            <h3>Cookies</h3>
            <p>Policy Last updated: Norvember 10th, 2017.<br>
            Modsvar IVS uses cookies on <a href="https://modsvar.com">modsvar.com</a> (the "Service"). By using the Service, you consent to the use of cookies. Our Cookies Policy explains what cookies are, how we use cookies, how third­parties we may partner with may use cookies on the Service, your choices regarding cookies and further information about cookies.</p>

            <h3>What are cookies?</h3>
            <p>Cookies are small pieces of text sent by your web browser by a website you visit. A cookie file is stored in your web browser and allows the Service or a third­party to recognize you and make your next visit easier and the Service more useful to you. Cookies can be "persistent" or "session" cookies.</p>

            <h3>Why do Modsvar use cookies?</h3>
            <p>Technical functionality so that we can remember your preferences, account and payment options.<br>
            Traffic Measurement and Statistics in order to optimize the content and design of the site.<br>
            Generate web statistics so we know how many people visit our site and to document this.</p>

            <h3>How does ​Modsvar ​use cookies?</h3>
            <p>When you use and access the Service, we may place a number of cookies files in your web browser. We use cookies for the following purposes:<br>
            to enable certain functions of the Service, to provide analytics, to store your preferences, to enable advertisements delivery, including behavioral advertising. We use both session and persistent cookies on the Service and we use different types of cookies to run the Service:</p>

            <h4>­Essential cookies</h4>
            <p>We may use essential cookies to authenticate users and prevent fraudulent use of user accounts.</p>

            <h4>Third­party cookies</h4>
            <p>In addition to our own cookies, we also use third­parties cookies to report usage statistics of the Service, deliver advertisements on and through the Service, and so on.<br>
            The site uses cookies from the following third parties:</p>
            <ul>
              <li>
                <strong>Hotjar (Analytics & Feedback)</strong><br>
                Hotjar uses a set of cookies to help determine if you have seen the Hotjar (Polls, Survey Invites, Recruiters) widgets previously. You can disable cookies from Hotjar here: <a href="https://www.hotjar.com/opt-out">Hotjar Opt-out</a>
              </li>
              <li>
                <strong>Google Analytics (traffic measurement)</strong><br>
                The website uses cookies from Google Analytics to measure site traffic. You can disable cookies from Google Analytics here: <a href="https://tools.google.com/dlpage/gaoptout">Google Analytics Opt-out</a>
              </li>
            </ul>

            <h3>What are my choices regarding cookies?</h3>
            <p>If you'd like to delete cookies or instruct your web browser to delete or refuse cookies, please visit the help pages of your web browser. Please note, however, that if you delete cookies or refuse to accept them, you might not be able to use all of the features we offer, you may not be able to store your preferences, and some of our pages might not display properly. </p>

            <h3>Personal information</h3>
            <p>Personal information is never disclosed to third parties unless you expressly consent and we do not collect personal data without you have given us this information at registration, purchase, or participating in a survey, etc. You give your personal information at your own risk. Personal information is used to complete the purchase or service for which the information collected is connected with.<br>
            To the extent that process personal information about you, you are under the Personal Data Protection Act in the right to obtain information on which personal data can be attributed to you. If it turns out that the information or data processed about you is incorrect or misleading, you are entitled to claim these corrected, deleted or blocked. You can always object to the information about you amenable to treatment. You can also at any time revoke your consent. You have the opportunity to complain about the treatment of information and data relating to you. Complaints submitted to the Data Protection Agency, cf.. Privacy Act § 58 paragraph 1 (Danish law).</p>

            <h3>Where can I find more information about cookies?</h3>
            <p>You can learn more about cookies and the following third­party websites:
            <ul>
              <li><a href="http://www.allaboutcookies.org/">AllAboutCookies</a></li>
              <li><a href="http://www.networkadvertising.org/">Network Advertising Initiative</a></li>
            </ul>
            </p>
          </div>
      </div>


  </div>
</article>
@endsection
