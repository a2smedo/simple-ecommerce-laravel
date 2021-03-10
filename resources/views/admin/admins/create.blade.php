@extends('admin.layout.admin-layout')


@section('title')
Admins
@endsection

@section('head')
Create New Admin
@endsection
@section('li')
<a href="{{url('/dashboard/admins/create')}}">Create New Admin</a>
@endsection

@section('content')



  <div class="col">

    <div class="row">
      <div class="col">
        @include('admin.inc.errors')
      </div>
    </div>
    <div class="row">
      <div class="col">

        <form method="POST" action="{{ url('dashboard/admins/store') }}">
          @csrf

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="name"> Name </label>
                <input type="text" class="form-control" name="name">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="name"> Email </label>
                <input type="email" class="form-control" name="email">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">

              <div class="form-group">
                <label for="name"> Password </label>
                <input type="password" class="form-control" name="password">
              </div>
            </div>
            <div class="col">

              <div class="form-group">
                <label for="name"> Confirm Password </label>
                <input type="password" class="form-control" name="password_confirmation">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">

              <div class="form-group">
                <label for="country"> Country </label>
                <input type="text" class="form-control" name="country">
              </div>
            </div>
            <div class="col">

              <div class="form-group">
                <label for="city"> City </label>
                <input type="text" class="form-control" name="city">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">

              <div class="form-group">
                <label for="phone"> Phone </label>
                <input type="text" class="form-control" name="phone">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label> Role </label>
                <select class="custom-select form-control" name="rule_id">
                  <option disabled>Choese Role </option>
                  @foreach ($rules as $rule)
                    <option value="{{ $rule->id }}"> {{ $rule->name }} </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">

              <div class="form-group">
                <label for="my-textarea">Address</label>
                <textarea id="my-textarea" class="form-control" name="address" rows="3"></textarea>
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
      </div>
    </div>

  </div>
@endsection
