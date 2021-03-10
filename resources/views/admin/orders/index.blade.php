@extends('admin.layout.admin-layout')
@section('title')
Orders
@endsection

@section('head')
Orders
@endsection
@section('li')
<a href="{{url('/dashboard/orders')}}">Orders</a>
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
            <h3 class="card-title"> All Orders </h3>
          </div>
        </div>


        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                {{-- <th>User ID</th> --}}
                <th>User Name</th>
                <th>Email</th>
                <th>Phone </th>
                <th>Address</th>
                <th>Status </th>
                <th>Order Date </th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)

                <tr id="tr">
                  <td> {{ $loop->iteration }} </td>
                  {{-- <td> {{ $order->user_id }} </td> --}}
                  <td> {{ $order->username }} </td>
                  <td> {{ $order->user_email }} </td>
                  <td> {{ $order->user_phone }} </td>

                  <td> {{ $order->user_address }} - {{ $order->user_city }} - {{ $order->user_country }} </td>

                  <td>
                    @if ($order->status == 'pending')
                      <span class="badge badge-warning"> {{ $order->status }}</span>

                    @elseif($order->status == 'approved')
                      <span class="badge badge-success"> {{ $order->status }}</span>

                    @else
                      <span class="badge badge-danger"> {{ $order->status }}</span>

                    @endif
                  </td>



                  <td> {{ $order->created_at }} </td>



                  <td>
                    <a class="btn btn-sm btn-info" href=" {{ url("/dashboard/orders/show/{$order->id}") }} ">
                      Show
                      <i class="fas fa-eye"></i>
                    </a>

                    <a class="btn btn-sm btn-danger" href=" {{ url("/dashboard/orders/delete/{$order->id}") }} ">
                      <i class="fas fa-trash"></i>
                    </a>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="d-flex justify-content-center py-2 my-2">
            {{ $orders->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>



@endsection

@section('Script')

  <script>


  </script>

@endsection
