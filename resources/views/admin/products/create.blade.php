@extends('admin.layout.admin-layout')


@section('title')
  Create Product
@endsection

@section('head')
Create New Product
@endsection
@section('li')
<a href="{{url('/dashboard/products/create')}}">Create Product</a>
@endsection

@section('content')

  <div class="col">

    <form method="POST" action="{{ url('dashboard/products/store') }}" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Product Name </label>
            <input type="text" class="form-control" name="nameEn">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="name" class="float-right"> أسم المنتج </label>
            <input type="text" class="form-control text-right" name="nameAr">
          </div>
        </div>
      </div>




      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="exampleInputFile">Image</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="img">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label> Sub-Category </label>
            <select class="custom-select form-control" name="subcategory_id">
              <option disabled>Choese Sub-Category </option>
              @foreach ($subCats as $subCat)
                <option value="{{ $subCat->id }}"> {{ $subCat->name('en') . '&&' . $subCat->name('ar') }} </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>


      <div class="form-group">
        <label for="name">Product Description </label>
        <textarea name="descEn" class="form-control" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label class="float-right" for="name"> وصف المنتج </label>
        <textarea name="descAr" class="form-control text-right" rows="3"></textarea>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="name"> Price </label>
            <input type="number" name="price" class="form-control">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="name"> Quantity </label>
            <input type="number" name="quantity" class="form-control">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="name"> Discount </label>
            <input type="number" name="discount" class="form-control">
          </div>
        </div>
      </div>

      <div class="row pb-3">

        <div class="col">
          <a class="btn btn-primary" href=" {{ url()->previous() }} ">
            Back
          </a>
        </div>

        <div class="col text-right">
          <button type="submit" class="btn btn-success"> Save </button>
        </div>
      </div>

    </form>


    @include('admin.inc.errors')
  </div>
@endsection
