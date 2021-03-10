<div class="featured-products">
    <div class="container">
      <h2 class="title-div wow slideInLeft pull-left" data-wow-duration="1s" data-wow-delay="0s" data-wow-offset="10">
        {{__('main.topFeatured')}}  </h2>
      <div class="clear"></div>

      {{-- <div class="featured-navigation pull-right">
        <span  >
          <a style="background-color: red !important ; margin-bottom: 550px !important " class="owl-prev owl-navigaiton"><i class="fa fa-angle-double-right"></i></a>
        </span>

         <span class="stop">
          <a class="owl-next owl-navigaiton">||</a>
        </span>
         <span class="">
          <a  style="background-color: red !important ; margin-top: 50px !important "
          class="owl-next owl-navigaiton"><i class="fa fa-angle-double-left"></i></a>
        </span>


      </div> --}}

      <div class="clear"></div>
      <div class="featured-items">
        <!-- Set up your HTML -->
        <div class="owl-carousel">



          @foreach ($fProducts as $p)
            <div class="product-item animated">
              <div class="product-borde-inner">
                <a href="{{url("/products/show/{$p->id}")}}">
                  <img src="{{asset("uploads/$p->img")}} " class="img img-responsive" />
                </a>

                <div class="product-price">
                  <a href="{{url("/products/show/{$p->id}")}}"> {{$p->name()}}</a><br />
                  <span class="prev-price">
                    <del>{{$p->price}}$</del>
                  </span>
                  <span class="current-price">
                      @php
                       $discount = $p->price * $p->discount /100;
                          $newPrice = $p->price - $discount;
                      @endphp
                      {{ $newPrice }}$
                  </span>
                </div>

                @if ($p->quantity > 0)

                <form id="addToCart" action="{{url("/cart/add-cart/{$p->id}") }}" method="post" style="display: block;">
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
          @endforeach




        </div>
      </div>
    </div>
  </div>
  <!--End Featured products Div-->
