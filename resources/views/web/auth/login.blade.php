@extends('web.layouts.layout')
{{-- @section('title')

@endsection --}}


@section('main')


<div class="content-area">

    <div class="login-page">
        <div class="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-center">Sign In Your Account</h2>
                    <form method="post" class="cmxform" action="{{route("login")}}" id="loginForm">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 form-control-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email"  />
                            </div>
                        </div>

                        @error('email')
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10" >
                                <span class="invalid-feedback text-danger" role="alert">
                                  <strong> {{ $message }} </strong>
                                </span>
                            </div>
                        </div>
                        @enderror

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 form-control-label">Password:</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password"  />
                            </div>
                        </div>

                        @error('password')
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10" >
                                <span class="invalid-feedback text-danger" role="alert">
                                  <strong> {{ $message }} </strong>
                                </span>
                            </div>
                        </div>
                        @enderror

                        <div class="form-group row col-sm-offset-2">

                            <input type="checkbox" id="remember" name="remember_me" />
                            <label for="remember" style="color:#093; font-weight: normal"><span style="opacity:.5"></span>Remember Me</label><br />
                        </div>



                        <div class="form-group row">
                            <div class="col-sm-offset-2 col-sm-8">
                                <input type="submit" class="btn btn-success btn-lg btn-block" id="submitForm" value="Sign In" />
                            </div>
                        </div>

                        <div class="forget">
                            <p class="pull-left"><a href="{{url("forgot-password")}}">Forgot Password</a></p>
                            <p class="pull-right">Not a memeber yet..
                                <a href="{{route("register")}}">Create a new account</a>
                            </p>
                            <div class="clearfix"></div>
                        </div>

                    </form>




                </div>
            </div> <!--End Row-->

        </div>
    </div> <!--End Registration page div-->

</div> <!-- End content Area class -->


@endsection
