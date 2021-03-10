@extends('admin.layout.admin-layout')
@section('title')
  Show Order
@endsection

@section('head')
  Order Details
@endsection
@section('li')
  <a href="{{ url('/dashboard/orders/show/' . $order->id) }}">Order</a>
@endsection

@section('content')

  <div class="col py-2">

    {{-- <div class="row">
      <div class="col">
        @if (session('add'))
          <div class="alert alert-success" role="alert">
            {{ session('add') }}
          </div>
        @endif

        @if (session('update'))
          <div class="alert alert-info" role="alert">
            {{ session('update') }}
          </div>
        @endif

        @if (session('deleted'))
          <div class="alert alert-warning" role="alert">
            {{ session('deleted') }}
          </div>
        @endif

        @if (session('no-deleted'))
          <div class="alert alert-danger" role="alert">
            {{ session('no-deleted') }}
          </div>
        @endif
      </div>
    </div> --}}

    <div class="row">
      <div class="col">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Order Information </h3>
          </div>
          <div class="card-body">
            <p>User Name : {{ $order->username }} </p>
            <p>Email : {{ $order->user_email }} </p>
            <p>Date : {{ Carbon\Carbon::parse($order->created_at)->format('d M Y - h:i:s A ') }} </p>

          </div>
        </div>


        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Unite Price</th>
                <th>Discount</th>
                <th>Quantity </th>
                <th>Total for Product</th>


              </tr>
            </thead>
            <tbody>
              @foreach ($rows as $row)


                <tr>
                  <td> {{ $loop->iteration }} </td>
                  <td> {{ $row->id }} </td>
                  <td> {{ $row->name('en') }} </td>
                  <td> {{ $row->pivot->unite_price }} </td>
                  <td> {{ $row->discount }}% </td>
                  <td> {{ $row->pivot->quantity_orderd }} </td>
                  <td> {{ $row->pivot->total_price }} </td>
                  {{-- <td> {{ $row->pivot->created_at }} </td> --}}

                </tr>


              @endforeach

              <tr>
                <td colspan="6"></td>
                <td colspan=""> Total : {{ $total['0']->total }} $</td>
              </tr>

              <tr>
                <td colspan="6">
                    <a href=""  class="text-dark" >
                        <i class="fas fa-print"></i>
                        Print
                    </a>
                </td>

                <td>
                  <a href="{{ url("/dashboard/orders/approved/{$order->id}") }}" class="btn btn-sm btn-primary">
                    Approved </a>

                  <a href="{{ url("/dashboard/orders/canceled/{$order->id}") }}" class="btn btn-sm btn-danger"
                    id="cancel">
                    Cancel
                    <i class="fas fa-times"></i>
                  </a>
                  {{-- <a href="" class="btn btn-warning"> Print </a> --}}
                </td>
              </tr>

            </tbody>
          </table>


        </div>
      </div>
    </div>
  </div>



@endsection
