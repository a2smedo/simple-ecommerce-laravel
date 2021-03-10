@extends('admin.layout.admin-layout')


@section('title')

  Show Product
@endsection

@section('head')
{{ $product->name('en') }}
@endsection
@section('li')
<a href="{{url('/dashboard/products/show/'. $product->id)}}">{{ $product->name('en') }}</a>
@endsection

@section('content')

  <div class="col">

    <div class="row">
      <div class="col">
        @if (session('msgUpdate'))
          <div class="alert alert-info" role="alert">
            {{ session('msgUpdate') }}
          </div>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Product details</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-sm">

              <tbody>
                <tr>
                  <th>Name (en)</th>
                  <td>
                    {{ $product->name('en') }}
                  </td>
                </tr>
                <tr>
                  <th>Name (ar)</th>
                  <td>
                    {{ $product->name('ar') }}
                  </td>
                </tr>

                <tr>
                  <th>Description (en)</th>
                  <td>
                    {{ $product->desc('en') }}
                  </td>
                </tr>
                <tr>
                  <th>Description (ar)</th>
                  <td>
                    {{ $product->desc('ar') }}
                  </td>
                </tr>

                <tr>
                  <th>Sub-Category</th>
                  <td>
                    {{ $product->subcategory->name('en') }}
                  </td>
                </tr>

                <tr>
                  <th>Image</th>
                  <td>
                    <img src="{{ asset("uploads/$product->img") }}" alt="" height="50px">
                  </td>
                </tr>

                <tr>
                  <th>Price</th>
                  <td>
                    {{ $product->price }}
                  </td>
                </tr>
                <tr>
                  <th>Quantity</th>
                  <td>
                    {{ $product->quantity }}
                  </td>
                </tr>
                <tr>
                  <th>Discount</th>
                  <td>
                    {{ $product->discount }}
                  </td>
                </tr>
                <tr>
                  <th>Reviews</th>
                  <td>
                    {{ $product->reviews }}
                  </td>
                </tr>
                <tr>
                  <th>Rating</th>
                  <td>
                    {{ $product->rating }}
                  </td>
                </tr>

                <tr>
                  <th>Active</th>
                  <td>
                    @if ($product->active)
                      <span class="badge badge-success">Active</span>
                    @else
                      <span class="badge badge-danger">Deactive</span>
                    @endif
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>

    <div class="row pb-3">
      <div class="col-md-10 mx-auto text-right">
        <a class="btn  btn-primary" href=" {{ url()->previous() }} ">
          Back
        </a>
      </div>
    </div>

  </div>

@endsection
