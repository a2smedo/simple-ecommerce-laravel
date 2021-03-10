@extends('web.layouts.layout')
{{-- @section('title')

@endsection --}}


@section('main')
  <div class="content-area prodcuts">

    <div class="container">
      <div class="row">

        <div class="col-sm-12 col-md-12 col-lg-12">


          <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ url('/') }}"> {{__('main.home')}} </a></li>
            <li class="active"><a href="{{ url('/products') }}">{{__('main.products')}}  </a></li>
          </ol>


          <div class="all-products">
            <div class="">
              <h2 class="title-div wow slideInRight text-capitalize" data-wow-duration="1s" data-wow-delay="0s" data-wow-offset="10">
                 {{$subcategory->name()}} available</h2>
              <div class="products">
                <div class="row">

                  @foreach ($subcategory_products as $prod)

                    <div class="col-md-3">
                      <div class="product-item">
                        <div class="product-borde-inner">
                          <a href="{{ url("/products/show/{$prod->id}") }}">
                            <img src="{{ asset("uploads/$prod->img") }}" class="img img-responsive" />
                          </a>


                          <div class="product-price">
                            <a href="{{ url("/products/show/{$prod->id}") }}"> {{ $prod->name() }}</a><br />


                            <span class="prev-price">
                              <del>{{ $prod->price }}$</del>
                            </span>
                            <span class="current-price">
                              @php
                              $discount = $prod->price * $prod->discount /100;
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
                        <div >

                            {{ $subcategory_products->links() }}
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
