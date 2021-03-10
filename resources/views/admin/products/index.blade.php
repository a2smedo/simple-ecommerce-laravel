@extends('admin.layout.admin-layout')
@section('title')
Products
@endsection

@section('head')
Products
@endsection
@section('li')
<a href="{{url('/dashboard/products')}}">Products</a>
@endsection




@section('content')


  <div class="col py-2">

    <div class="row">
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
    </div>

    <div class="row">
      <div class="col">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> All Products </h3>

            <div class="card-tools">
              <a href="{{url("/dashboard/products/create")}}"  class="btn btn-sm btn-primary">
                Add new
              </a>
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Sub-Category</th>
                <th>Name (en) </th>
                <th>Name (ar) </th>
                <th>Image </th>
                <th>Price </th>
                <th>Quantity </th>
                <th>Discount </th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)

                <tr>
                  <td> {{ $loop->iteration }} </td>
                  <td> {{ $product->subcategory->name('en') }} </td>
                  <td> {{ $product->name('en') }} </td>
                  <td> {{ $product->name('ar') }} </td>

                  <td>
                    <img height="50px"  src="{{asset("uploads/$product->img") }}">
                  </td>

                  <td> {{ $product->price}} </td>

                  <td> {{ $product->quantity}} </td>

                  <td> {{ $product->discount}} </td>

                  <td>
                    @if ($product->active == 1)
                      <span class="badge badge-success">Active</span>
                    @else
                      <span class="badge badge-danger">Dactive</span>
                    @endif
                  </td>

                  <td>
                    <a class="btn btn-sm btn-info" href=" {{ url("/dashboard/products/show/{$product->id}") }} ">
                        <i class="fas fa-eye"></i>
                    </a>



                    <a class="btn btn-sm btn-warning" href=" {{ url("/dashboard/products/edit/{$product->id}") }} ">
                        <i class="fas fa-edit"></i>
                    </a>

                    <a class="btn btn-sm btn-danger" href=" {{ url("/dashboard/products/delete/{$product->id}") }} ">
                      <i class="fas fa-trash"></i>
                    </a>


                    <a class="btn btn-sm btn-secondary" href=" {{ url("/dashboard/products/toggle/{$product->id}") }} ">
                      <i class="fas fa-toggle-on"></i>
                    </a>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="d-flex justify-content-center py-2 my-2">
            {{ $products->links() }}
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
