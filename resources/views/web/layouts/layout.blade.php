<!DOCTYPE html>
<html>

<head>
  <title>Ecommerce Dynamic Web Template</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
  <meta http-equiv="Content-Language" content="en-US" />
  <meta name="description" content="Dynamic responsive Ecommerce free web template" />
  <meta name="keywords" content="Ecommerce template, Ecommerce free responsive template, free template" />
  <meta name="author" content="Maniruzzaman Akash">

  <!-- CSS links -->
  <link type="text/css" rel="stylesheet" href=" {{ asset('web/css/bootstrap.min.css') }} " />



  <link type="text/css" rel="stylesheet" href=" {{ asset('web/css/font-awesome.min.css') }}" />


  <!-- Animate.css -->
  <link type="text/css" rel="stylesheet" href=" {{ asset('web/css/animate.css') }} " />

  <!-- Owl Carousel CSS-->
  <link type="text/css" rel="stylesheet" href=" {{ asset('web/css/owl.carousel.min.css') }} " />
  <link type="text/css" rel="stylesheet" href=" {{ asset('web/css/owl.theme.default.min.css') }} " />



  <!-- Mega navigation bar -->
  <link rel="stylesheet" type="text/css" media="all" href=" {{ asset('web/css/webslidemenu.css') }} " />

  <!-- Main css link -->
  <link type="text/css" rel="stylesheet" href=" {{ asset('web/css/main.css') }} " />
  <link rel="icon" href=" {{ asset('web/images/logo.png') }} " />

  @yield('css')

</head>

<body>
  <div class="wrapper">
    <!-- Header part  -->
    <div class="header" id="top">

      <!-- Start Top Header -->

      <x-header-top></x-header-top>

      <!-- End Top Header -->


      <!-- Start Header Main, logo, search bar,cart -->

      <x-header-bottom></x-header-bottom>

      <!-- End Header Main, logo, search bar,cart -->

      <div class="container" style="padding: 0" id="hide">
        <div class="row">
          <div class="col">
            @if (session('checkout'))

              <div class="alert alert-success" role="alert" style="padding: 3px 20px">
                {{ session('checkout') }}
              </div>

              @endif

          </div>
        </div>
      </div>

      {{-- Start Header Nav --}}

      <x-header-nav></x-header-nav>

      {{-- End Header Nav --}}


    </div>
    <!-- Header part  -->


    @yield('main')




    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="footer-top-address wow slideInLeft" data-wow-duration="1s" data-wow-delay="0s"
              data-wow-offset="10">
              <div class="header-logo" style=" text-align: center;border-bottom: 1px dotted rgba(247, 12, 38, 0.24);">
                <a href="index.html">
                  <img src=" {{ asset('web/images/logo.png') }} " alt="Your Shop Logo" class="img img-responsive"
                    style="max-width: 100px">
                </a>
              </div>
              <div class="clearfix"></div>
              <ul>
                <li><i class="fa fa-map-marker"></i> Egypt, Cairo, Shubra
                </li>
                <li><i class="fa fa-mobile"></i> +201123376466 </li>
                <li><i class="fa fa-phone"></i> +224300591 </li>
                <li><i class="fa fa-envelope-o"></i>
                    <a href="mailto:a2s.medo@gmail.com" style="color: #000000">
                    a2s.medo@gmail.com</a></li>
              </ul>
            </div>


          </div>
          <div class="col-md-8">
            <div class="subscribe wow slideInRight" data-wow-duration="1s" data-wow-delay="0s" data-wow-offset="10">
              <h3>Subscribe here to get some exciting offers</h3>
              <form action="#" method="post">
                <input type="text" name="email" placeholder="Enter your Email..." required="">
                <input type="submit" value="Subscribe">
              </form>
            </div>
            <div class="all-footer-links">
              <div class="col-md-4">
                <h3>Company</h3>
                <ul>
                  <li><a href="about.html">About Us</a></li>
                  <li><a href="contact.html">Contact Us</a></li>
                  <li><a href="privacy.html">Privacy Policy</a></li>
                </ul>
              </div>
              <div class="col-md-4 footer-grids">
                <h3>Services</h3>
                <ul>
                  <li><a href="contact.html">Contact Us</a></li>
                  <li><a href="login.html">Returns</a></li>
                  <li><a href="faq.html" class="link">FAQ</a></li>
                  <li><a href="#">Site Map</a></li>
                  <li><a href="login.html">Order Status</a></li>
                </ul>
              </div>
              <div class="col-md-4 footer-grids">
                <h3>Payment Methods</h3>
                <ul>
                  <li><i class="fa fa-paypal" aria-hidden="true"></i> Paypal</li>
                  <li><i class="fa fa-money" aria-hidden="true"></i> Bkash</li>
                  <li><i class="fa fa-pie-chart" aria-hidden="true"></i>EMI Conversion</li>
                  <li><i class="fa fa-gift" aria-hidden="true"></i> E-Gift Voucher</li>
                  <li><i class="fa fa-credit-card" aria-hidden="true"></i> Debit/Credit Card</li>
                </ul>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="payment-links">
              <ul>
                <li><i class="fa fa-cc-paypal" style="color: #FFCC80"></i></li>
                <li><i class="fa fa-cc-mastercard" style="color: #FFEB3B"></i></li>
                <li><i class="fa fa-cc-stripe" style="color: yellow"></i></li>
                <li><i class="fa fa-credit-card" style="color: #FF9800"></i></li>
              </ul>
            </div>
          </div>
        </div>



      </div>
    </div> <!-- End Footer top -->

    <div class="footer-bottom">
      <p class="footer-credit">
        &copy;<script type="text/javascript">
          document.write(new Date().getFullYear())

        </script> - All rights reserved <a href="index.html">Your shop</a> | Designed by <a
          href="https://maniruzzaman-akash.blogspot.com"> Maniruzzaman Akash </a> | Developing by <a href="https://a2smedo.github.io/my-portfolio/"> Ahmed Salah</a>
      </p>
    </div>
    <!--End Footer bottom -->

    <div class="scroll">
      <a href="#top" class="scroll-to-top hidden">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

  </div> <!-- End wrapper -->



  <!-- Scripts -->
  <script type="text/javascript" src=" {{ asset('web/js/jquery.min.js') }} "></script>
  <script type="text/javascript" src=" {{ asset('web/js/owl.carousel.min.js') }} "></script>
  <script src=" {{ asset('web/js/wow.min.js') }} "></script>
  <script type="text/javascript" src="{{ asset('web/js/bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('web/js/webslidemenu.js') }}"></script>
  <script type="text/javascript" src="{{ asset('web/js/main.js') }}"></script>

  <script type="text/javascript">
    jQuery(document).ready(function() {

      $('#add').click(function() {
        // e.preventDefault();

        $('#submit').submit()

      });

      setInterval(function() {
        $('#hide').hide();
      }, 5000);
    });

  </script>
  @yield('scripts')
</body>

</html>
