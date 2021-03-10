@extends('web.layouts.layout')
{{-- @section('title')

@endsection --}}


@section('main')


  <div class="content-area">

    <div class="login-page">
      <div class="container">

        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center">Verify Email </h2>

            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif


            <form method="post" class="cmxform" action="{{ route('verification.send') }}" id="">
              @csrf
              <div class="form-group row">
                <div class="col-sm-offset-2 col-sm-8">
                  <input type="submit" class="btn btn-success btn-lg btn-block" id="submitForm" value="Resend email" />
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
