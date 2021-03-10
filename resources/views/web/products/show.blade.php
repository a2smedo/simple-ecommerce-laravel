@extends('web.layouts.layout')
@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('web/css/flexslider.css') }}">

@endsection
@section('main')

  <div class="content-area prodcuts">


    <div class="container">

      <div class="row" id="hidee">
        <div class="col">
          @if (session('add-rev'))
            <div class="alert alert-success" role="alert">
              {{ session('add-rev') }}
            </div>

          @endif
          @if (session('add-wish'))
            <div class="alert alert-success" role="alert">
              {{ session('add-wish') }}
            </div>

          @endif
        </div>
      </div>



      <ol class="breadcrumb breadcrumb1">
        <li><a href="{{ url('/') }}">{{ __('main.home') }} </a></li>
        <li><a href=" {{ url('/products') }} ">{{ __('main.products') }} </a></li>
        <li class="active"> {{ $product->name() }}</li>
      </ol>

      <div class="single-product">
        <div class="row" id="">
          <div class="col-md-6 single-top-left">
            <div class="flexslider">
              <ul class="slides">
                <li data-thumb=" {{ asset("uploads/$product->img") }} ">
                  <div class="thumb-image detail_images">
                    <img src="{{ asset("uploads/$product->img") }}" data-imagezoom="true" class="img-responsive" alt="">
                  </div>
                </li>
                <li data-thumb="{{ asset("uploads/$product->img") }}">
                  <div class="thumb-image">
                    <img src="{{ asset("uploads/$product->img") }}" data-imagezoom="true" class="img-responsive"
                      alt="" />
                  </div>
                </li>
                <li data-thumb="{{ asset("uploads/$product->img") }}">
                  <div class="thumb-image">
                    <img src="{{ asset("uploads/$product->img") }}" data-imagezoom="true" class="img-responsive"
                      alt="" />
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 single-top-right">
            <h3 class="item_name"> {{ $product->name() }} </h3>
            <p>Processing Time: Item will be shipped out within 4-7 working days. </p>
            <div class="single-rating">
              <ul>

                @for ($i = 1; $i <= $product->rating; $i++)
                  <li><i class="fa fa-star" aria-hidden="true" style="color:#FFDF00"></i></li>
                @endfor

                @for ($i = 1; $i <= 5 - $product->rating; $i++)
                  <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                @endfor

                <li class="rating"> {{ $product->reviews }} {{ __('main.reviews') }} </li>
                <li><a href="{{ url("/products/review/$product->id") }}">{{ __('main.add-review') }}</a></li>
              </ul>
            </div>
            <div class="single-price">
              <ul>
                <li class="product-price">

                  @php
                    $discount = ($product->price * $product->discount) / 100;
                    $newPrice = $product->price - $discount;
                  @endphp
                  {{ $newPrice }}$
                </li>
                <li><del>${{ $product->price }}</del></li>
                <li><span class="off">{{ $product->discount }}%</span></li>
                {{-- <li>Ends on: June,5th</li>
                <li><a href="#"><i class="fa fa-gift" aria-hidden="true"></i> Coupon</a></li> --}}
              </ul>
            </div>
            <p class="single-price-text">
              {{ Str::limit($product->desc(), 100) }}
            </p>


            @if ($product->quantity > 0)
              {{-- <form id="addToCart" action="{{ url("/cart/add-cart/{$product->id}") }}" method="post"
                style="display: inline">
                @csrf
                <button id="test" type="submit" class="btn btn-cart text-center add-to-cart pull-right">
                  <i class="fa fa-cart-plus"></i>
                  {{ __('main.addCart') }}
                </button>
              </form> --}}


              <form style="display: inline-block" action="{{ url("/cart/add-cart/{$product->id}") }}" method="post">
                @csrf
                <button id="test" type="submit" class="btn btn-danger">
                    <i class="fa fa-cart-plus"></i>
                    {{ __('main.addCart') }}
                  </button>
              </form>


            @else
              <a type="button" style="background-color: #333 !important; color:#fff; cursor: not-allowed "
                class="btn btn-red">
                {{ __('main.soldout') }}
              </a>
            @endif

            <form style="display: inline-block" action="{{ url("/wishlist/add/{$product->id}") }}" method="post">
              @csrf
              <input type="hidden" name="user_id" />
              <input type="hidden" name="product_id" />

              <button type="submit" class="btn btn-primary"><i class="fa fa-heart-o" aria-hidden="true"></i>
                {{ __('main.add-wishlist') }}</button>

            </form>

          </div>
          {{-- <div class="clearfix"> </div> --}}
        </div>
        <div class="single-page-icons social-icons">
          <ul>
            <li>
              <h4> {{ __('main.share') }}</h4>
            </li>
            <li><a href="#" class="fa fa-facebook-square icon facebook"> </a></li>
            <li><a href="#" class="fa fa-twitter-square icon twitter"> </a></li>
            <li><a href="#" class="fa fa-google-plus-square icon googleplus"> </a></li>
            <li><a href="#" class="fa fa-rss-square icon rss"> </a></li>
          </ul>
        </div>

        <div class="single-product-everything">

          <div class="single-extra-div">
            <a data-toggle="collapse" class="pointer main" aria-expanded="true" data-target="#productDescriptionCollapse"
              aria-controls="#productDescriptionCollapse">
              <span class="pull-left title-sidebar"><i class="fa fa-info-circle"></i> {{ __('main.pro_desc') }}</span>

              <span class="pull-right"><i class="fa fa-plus"></i></span>
              <span class="pull-right"><i class="fa fa-minus"></i></span>
              <div class="clearfix"></div>
            </a>
            <div id="productDescriptionCollapse" class="collapse in collapseDiv">
              <p> {{ $product->desc() }} </p>
            </div>
          </div> <!-- End single product extra div -->

          <div class="single-extra-div">
            <a data-toggle="collapse" class="pointer main" aria-expanded="true" data-target="#productReviewCollapse"
              aria-controls="#productReviewCollapse">
              <span class="pull-left title-sidebar"> <i class="fa fa-check-square-o"></i>
                {{ __('main.pro_rev') }} <span class="badge">{{ $product->reviews }} </span>
              </span>

              <span class="pull-right"><i class="fa fa-plus"></i></span>
              <span class="pull-right"><i class="fa fa-minus"></i></span>
              <div class="clearfix"></div>
            </a>
            <div id="productReviewCollapse" class="collapse collapseDiv">



              @foreach ($reviews as $rev)

                <div class="review">
                  <h5 style="margin-bottom: 0">
                    By {{ $rev->name }} on
                    <small>{{ Carbon\Carbon::parse($rev->created_at)->format('d M Y') }}</small>
                  </h5>
                  <p style="" class="text-muted"> {{ $rev->review }}
                    <br>
                    <span> Rating : {{ $rev->rating }} </span>

                  </p>
                </div>
              @endforeach



            </div>
          </div> <!-- End single product extra div -->




        </div>
        <!--End Sidebar title div-->

      </div>

    </div>
  </div>



@endsection

@section('scripts')

  <script src=" {{ asset('web/js/jquery.flexslider.js') }} " type="text/javascript"></script>
  <script>
    $(window).load(function() {
      $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
      });
    });

    jQuery(document).ready(function() {
      setInterval(function() {
        $('#hidee').hide();
      }, 5000);

    });

  </script>
  <!--flex slider-->
  <script src=" {{ asset('web/js/imagezoom.js') }} " type="text/javascript"></script>

@endsection
