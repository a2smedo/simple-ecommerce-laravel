<div class="header-bottom">
  <div class="container">
    <div class="header-logo pull-left">
      <a href="{{ url('/') }}">
        <img src="{{ asset('web/images/logo.png') }}" alt="Your Shop Logo" class="img img-responsive">
      </a>
    </div>

    <div class="header-search pull-left">
      <form action="{{ url('/search') }}" method="get">
        <input type="search" name="search" placeholder="{{ __('main.searchProduct') }}">
        <button type="submit" class="btn btn-default" aria-label="Left Align">
          <i class="fa fa-search" aria-hidden="true"> </i>
        </button>
      </form>
    </div>

    <div class="header-cart">
      <a href="" class="cart-link" data-toggle="modal" data-target="#cart-item"><i
          class="fa fa-cart-arrow-down"></i></a>

      @if (Auth::user())
        <span class="number-of-cart">
          {{ count($carts) }}
        </span>
      @else
        <span class="number-of-cart">
          0
        </span>

      @endif
    </div>

    <!-- Cart Modal -->
    <div id="cart-item" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;
            </button>
            <h4 class="modal-title">{{ __('main.cartCar') }} </h4>
          </div>

          @if (Auth::user() && ! $carts->isEmpty() )

            <div class="modal-body">
              <table class="table table-responsive">
                <thead>
                  <tr>

                    <th> {{ __('main.itemName') }} </th>
                    <th> {{ __('main.itemimg') }} </th>
                    <th> {{ __('main.qty') }} </th>
                    <th> {{ __('main.price') }} </th>

                  </tr>
                </thead>
                <tbody>

                  @foreach ($carts as $cart)
                    <tr>
                      <td>
                        {{ $cart->name() }}
                      </td>
                      <td><img src=" {{ asset('uploads/' . $cart->img) }} " class="img img-responsive img-thumbnail"
                          alt=""></td>
                      <td> {{ $cart->quantity }} </td>
                      <td> {{ $cart->price }}$ </td>
                    </tr>


                  @endforeach
                  <tr>
                    <td colspan="5" rowspan="5">
                      <span class="pull-left"> {{ __('main.totalPrice') }} :</span>
                      <span class="bold text-primary pull-right">
                        {{ $totalPrice }}$
                      </span>
                    </td>
                  </tr>
                  <div class="clearfix"></div>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                {{ __('main.cancel') }}
              </button>
              <a href="{{ url('/cart') }}" class="btn btn-yellow"> {{ __('main.checkout') }} </a>
            </div>
          @else
            <p>
              {{ __('main.not-found') }}
            </p>
          @endif


        </div>

      </div>
    </div> <!-- End Model -->

  </div>
</div>
