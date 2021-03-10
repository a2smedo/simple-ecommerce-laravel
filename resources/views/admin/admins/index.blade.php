@extends('admin.layout.admin-layout')

@section('title')
Admins
@endsection

@section('head')
Admins
@endsection
@section('li')
<a href="{{url('/dashboard/admins')}}">Admins</a>
@endsection

@section('content')



  <div class="col py-2">

    <div class="row">
      <div class="col">
        @if (session('msgAdd'))
          <div class="alert alert-success" role="alert">
            {{ session('msgAdd') }}
          </div>
        @endif

        @if (session('msgUpdate'))
          <div class="alert alert-info" role="alert">
            {{ session('msgUpdate') }}
          </div>
        @endif

        @if (session('msgDeleted'))
          <div class="alert alert-warning" role="alert">
            {{ session('msgDeleted') }}
          </div>
        @endif

        @if (session('msgNoDeleted'))
          <div class="alert alert-danger" role="alert">
            {{ session('msgNoDeleted') }}
          </div>
        @endif
      </div>
    </div>

    <div class="row">
      <div class="col">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> All Admins </h3>

            <div class="card-tools">
              <a class="btn btn-sm btn-primary" href=" {{ url('/dashboard/admins/create') }} ">Add Admin</a>
            </div>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name </th>
                <th>Email</th>
                <th>Role</th>
                <th>Verified</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($admins as $admin)

                <tr>
                  <td> {{ $loop->iteration }} </td>
                  <td> {{ $admin->name }} </td>
                  <td> {{ $admin->email }} </td>
                  <td> {{ $admin->rule->name }} </td>


                  <td>
                    @if ($admin->email_verified_at)
                      <span class="badge badge-success">Verified</span>
                    @else
                      <span class="badge badge-danger">Not Verified</span>
                    @endif
                  </td>

                  @if ($admin->rule->name !== 'superadmin')
                    <td>

                      @if ($admin->rule->name == 'admin')

                        <a class="btn btn-sm btn-success" href=" {{ url("/dashboard/admins/promot/$admin->id") }} ">
                          <i class="fas fa-level-up-alt"></i>
                        </a>
                      @else
                        <a class="btn btn-sm btn-danger" href=" {{ url("/dashboard/admins/demot/$admin->id") }} ">
                          <i class="fas fa-level-down-alt"></i>
                        </a>
                      @endif

                      <a class="btn btn-sm btn-danger" href=" {{ url("/dashboard/admins/delete/$admin->id") }} ">
                        <i class="fas fa-trash"></i>
                      </a>

                    </td>
                  @else

                  <td>
                      <span class="badge badge-secondary"> Super Admin </span>
                  </td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="d-flex justify-content-center py-2 my-2">
            {{ $admins->links() }}
          </div>
        </div>
      </div>


    </div>

  </div>

@endsection
