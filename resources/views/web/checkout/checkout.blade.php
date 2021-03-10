@extends('web.layouts.layout')
@section('title')

@endsection
@section('main')

  <div class="content-area">
    <div class="container">
      <div class="checkout-page">
        <h2>{{__('main.checkout-process')}} </h2>
        <div class="checkout-top-ok">
          <span id="check-one-top">1</span><span class="check-dots">.....</span>
          <span id="check-two-top">2</span>
          {{-- <span class="check-dots">.....</span> --}}
          {{-- <span id="check-three-top">3</span> --}}
        </div>
        <form action=" {{url('/checkout/store')}} " method="POST" class="form-horizontal" role="form" id="checkoutForm">

            @csrf

              {{-- <input type="hidden" name="products[{{$product->id}}]"> --}}

          <div id="check1">
            <h3>{{__('main.info')}} </h3>
            <div class="form-group">
              <label class="control-label col-sm-2" for="checkoutEmail">{{__('main.email')}}: *</label>
              <div class="col-sm-10">
                <input type="email" class="form-control inputs" id="checkoutEmail" placeholder="Enter email" name="user_email"  value="{{ $user->email }}" />
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-sm-2" for="checkoutContact">{{__('main.phone')}}: *</label>
              <div class="col-sm-10">
                <input type="text" class="form-control inputs" id="checkoutContact"
                  placeholder="01951233084 or +8801951233084" name="user_phone" value="{{$user->phone}}"  />


                <span class="input-hint">{{__('main.must-phone')}} </span>
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-2">
                <input type="button" class="btn btn-info pull-right  margin-top-20 checkbtn1" name="submit_check1"
                  value="{{__('main.next')}}" />
                <div class="clearfix"></div>
              </div>
            </div>
          </div> <!-- End check1 -->



          <div id="check2" class="hidden">

            <h3>{{__('main.address-info')}} </h3>

            <div class="form-group">
              <label class="control-label col-sm-2" for="contry">{{__('main.country')}}</label>
              <div class="col-sm-10">
                <input type="text" name="user_country"  class="form-control inputs" id="contry" value="{{$user->country}}"
                  placeholder="Enter Your Country"  />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="city">{{__('main.city')}}</label>
              <div class="col-sm-10">
                <input type="text" name="user_city"  class="form-control inputs" id="city" value="{{$user->city}}"
                  placeholder="Enter Your City"  />
              </div>
            </div>



            <div class="form-group">
              <label class="control-label col-sm-2" for="shipping_primary_address">
                {{__('main.address')}}: *</label>
              <div class="col-sm-10">

                <textarea name="user_address"  class="form-control" rows="2" placeholder="Enter Your Shipping Address"> {{$user->address}} </textarea>

              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-2">
                {{-- <input type="button" class="btn btn-info pull-right  margin-top-20 checkbtn2" name="submit_check2"
                  value="Next..." /> --}}

                  <input type="submit" class="btn btn-info pull-right  margin-top-20"
                  value="{{__('main.finish-order')}} " />


                <input type="button" class="btn btn-danger pull-right  margin-top-20 margin-right-20 backToCheck1"
                  name="backToCheck1" value="{{__('main.back')}} " />
                <div class="clearfix"></div>
              </div>
            </div>
          </div> <!-- End check2 -->


          {{-- <div id="check3" class="hidden">

            <h3>Payment Method Informations</h3>
            <div class="form-group">
              <label class="control-label col-sm-2" for="address_primary">Select Payment Option: *</label>
              <div class="col-sm-10">
                <select name="payments" id="payments" class="form-control inputs" required>
                  <option value="">Select A payment method</option>
                  <option value="payment_paypal">Paypal</option>
                  <option value="payment_stripe">Stripe</option>
                  <option value="payment_bkash">Bkash</option>
                </select>
                <div class="payment-div payment-div-paypal hidden">
                  <i class="fa fa-cc-paypal"></i> <br />
                  <a href="paypal.php?id=test" class="btn btn-lg btn-yellow">Payment Via Paypal Now</a>
                </div>
                <div class="payment-div payment-div-stripe hidden">
                  <i class="fa fa-cc-stripe"></i> <br />
                  <a href="stripe.php?id=test" class="btn btn-lg btn-yellow">Payment Via Stripe Now</a>
                </div>
                <div class="payment-div payment-div-bkash hidden">
                  <i>Bkash</i> <br />
                  <a href="bkash.php?id=test" class="btn btn-lg btn-yellow">Payment Via Bkash Now</a>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-2">
                <input type="submit" class="btn btn-info pull-right  margin-top-20" name="submit_check1"
                  value="Finish Order" />
                <div class="clearfix"></div>
              </div>
            </div>
          </div> <!-- End check3 --> --}}

        </form>
      </div>
      <!--End Checkout page -->
    </div> <!-- End Container -->


  </div> <!-- End content Area class -->

@endsection

