@extends('web.layouts.layout')
{{-- @section('title')

@endsection --}}


@section('main')
  <div class="content-area prodcuts">

    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">

          <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ url('/') }}">{{ __('main.home') }} </a></li>
            <li class="active"><a href="{{ url('/products') }}">{{ __('main.products') }}</a></li>
            <li class="active">{{ __('main.high-price') }} </li>
          </ol>
          <div class="product-top">
            <h4> {{ __('main.all-products') }} </h4>
            <ul>
              <li class="dropdown head-dpdn">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ __('main.sortBy') }} <span
                    class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('products/most-popular') }}">{{ __('main.mostPopuler') }} </a></li>
                  <li><a href="{{ url('products/new-products') }}">{{ __('main.newProd') }} </a></li>
                  <li><a href="{{ url('products/low-price') }}">{{ __('main.low-price') }} </a></li>
                  <li><a href="{{ url('products/hight-price') }}">{{ __('main.high-price') }}</a></li>

                </ul>
              </li>
            </ul>
            <div class="clearfix"> </div>
          </div>


          <div class="all-products">
            <div class="">
              <h2 class="title-div wow slideInRight" data-wow-duration="1s" data-wow-delay="0s" data-wow-offset="10">
                {{ __('main.products') }} {{ __('main.high-price') }} </h2>
              <div class="products">
                <div class="row">

                  @foreach ($hightPriceProducts as $hightPriceProduct)

                    <div class="col-md-3">
                      <div class="product-item">
                        <div class="product-borde-inner">
                          <a href="{{ url("/products/show/{$hightPriceProduct->id}") }}">
                            <img src="{{ asset("uploads/$hightPriceProduct->img") }}" class="img img-responsive" />
                          </a>


                          <div class="product-price">
                            <a href="{{ url("/products/show/{$hightPriceProduct->id}") }}">
                              {{ $hightPriceProduct->name() }}</a><br />


                            <span class="prev-price">
                              <del>{{ $hightPriceProduct->price }}$</del>
                            </span>
                            <span class="current-price">
                              @php
                                $discount = ($hightPriceProduct->price * $hightPriceProduct->discount) / 100;
                                $newPrice = $hightPriceProduct->price - $discount;
                              @endphp
                              {{ $newPrice }}$
                            </span>
                          </div>

                          @if ($hightPriceProduct->quantity > 0)
                          <form id="addToCart" action="{{url("/cart/add-cart/{$hightPriceProduct->id}") }}" method="post" style="display: block;">
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
                              {{__('main.soldout')}}
                            </a>
                          @endif
                          <div class="clearfix"></div>
                        </div>
                      </div>
                    </div>
                  @endforeach

                </div> <!-- End Latest products row-->

                <div class="row" style="margin-top: 50px">
                  <div class="col-md-6 col-md-offset-3 text-center">
                    <div>
                      {{ $hightPriceProducts->links() }}
                    </div>
                  </div>
                </div>

              </div> <!-- End products div-->
            </div> <!-- End container latest products-->
          </div> <!-- End Latest products -->
        </div>
      </div>

    </div>

  </div>


@endsection
