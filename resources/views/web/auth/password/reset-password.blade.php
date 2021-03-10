@extends('web.layouts.layout')
{{-- @section('title')

@endsection --}}


@section('main')


  <div class="content-area">

    <div class="login-page">
      <div class="container">

        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center">Update Password</h2>
            <form method="post" class="cmxform" action="{{ route('password.update') }}" id="loginForm">
              @csrf

              <input type="hidden" name="token" value="{{ $request->route('token') }}">

              <div class="form-group row">
                <label for="email" class="col-sm-2 form-control-label">Email:</label>
                <div class="col-sm-8">
                  <input type="email" name="email" class="form-control" id="email" value="{{ $request->email }}" />
                </div>
              </div>

              @error('email')
                <div class="row">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-10">
                    <span class="invalid-feedback text-danger" role="alert">
                      <strong> {{ $message }} </strong>
                    </span>
                  </div>
                </div>
              @enderror

              <div class="form-group row">
                <label for="password" class="col-sm-2 form-control-label">Password:</label>
                <div class="col-sm-8">
                  <input type="password" name="password" class="form-control" id="password"
                    placeholder="Enter password" />
                </div>
              </div>

              @error('password')
                <div class="row">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-10">
                    <span class="invalid-feedback text-danger" role="alert">
                      <strong> {{ $message }} </strong>
                    </span>
                  </div>
                </div>
              @enderror

              <div class="form-group row">
                <label for="confirm_password" class="col-sm-2 form-control-label">Confirm Password:</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="password_confirmation" id="confirm_password"
                    placeholder="Same password previously entered">
                </div>
              </div>




              <div class="form-group row">
                <div class="col-sm-offset-2 col-sm-8">
                  <input type="submit" class="btn btn-success btn-lg btn-block" id="submitForm" value="Update" />
                </div>
              </div>

            </form>




          </div>
        </div>
        <!--End Row-->

      </div>
    </div>
    <!--End Registration page div-->

  </div> <!-- End content Area class -->


@endsection