@section('scripts')

  <script type="text/javascript">
    //Scripts for checkout functions one by one input fields.
    jQuery(document).ready(function() {



      $('.checkbtn1').click(function() {




        var email = $('#checkoutEmail').val();
        var contact = $('#checkoutContact').val();
        var pass_check1 = false;

        if (email == null || email == "" || ((
              /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i).test(email) ==
            false)) {
          pass_check1 = false;
          $('#checkoutEmail').focus();
          $('#checkoutEmail').addClass('error-input');
        } else {
          pass_check1 = true;
          $('#checkoutContact').focus();
          $('#checkoutEmail').removeClass('error-input');
          $('#checkoutEmail').addClass('success-input');

          //pattern for Bangladeshi phone number like +8801951233084 [Not complete]
          // var bd_phone_pattern = "/^(?:\+88|01)?(?:\d{11}|\d{13})$/";
          var bd_phone_pattern = /^(?:\+88|01)?\d{11}$/;

          if (contact == null || contact == "" || bd_phone_pattern.test(contact) != true) {
            pass_check1 = false;
            $('#checkoutContact').focus();
            $('#checkoutContact').addClass('error-input');
          } else {
            pass_check1 = true;
            $('#checkoutContact').removeClass('error-input');
            $('#checkoutContact').addClass('success-input');

          }
        }



        if (pass_check1 != false) {
          //Focus on next div's element and remove hidden class from it.

          // $('#check1').addClass('animated fadeOut');
          $('#check1').addClass('hidden');
          $('#check-one-top').html('<i class="fa fa-check"></i>');
          $('#check-one-top').css({
            "background-color": "#00BBB5"
          });
          $('#check-two-top').css({
            "background-color": "#004C48"
          });
          $('#check2').removeClass('hidden');
          $('#check2').show('slow');
          $('#shipping_name').focus();
        }

      });



      //Onclick Check button 2
      $('.checkbtn2').click(function() {
        var shipping_name = $('#shipping_name').val();
        var shipping_contact = $('#shipping_contact').val();
        var shipping_primary_address = $('#shipping_primary_address').val();
        var shipping_secondary_address = $('#shipping_secondary_address').val();
        var shipping_nearest_city = $('#shipping_nearest_city').val();
        var pass_check2 = false;
        if (shipping_name === null || shipping_name === "") {
          $('#shipping_name').focus();
          $('#shipping_name').addClass('error-input');
        } else {
          $('#shipping_name').addClass('success-input');
          if (shipping_contact === null || shipping_contact === "") {
            $('#shipping_name').focus();
            $('#shipping_name').addClass('error-input');
          } else {
            $('#shipping_contact').addClass('success-input');
            if (shipping_primary_address === null || shipping_primary_address === "") {
              $('#shipping_primary_address').focus();
              $('#shipping_primary_address').addClass('error-input');
            } else {

              $('#shipping_primary_address').addClass('success-input');
              $('#shipping_secondary_address').addClass('success-input');
              if (shipping_nearest_city === null || shipping_nearest_city === "") {
                $('#shipping_nearest_city').focus();
                $('#shipping_nearest_city').addClass('error-input');
              } else {
                pass_check2 = true;
              }
            }
          }
        }



        if (pass_check2 != false) {
          $('#check2').addClass('hidden');
          $('#check-two-top').html('<i class="fa fa-check"></i>');
          $('#check-two-top').css({
            "background-color": "#00BBB5"
          });
          $('#check-three-top').css({
            "background-color": "#004C48"
          });
          $('#check3').removeClass('hidden');
          $('#check3').show('slow');
          $('#payments').focus();
        }


      });


      $('.backToCheck1').click(function() {
        pass_check1 = false;
        $('#check1').removeClass('hidden');
        $('#check2').addClass('hidden');

        $('#check-one-top').html('1');
        $('#check-one-top').css({
          "background-color": "#004C48"
        });
        $('#check-two-top').css({
          "background-color": "#00BBB5"
        });
      });

      $('.backToCheck2').click(function() {
        pass_check2 = false;
        $('#check2').removeClass('hidden');
        $('#check3').addClass('hidden');

        $('#check-two-top').html('1');
        $('#check-two-top').css({
          "background-color": "#004C48"
        });
        $('#check-three-top').css({
          "background-color": "#00BBB5"
        });
      });


      // Onclick Payment select option payment list will apear

      $('#payments').change(function() {
        var payment_method = $('#payments').val();

        if (payment_method === "payment_paypal") {
          $('.payment-div-paypal').removeClass('hidden');
          $('.payment-div-paypal').addClass('animated slideInLeft');
          $('.payment-div-bkash').addClass('hidden');
          $('.payment-div-stripe').addClass('hidden');
        }
        if (payment_method === "payment_stripe") {
          $('.payment-div-stripe').removeClass('hidden');
          $('.payment-div-stripe').addClass('animated slideInUp');
          $('.payment-div-paypal').addClass('hidden');
          $('.payment-div-bkash').addClass('hidden');
        }
        if (payment_method === "payment_bkash") {
          $('.payment-div-bkash').removeClass('hidden');
          $('.payment-div-bkash').addClass('animated slideInRight');
          $('.payment-div-paypal').addClass('hidden');
          $('.payment-div-stripe').addClass('hidden');
        }

      });


    });

  </script>


@endsection
