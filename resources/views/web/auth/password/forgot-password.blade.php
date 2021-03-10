@extends('web.layouts.layout')
{{-- @section('title')

@endsection --}}


@section('main')


<div class="content-area">

    <div class="login-page">
        <div class="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-center">Reset Password</h2>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif

                    <form method="post" class="cmxform" action="{{route("password.request")}}" id="loginForm">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 form-control-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email"  />
                            </div>
                        </div>

                        @error('email')
                        <div class="row mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10" >
                                <span class="invalid-feedback text-danger" role="alert">
                                  <strong> {{ $message }} </strong>
                                </span>
                            </div>
                        </div>
                        @enderror


                        <div class="form-group row ">
                            <div class="col-sm-offset-2 col-sm-8">
                                <input type="submit" class="btn btn-success btn-lg btn-block" id="submitForm" value="Reset" />
                            </div>
                        </div>

                    </form>




                </div>
            </div> <!--End Row-->

        </div>
    </div> <!--End Registration page div-->

</div> <!-- End content Area class -->


@endsection
