@extends('web.layouts.layout')

@section('css')

<style>

</style>

@endsection

@section('main')

  <div class="content-area">
    <div class="main-slider">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="{{ asset('web/images/slider/slider1.jpg') }}" alt="Chania">
            <div class="carousel-caption">
              <div class="slide-header-text wow slideInLeft" data-wow-duration="1s" data-wow-delay="0s"
                data-wow-offset="10">{{ __('main.updatedProducts') }} </div> <br />
              <a href="{{ url('/products') }} " class="btn btn-red slider-link wow lightSpeedIn" data-wow-duration="1s"
                data-wow-delay="0s" data-wow-offset="10">{{ __('main.buyNow') }} </a>
            </div>
          </div>

          <div class="item">
            <img src="{{ asset('web/images/slider/slider2.jpg') }}" alt="Chania">
            <div class="carousel-caption">
              <div class="slide-header-text wow rotateIn" data-wow-duration="1s" data-wow-delay="0s" data-wow-offset="10">
                {{ __('main.looking') }} </div> <br />
              <a href="{{ url('/products') }} " class="btn btn-red slider-link wow lightSpeedIn" data-wow-duration="1s"
                data-wow-delay="0s" data-wow-offset="10">{{ __('main.buyNow') }}</a>
            </div>
          </div>

          <div class="item">
            <img src="{{ asset('web/images/slider/slider3.jpg') }}" alt="Flower">
            <div class="carousel-caption">
              <div class="slide-header-text wow rollIn" data-wow-duration="1s" data-wow-delay="0s" data-wow-offset="10">
                {{ __('main.electronicProducts') }}</div> <br />
              <a href="{{ url('/products') }} " class="btn btn-red slider-link wow zoomIn" data-wow-duration="1s"
                data-wow-delay="0s" data-wow-offset="10">{{ __('main.buyNow') }}</a>
            </div>
          </div>

          <div class="item">
            <img src="{{ asset('web/images/slider/slider4.jpg') }}" alt="Flower">
            <div class="carousel-caption">
              <div class="slide-header-text wow bounceInLeft" data-wow-duration="1s" data-wow-delay="0s"
                data-wow-offset="10">{{ __('main.updatedProducts') }}</div> <br />
              <a href="{{ url('/products') }} " class="btn btn-red slider-link wow slideInRight" data-wow-duration="1s"
                data-wow-delay="0s" data-wow-offset="10">{{ __('main.buyNow') }}</a>
            </div>
          </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>

        </a>

        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div> <!-- End Main slider class -->


    <!--Start Featured products Div-->
    <x-feat-products></x-feat-products>
    <!--End Featured products Div-->


    <div class="latest-products">
        <div class="container">
          <h2 class="title-div wow slideInLeft" data-wow-duration="1s" data-wow-delay="0s" data-wow-offset="10">
            {{ __('main.latest') }} </h2>
          <div class="products">
            <div class="row">

              @foreach ($products as $prod)
                <div class="col-md-3">
                  <div class="product-item">
                    <div class="product-borde-inner">
                      <a href="{{ url("/products/show/{$prod->id}") }}">
                        <img src="{{ asset("uploads/$prod->img") }} " class="img img-responsive" />
                      </a>

                      <div class="product-price">
                        <a href="{{ url("/products/show-product/{$prod->id}") }}"> {{ $prod->name() }}</a><br />
                        <span class="prev-price">
                          <del>{{ $prod->price }}$</del>
                        </span>
                        <span class="current-price">
                          @php
                            $discount = ($prod->price * $prod->discount) / 100;
                            $newPrice = $prod->price - $discount;
                          @endphp
                          {{ $newPrice }}$
                        </span>
                      </div>



                      @if ($prod->quantity > 0)

                      <form id="addToCart" action="{{url("/cart/add-cart/{$prod->id}") }}" method="post" style="display: block;">
                          @csrf
                          <button id="test" type="submit"
                          class="btn btn-cart text-center add-to-cart pull-right">
                          <i class="fa fa-cart-plus"></i>
                          {{ __('main.addCart') }}
                        </button>
                        </form>
                      @else
                        <a href="javascript:void(0);"
                          style="background-color: #333 !important; color:#fff; cursor: not-allowed "
                          class="btn btn-cart text-center add-to-cart pull-right">
                          {{ __('main.soldout') }}
                        </a>
                      @endif

                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div><!-- End Latest products[single] -->
              @endforeach


              <div class="clearfix"></div>

            </div> <!-- End Latest products row-->
            <a href="{{ url('/products') }}" class="btn btn-blue btn-lg pull-right btn-more wow slideInRight"
              data-wow-duration="1s" data-wow-delay="0s" data-wow-offset="10">
              <span>{{ __('main.seeMore') }} </span>
            </a>
            <div class="clear"></div>
          </div> <!-- End products div-->
        </div> <!-- End container latest products-->
      </div> <!-- End Latest products -->

      @include('web.includes.service-area')

  </div>

@endsection
