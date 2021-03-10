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
            <li class="active">{{ __('main.mostPopuler') }} </li>
          </ol>
          <div class="product-top">
            <h4> {{ __('main.all-products') }} </h4>
            <ul>
              <li class="dropdown head-dpdn">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ __('main.sortBy') }} <span
                    class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('products/most-popular') }}">
                      {{ __('main.mostPopuler') }} </a></li>
                  <li><a href="{{ url('products/new-products') }}">{{ __('main.newProd') }} </a></li>
                  <li><a href="{{ url('products/low-price') }}">
                      {{ __('main.low-price') }} </a></li>
                  <li><a href="{{ url('products/hight-price') }}">{{ __('main.high-price') }}</a></li>

                </ul>
              </li>
            </ul>
            <div class="clearfix"> </div>
          </div>


          <div class="all-products">
            <div class="">
              <h2 class="title-div wow slideInRight" data-wow-duration="1s" data-wow-delay="0s" data-wow-offset="10">
                {{ __('main.products') }} {{ __('main.mostPopuler') }}</h2>
              <div class="products">
                <div class="row">

                  @foreach ($mostPopulars as $mostProd)

                    <div class="col-md-3">
                      <div class="product-item">
                        <div class="product-borde-inner">
                          <a href="{{ url("/products/show/{$mostProd->id}") }}">
                            <img src="{{ asset("uploads/$mostProd->img") }}" class="img img-responsive" />
                          </a>


                          <div class="product-price">
                            <a href="{{ url("/products/show/{$mostProd->id}") }}">
                              {{ $mostProd->name() }}</a><br />


                            <span class="prev-price">
                              <del>{{ $mostProd->price }}$</del>
                            </span>
                            <span class="current-price">
                              @php
                                $discount = ($mostProd->price * $mostProd->discount) / 100;
                                $newPrice = $mostProd->price - $discount;
                              @endphp
                              {{ $newPrice }}$
                            </span>
                          </div>

                          @if ($mostProd->quantity > 0)
                          <form id="addToCart" action="{{url("/cart/add-cart/{$mostProd->id}") }}" method="post" style="display: block;">
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
                    </div>
                  @endforeach

                </div> <!-- End Latest products row-->


                <div class="row" style="margin-top: 50px">
                  <div class="col-md-6 col-md-offset-3 text-center">
                    <div>
                      {{ $mostPopulars->links() }}
                    </div>
                  </div>
                </div>

              </div> <!-- End products div-->
            </div> <!-- End container latest products-->
          </div> <!-- End Latest products -->
        </div>
      </div>

    </div>



  </div> <!-- End content Area class -->

@endsection
