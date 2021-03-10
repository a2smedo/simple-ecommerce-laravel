@extends('web.layouts.layout')
@section('title')

@endsection
@section('main')

  <div class="content-area">
    <div class="container">

      <div class="row">
        <div class="col-md">
          @if (session('updated'))
            <div class="alert alert-success" role="alert">
              {{ session('updated') }}
            </div>
          @endif
        </div>
      </div>
      <div class="cart-page">

        @if ($errors->any())
          <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $err)
              <p> {{ $err }} </p>
            @endforeach
          </div>

        @endif

        <h2>{{ __('main.cartCar') }} </h2>


        @if (!$carts->isEmpty())

          <table class="table">
            <thead>
              <tr>
                <th width="40%">{{ __('main.products') }} </th>
                <th width="20%">{{ __('main.qty') }}</th>
                <th width="15%">{{ __('main.price') }} </th>
                <th width="15%">{{ __('main.totalPrice') }}</th>
                <th width="10%">{{ __('main.action') }}</th>

              </tr>
            </thead>

            <tbody>

              @foreach ($carts as $cart)
                <tr id="tr">
                  <td>

                    <img src="{{ asset('uploads/' . $cart->img) }} " width="50" alt=""
                      class="img img-thumbnail pull-left">
                    <span class="pull-left cart-product-option">

                      <strong>

                        {{ $cart->name() }}
                      </strong>
                    </span>
                    <div class="clearfix"></div>
                  </td>

                  <td>
                    <form action="{{ url("cart/update/{$cart->id}") }}" method="post" id="updateForm">
                      @csrf
                      @method('put')

                      <div style="display: flex !important; justify-content: space-between">
                        <input type="number" min="1" name="quantity" value="{{ $cart->quantity }}" class="form-control"
                          id="quantity" />

                        <button type="submit" class="btn btn-info ">
                          <i class="fa fa-refresh"></i>
                        </button>
                      </div>

                    </form>

                  </td>

                  <td>
                    <span id="price">{{ $cart->price }}</span><span>$</span>
                  </td>


                  <td>
                    <p class="total_ammount_p1">
                      {{ $cart->price * $cart->quantity }}$
                    </p>
                  </td>

                  <td>
                    <a href="{{ url("/cart/remove/$cart->id") }}" style="margin-left: 30px !important;" type="submit"
                      class="btn btn-danger " id="bt">
                      <i class="fa fa-trash-o"></i>
                    </a>

                  </td>

                </tr>


              @endforeach

              <tr>
                <td colspan="2"></td>
                <td  ><strong>{{ __('main.total') }} :</strong></td>

                <td colspan="2">
                  <p>
                    <span class="total_product_sum">{{ $totalPrice }}$</span>
                  </p>
                </td>
                <div class="clearfix"></div>
              </tr>
              <tr>
                <td colspan="5">
                  <a href="{{ url('/checkout') }}" class="btn btn-yellow btn-lg pull-right margin-bottom-20">
                    {{ __('main.cont-to-check') }}
                  </a>


                  <a href="{{ url('/products') }} " class="btn btn-success btn-lg pull-right margin-right-20">
                    <i class="fa fa-plus"></i> {{ __('main.add-more') }}</a>

                  <div class="clearfix"></div>
                </td>
              </tr>
            </tbody>

          </table>
        @else
          <p>
            {{ __('main.not-found') }}
          </p>

        @endif
      </div>
      <!--End Cart page-->

    </div>
  </div>




@endsection

@section('scripts')

  <script type="text/javascript">
    $(document).ready(function() {

      // $(".update-cart").click(function(e) {
      //   e.preventDefault();
      //   var ele = $(this);
      //   $.ajax({
      //     url: "{{ url('/cart/update-cart') }}",
      //     method: "patch",
      //     data: {
      //       _token: '{{ csrf_token() }}',
      //       id: ele.attr("data-id"),
      //       quantity: ele.parents("tr").find(".quantity").val()
      //     },
      //     success: function(response) {
      //       window.location.reload();
      //     }
      //   });
      // });

      //   $(".remove").click(function(e) {
      //     e.preventDefault();
      //     var ele = $(this);
      //     var id = ele.attr("data-id");
      //     var row = ele.parents("tr");

      //     $.ajax({
      //       url: "{{ url('/cart/remove') }}",
      //       type: "DELETE",
      //       data: {
      //         _token: '{{ csrf_token() }}',
      //         id: id,
      //       },
      //       dataTaype:"json",
      //       success: function(response) {
      //         sessionStorage.clear()
      //         $("#header-bar").html(response.data);
      //          row.remove();



      //       }
      //     });

      //   });


    });

  </script>
@endsection
