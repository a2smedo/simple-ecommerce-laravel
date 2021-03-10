@extends('web.layouts.layout')
{{-- @section('title')

@endsection --}}


@section('main')

  <div class="content-area">

    <div class="registration-page">
      <div class="container">

        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center">Create Your Account</h2>
            <form method="post" class="cmxform" action="{{ route('register') }}" id="signUpForm">
              @csrf

              <div class="form-group row">
                <label for="firstname" class="col-sm-2 form-control-label"> Name:</label>
                <div class="col-sm-8">
                  <input type="text" name="name" class="form-control" id="firstname" placeholder="Your name"
                    minlength="2">
                </div>
              </div>
              @error('name')
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
                <label for="email" class="col-sm-2 form-control-label">Email:</label>
                <div class="col-sm-8">
                  <input type="email" name="email" class="form-control email" id="email" placeholder="test@example.com">
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

              {{-- <div class="form-group row">
                <label for="username" class="col-sm-2 form-control-label">Username:</label>
                <div class="col-sm-8">
                  <input type="text" name="username" class="form-control" id="username" placeholder="akash90">
                </div>
              </div> --}}

              <div class="form-group row">
                <label for="password" class="col-sm-2 form-control-label">Password:</label>
                <div class="col-sm-8">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
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

              {{-- <div class="form-group row">
                <label for="birthdate" class="col-sm-2 form-control-label">BirthDate:</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" name="birthdate" id="birthdate" placeholder="Enter Birthdate"
                    required>
                </div>
              </div> --}}

              <div class="form-group row">
                <label for="country" class="col-sm-2 form-control-label"> Country:</label>
                <div class="col-sm-8">
                  <input type="text" name="country" class="form-control" id="country" placeholder="Your Country"
                    minlength="2">
                </div>
              </div>
              @error('country')
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
                <label for="city" class="col-sm-2 form-control-label"> City:</label>
                <div class="col-sm-8">
                  <input type="text" name="city" class="form-control" id="city" placeholder="Your City" minlength="2">
                </div>
              </div>
              @error('city')
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
                <label for="phone" class="col-sm-2 form-control-label"> Phone:</label>
                <div class="col-sm-8">
                  <input type="text" name="phone" class="form-control" id="phone" placeholder="Your Phone" minlength="2">
                </div>
              </div>
              @error('phone')
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
                <label for="address" class="col-sm-2 form-control-label"> Address:</label>
                <div class="col-sm-8">
                  <textarea class="form-control" name="address" rows="2" placeholder="Your Address"></textarea>
                </div>
              </div>
              @error('address')
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
                <div class="col-sm-offset-2 col-sm-8">
                  <input type="submit" class="btn btn-success btn-lg btn-block" id="submitForm" value="Sign Up Now" />
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
