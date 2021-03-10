@extends('admin.layout.admin-layout')
@section('title')
  Categories
@endsection

@section('head')
Categories
@endsection
@section('li')
<a href="{{url('/dashboard/categories')}}">Categories</a>
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
            <h3 class="card-title"> All Categories </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">
                Add new
              </button>
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name (en) </th>
                <th>Name (ar) </th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $cat)

                <tr>
                  <td> {{ $loop->iteration }} </td>
                  <td> {{ $cat->name('en') }} </td>
                  <td> {{ $cat->name('ar') }} </td>

                  <td>
                    @if ($cat->active == 1)
                      <span class="badge badge-success">Active</span>
                    @else
                      <span class="badge badge-danger">Dactive</span>
                    @endif
                  </td>

                  <td> {{ $cat->created_at }} </td>
                  <td>

                    <button type="button" class="btn btn-sm btn-warning editBtn" data-toggle="modal"
                      data-target="#editModal" data-id="{{ $cat->id }}" data-name-en="{{ $cat->name('en') }}"
                      data-name-ar="{{ $cat->name('ar') }}">
                      <i class="fas fa-edit"></i>
                    </button>

                    <a class="btn btn-sm btn-danger" href=" {{ url("/dashboard/categories/delete/{$cat->id}") }} ">
                      <i class="fas fa-trash"></i>
                    </a>

                    <a class="btn btn-sm btn-secondary" href=" {{ url("/dashboard/categories/toggle/{$cat->id}") }} ">
                      <i class="fas fa-toggle-on"></i>
                    </a>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="d-flex justify-content-center py-2 my-2">
            {{ $categories->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade show" id="addModal" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Add New Category </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          {{-- @include('admin.inc.errors') --}}

          <form id="addForm" method="POST" action=" {{ url('/dashboard/categories/store') }} ">
            @csrf

            <div class="form-group">
              <label for="name">Category Name </label>
              <input type="text" class="form-control" name="nameEn">
            </div>

            <div class="form-group">
              <label for="name" class="float-right"> أسم القسم </label>
              <input type="text" class="form-control text-right" name="nameAr">
            </div>


            <div class="form-group">
                <label> Department </label>
                <select class="custom-select form-control" name="department_id" id="department_id">
                  <option disabled>Choese Department </option>
                  @foreach ($departments as $department)
                    <option value="{{ $department->id }}"> {{ $department->name('en') }} </option>
                  @endforeach
                </select>
              </div>
              
          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="addForm">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <div class="modal fade show" id="editModal" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Edit Category </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          @include('admin.inc.errors')

          <form id="editForm" method="POST" action=" {{ url('/dashboard/categories/update') }} ">
            @csrf
            <input type="hidden" name="id" id="editId">

            <div class="form-group">
              <label for="name">Category Name </label>
              <input type="text" class="form-control" name="nameEn" id="nameEn">
            </div>

            <div class="form-group">
              <label for="name" class="float-right"> أسم الفئة </label>
              <input type="text" class="form-control text-right" name="nameAr" id="nameAr">
            </div>

            <div class="form-group">
                <label> Department </label>
                <select class="custom-select form-control" name="department_id" id="department_id">
                  <option disabled>Choese Department </option>
                  @foreach ($departments as $department)
                    <option value="{{ $department->id }}"> {{ $department->name('en') }} </option>
                  @endforeach
                </select>
              </div>

          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="editForm">Update changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


@endsection

@section('Script')

  <script>
    $('.editBtn').click(function() {
      let id = $(this).attr('data-id');
      let name_en = $(this).attr('data-name-en');
      let name_ar = $(this).attr('data-name-ar');

      $('#editId').val(id);
      $('#nameEn').val(name_en);
      $('#nameAr').val(name_ar);


    });

  </script>

@endsection
