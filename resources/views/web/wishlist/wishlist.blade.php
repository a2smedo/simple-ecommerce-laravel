@extends('web.layouts.layout')
@section('title')

@endsection
@section('main')

  <div class="content-area">
    <div class="container">
      <div class="cart-page">
        <h2>{{__('main.wishlist')}} </h2>

        @if ($wishlists->count() > 0)
          <table class="table">
            <thead>
              <tr>
                <th width="10%">{{__('main.pro_id')}}</th>
                <th width="20%">{{__('main.pro_name')}}</th>
                <th width="20%">{{__('main.pro_img')}}</th>
                <th width="10%">{{__('main.price')}}</th>
                <th width="15%">{{__('main.pro_disc')}}</th>
                <th width="15%">{{__('main.pro_afte_disc')}}</th>
                <th width="10%">{{__('main.action')}}</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($wishlists as $wishlist)
                <tr>
                  <td> {{ $wishlist->product->id }} </td>
                  <td>
                    <a style="color: #333" href="{{ url("/products/show-product/{$wishlist->product->id}") }} ">
                      {{ $wishlist->product->name() }}
                    </a>
                  </td>

                  <td>
                    <div class="product-price">
                      <a href="{{ url("/products/show-product/{$wishlist->product->id}") }} ">
                        <img src="{{ asset("uploads/{$wishlist->product->img}") }} " width="50" alt=""
                          class="img img-thumbnail ">
                      </a>
                    </div>
                  </td>

                  <td> {{ $wishlist->product->price }}$</td>
                  <td> {{ $wishlist->product->discount }}%</td>
                  <td>
                    @php
                      $discount = ($wishlist->product->price * $wishlist->product->discount) / 100;
                      $newPrice = $wishlist->product->price - $discount;
                    @endphp
                    {{ $newPrice }}$
                  </td>

                  <td>
                    <div style="display: flex; justify-content: space-between">
                      @if ($wishlist->product->quantity > 0)

                        <form id="addToCart" action="{{url("/cart/add-cart/{$wishlist->product->id}") }}" method="post" style="display: block;">
                            @csrf
                            <button id="test" type="submit" style="padding: 8px 14px !important"
                            class="btn btn-primary text-center add-to-cart">
                            <i class="fa fa-cart-plus"></i>

                          </button>
                          </form>

                      @else
                        <a href="javascript:void(0);"
                          style="background-color: #333 !important; color:#fff; cursor: not-allowed "
                          class="btn btn-primary text-center add-to-cart ">
                          Sold out
                        </a>
                      @endif
                      <form  action="{{ url("wishlist/delete/{$wishlist->product->id}") }} "
                        method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger" style="padding: 8px 14px !important">
                          <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>

          </table>
        @else
          <p> No items found into Wishlist </p>
        @endif

      </div>
      <!--End Cart page-->

    </div>
  </div>




@endsection

@section('scripts')


@endsection
