@extends('web.layouts.layout')
@section('css')


@endsection
@section('main')

<div class="content-area">
    <div class="container">
      <div class="checkout-page">
        <h2> {{__('main.add-rev-rat')}} </h2>

        <form action=" {{url("/products/review/store/$product->id")}} " method="POST" class="form-horizontal" role="form" id="checkoutForm">
            @csrf
          <div id="check1">
            <div class="form-group">
              <label class="control-label col-sm-2" for="review">{{__('main.review')}} </label>
              <div class="col-sm-10">

                <textarea  id="review" name="review" class="form-control" rows="4" placeholder="{{__('main.enter-rev')}} " ></textarea>
              </div>
            </div>

            <div class="form-group">
                <label for="my-select" class="control-label col-sm-2">{{__('main.rating')}} </label>

                <div class="col-sm-10">
                    <select id="my-select" class="form-control" name="rating" >
                        <option disabled selected> {{__('main.choose-rate')}}  </option>
                        <option value="1"> 1 </option>
                        <option value="2"> 2 </option>
                        <option value="3"> 3 </option>
                        <option value="4"> 4 </option>
                        <option value="5"> 5 </option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-info pull-right   margin-top-20"
                value="{{__('main.submit')}}  " style="margin-right: 20px !important"  />
            </div>

          </div> <!-- End check1 -->

        </form>
      </div>
      <!--End Checkout page -->
    </div> <!-- End Container -->


  </div> <!-- End content Area class -->


@endsection

@section('scripts')



@endsection
