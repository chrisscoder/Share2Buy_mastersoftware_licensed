
@extends('layouts.app')

@section('meta_title', 'Share Interior and Fashion Products Online and Support Designers' )
@section('meta_description', 'Your online marketplace with the best interior design, furniture, accessories and sustainable fashion. Buy directly from designers' )

@section('content')
<article class="page">
  <section class="space-l-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-lg-6 col-lg-offset-3">
              <h1>Modsvar Design Market</h1>
              <div class="row">
                <div class="col-sm-12 hyphens">
                  <p>Meet us at the Danish design fair, <a href="http://xn--forrsmessen-z8a.dk">Forårsmessen</a>, at Aalborg Kongres og Kultur Center the 31st of March to the 2th of April 2017. Bring your friends, colleagues or your beloved one and get inspired by the new trends in interior design and sustainable fashion.</p>
                  <p>Along with 20 talented and emerging designers from the fields of interior design and sustainable fashion, Modsvar will join at the big stage in Aalborg Hallen (Hall B).</p>
                  <p>Join <a href="https://www.facebook.com/events/207733586375161/">Modsvar Design Market on Facebook</a> and get updates about the event.</p>
                </div>
              </div>
            </div>
        </div>
    </div>
  </section>
  <div class="space-l">
    <div class="container">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-lg-8 col-lg-offset-2">
          <h2 class="padding-bottom">Meet our exhibitors</h2>
        </div>
      </div>
      <div class="row flex-row-sm">
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/amov/amov-apparel-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/amov/amov-apparel-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/amov/amov-apparel-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/amov/amov-apparel-modsvar-design-market-w1300.jpg 2x" alt="Amov Apparel – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3>AMOV</h3>
              <h4>Sustainable Fashion</h4>
              <p class="space-xs-top hyphens">AMOV Apparel was founded in 2015. AMOV aims to become a pioneer of change in the fashion industry. AMOV combines organic, responsible and sustainable materials, a new recycling system and ambitious 'giving back' principles in a unique concept.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/bella-bella/bellabelladenmark1-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/bella-bella/bellabelladenmark1-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/bella-bella/bellabelladenmark1-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/bella-bella/bellabelladenmark1-modsvar-design-market-w1300.jpg 2x" alt="">
            <figcaption>
              <h3>Bella Bella Denmark</h3>
              <h4>Simple Nordic Jewelry </h4>
              <p class="space-xs-top hyphens">Bella Bella Denmark was established in 2014 by jewelry designer Bella Laurina. She loves what we does, and her mission with Bella Bella is to design and make jewelry that reflects the brands passion and values.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/bwf/better-world-fashion-mosvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/bwf/better-world-fashion-mosvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/bwf/better-world-fashion-mosvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/bwf/better-world-fashion-mosvar-design-market-w1300.jpg 2x" alt="">
            <figcaption>
              <h3><a href="{{action('DesignerController@show','better-world-fashion')}}">Better World Fashion</a></h3>
              <h4>Sustainable Leather Jackets</h4>
              <p class="space-xs-top hyphens">The three founders of Better World Fashion, Kresten Thomsen, Karsten Moos Lund and Reimer Ivang collect used leather jackets as they cut up, get cleaned and sewn into new trendy jackets for both men and women. The leather comes from recycled leather.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/brainchild-original/brainchild-original-graphic-design-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/brainchild-original/brainchild-original-graphic-design-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/brainchild-original/brainchild-original-graphic-design-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/brainchild-original/brainchild-original-graphic-design-modsvar-design-market-w1300.jpg 2x" alt="Brainchild Original – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3><a href="{{action('DesignerController@show','brainchild-original')}}">Brainchild Original</a></h3>
              <h4>Graphic Design</h4>
              <p class="space-xs-top hyphens">Brainchild original is Danish design taken back to the original. Brainchild Original interpret Danish design for its inspiration and takes it back to the original.</p>
            </figcaption>
          </figure>
        </div>
      </div>
    </div>
  </div>
  <section class="space-l white">
    <div class="container relative">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center signup-cta">
          <h2>Get free tickets!</h2>
          <p class="text-uppercase space">Just send us an email at <a href="mailto:info@modsvar.com">info@modsvar.com</a> and we'll make sure, that you will receive free tickets to Modsvar Design Market at the Danish design fair, Forårsmessen.</p>
        </div>
      </div>
    </div>
  </section>
  <div class="space-l">
    <div class="container">
      <div class="row flex-row-sm">
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/bycdesign/by-c-design-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/bycdesign/by-c-design-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/bycdesign/by-c-design-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/bycdesign/by-c-design-modsvar-design-market-w1300.jpg 2x" alt="ByCdesign, Minimalistic Posters – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3><a href="{{action('DesignerController@show','cdesigns')}}">ByCdesign</a></h3>
              <h4>Minimalistic Posters</h4>
              <p class="space-xs-top hyphens">The designer behind Bycdesign Carsten Nielsen loves working with geometric / organic forms. He expresses himself in a modern wsay and you will find the minimalistic modern times is in his artwork.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/compact-living/compact-living-multifunctional-furniture-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/compact-living/compact-living-multifunctional-furniture-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/compact-living/compact-living-multifunctional-furniture-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/compact-living/compact-living-multifunctional-furniture-modsvar-design-market-w1300.jpg 2x" alt="Compact Living, Multifunctional Furniture – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3>Compact Living</a></h3>
              <h4>Multifunctional Furniture</h4>
              <p class="space-xs-top hyphens">Compact Living is a new Danish furniture brand which produce multifunctional furniture of high quality with a focus on aesthetics and sustainability.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/draw-doodles-study/draw-doodles-study-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/draw-doodles-study/draw-doodles-study-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/draw-doodles-study/draw-doodles-study-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/draw-doodles-study/draw-doodles-study-modsvar-design-market-w1300.jpg 2x" alt="Draw Doodles Study, Printed Drawings – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3>Draw Doodles Study</h3>
              <h4>Printed Drawings</h4>
              <p class="space-xs-top hyphens">All the drawings from Draw Doodles Study are filled with history and affection - which evokes an immediate recognition and delight in all of us. The designs are simple and often leads the mind into play, love and life's many facets.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/enough/enough-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/enough/enough-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/enough/enough-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/enough/enough-modsvar-design-market-w1300.jpg 2x" alt="Enough, Unique Handmade Jewelry – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3>Enough</h3>
              <h4>Unique Handmade Jewelry</h4>
              <p class="space-xs-top hyphens">Enough is a universe of unique handmade jewelry made of sterling silver, 18k goldplated silver, with precious and semiprecious stones.  The collections are made in India, and our mission is to create something unique by having small family businesses participating in the production for our universe.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/harboart/harboart-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/harboart/harboart-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/harboart/harboart-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/harboart/harboart-modsvar-design-market-w1300.jpg 2x" alt="Harbo Art, Abstract Posters and Paintings – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3>Harbo Art</h3>
              <h4>Abstract Posters and Paintings</h4>
              <p class="space-xs-top hyphens">Harboart designs abstract posters and paintings. The posters are painted with ink. Copies and originals comes in sizes; A3, 50x70 and 70x100 sold. The paintings are available in several sizes including 120x90 cm.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/kirstine-falk/kirstine-falk-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/kirstine-falk/kirstine-falk-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/kirstine-falk/kirstine-falk-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/kirstine-falk/kirstine-falk-modsvar-design-market-w1300.jpg 2x" alt="Kirstine Falk Johansen, Handmade Illustrations – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3>Kirstine Falk Johansen</h3>
              <h4>Handmade Illustrations</h4>
              <p class="space-xs-top hyphens">Kirstine Falk is the designer and founder. She specializes in illustrations that combine pencil lines with watercolor and collage techniques. Her universe is both magical, dreamlike and slightly surreal. A slight melancholy is to track in some of the pictures, which breaks with the sweetness and gives the image depth in their stories.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/lausten/lausten-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/lausten/lausten-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/lausten/lausten-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/lausten/lausten-modsvar-design-market-w1300.jpg 2x" alt="Lausten, Jewelry Design – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3>Lausten</h3>
              <h4>Jewelry Design</h4>
              <p class="space-xs-top hyphens">Jeweler Dorte Lausten works with the graphic and mechanical expression in her jewelry design. In these designs her focus is working with the interplay between the dark oxidized and glossy surfaces.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/linevis/linevis-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/linevis/linevis-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/linevis/linevis-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/linevis/linevis-modsvar-design-market-w1300.jpg 2x" alt="Linevis, Illustrated Posters – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3>Linevis</h3>
              <h4>Illustrated Posters</h4>
              <p class="space-xs-top hyphens">Visually Linevis poster design have an aesthetic and natural expression, and a humorous dimension occurs in the contrast between the serious visual element and the everyday words and phrases we use without thinking more of the importance of the compound word.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/made-by-toft/made-by-toft-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/made-by-toft/made-by-toft-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/made-by-toft/made-by-toft-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/made-by-toft/made-by-toft-modsvar-design-market-w1300.jpg 2x" alt="Made by Toft, Furniture Design – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3>Made by Toft</h3>
              <h4>Furniture Design</h4>
              <p class="space-xs-top hyphens">Niels Toft is an industrial designer from the School of Architecture in Aarhus. He is the lead  driver of the design studio Niels Toft Design. Characteristic of the products is a good idea combined with the simple and functional design.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/nabamu/nabamu-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/nabamu/nabamu-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/nabamu/nabamu-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/nabamu/nabamu-modsvar-design-market-w1300.jpg 2x" alt="Nabamu Design, Handmade Leather Products – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3>Nabamu Design</h3>
              <h4>Handmade Leather Products</h4>
              <p class="space-xs-top hyphens">Nanna Bach Munkholm is the founder and designer at Nabamu Design. Her focus is to create unique and handmade products for everyday use. Nabamu produces handbags, purses and other leather accessories.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/noegtern/noegtern-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/noegtern/noegtern-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/noegtern/noegtern-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/noegtern/noegtern-modsvar-design-market-w1300.jpg 2x" alt="Nøgtern, Scandinavian Jewelry – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3><a href="{{action('DesignerController@show','nogtern')}}">Nøgtern</a></h3>
              <h4>Scandinavian Jewelry</h4>
              <p class="space-xs-top hyphens">Nøgtern creates design that combines Scandinavian simplicity with interesting materials and combinations. The jewelry is designed and made by Danish architect Sarah Fredlund Nielsen.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/nordah/nordah-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/nordah/nordah-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/nordah/nordah-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/nordah/nordah-modsvar-design-market-w1300.jpg 2x" alt="Nordah, Multifunctional Furniture – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3><a href="{{action('DesignerController@show','nordah')}}">Nordah</a></h3>
              <h4>Multifunctional Furniture</h4>
              <p class="space-xs-top hyphens">Jordan Jensen and Aksel Hammershoej are the designers behind the lifestyle brand, Nordah. Nordah unites design and functionality in a simple and classic expression. This is reflected in Nordahs first furniture, AH1.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/solon-handmade/solon-handmade-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/solon-handmade/solon-handmade-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/solon-handmade/solon-handmade-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/solon-handmade/solon-handmade-modsvar-design-market-w1300.jpg 2x" alt="Solon Handmade, Handmade Leather Bags – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3>Solon Handmade</h3>
              <h4>Handmade Leather Bags</h4>
              <p class="space-xs-top hyphens">Solon Handmade was founded by craftswoman Maria Solon. All bags are designed and handmade by Maria Solon, who has worked with leather for more than 10 years. Solon Handmade creates timeless designs that goes against the buy-throw-away culture.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/traevaerk/traevaerk-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/traevaerk/traevaerk-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/traevaerk/traevaerk-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/traevaerk/traevaerk-modsvar-design-market-w1300.jpg 2x" alt="Traewerk, Designer Lamps – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3><a href="{{action('DesignerController@show', 'traewerk')}}">Traewerk</a></h3>
              <h4>Designer Lamps</h4>
              <p class="space-xs-top hyphens">TraeWerk is a modern design company based in Aarhus. The lamps No. 109 and No. 145 marked the beginning of their design success. The name Traewerk is Danish and describes how they have a preference for wood as the primary material.</p>
            </figcaption>
          </figure>
        </div>
        <div class="col-sm-6 col-lg-3 fig-space">
          <figure class="fig-quote">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source media="(max-width: 480px)" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/unikaposters/unikaposters-modsvar-design-market-w360.jpg 360w, {{url('/')}}/images/design-markets/forarsmessen2017/unikaposters/unikaposters-modsvar-design-market-w650.jpg 650w">
            <!--[if IE 9]></video><![endif]-->
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAADs=" sizes="100vw" srcset="{{url('/')}}/images/design-markets/forarsmessen2017/unikaposters/unikaposters-modsvar-design-market-w650.jpg 1x, {{url('/')}}/images/design-markets/forarsmessen2017/unikaposters/unikaposters-modsvar-design-market-w1300.jpg 2x" alt="Unikaposters, Posters and Photography – Modsvar Design Market, Forårsmessen 2017">
            <figcaption>
              <h3><a href="{{action('DesignerController@show','unikaposters')}}">Unikaposters</a></h3>
              <h4>Posters and Photography</h4>
              <p class="space-xs-top hyphens">Unikaposters make beautiful photography and graphic design. The posters are with tenacity and passion designed by Christian & Charlotte and reflects a whole-hearted attempt to create unique, stylish and beautiful motifs.</p>
            </figcaption>
          </figure>
        </div>
      </div>
    </div>
  </div>
</article>
@endsection
