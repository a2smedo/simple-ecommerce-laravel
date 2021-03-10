<div class="top-header">
    <div class="top-header-left pull-left">
      <a href="{{ url('/products') }}"> {{ __('main.upto') }} </a>
    </div>
    <div class="top-header-right pull-right">
      <div class="container-fluid">
        <ul>



          @guest
            <li class="top-header-list">
              {{-- <i class="fa fa-credit-card"></i> --}}
              <a href="{{ url('register') }}">
                <span class="icon"><i class="fa fa-user-plus"></i></span>
                {{ __('main.signup') }}
              </a>
            </li>
            <li class="top-header-list">
              <a href="{{ url('login') }}">
                <span class="icon"><i class="fa fa-sign-in"></i></span>
                {{ __('main.signin') }}
              </a>
            </li>
          @endguest

          <li><a href=" {{ url('lang/set/en') }}">English</a></li>
          <li><a href=" {{ url('lang/set/ar') }}">العربية</a></li>




          {{-- <li class="top-header-list"><a href="faq.html">
              <span class="icon"><i class="fa fa-question-circle"></i></span>
              helps
            </a>
          </li> --}}
        </ul>
      </div>
    </div>
    <div class="clear"></div>
  </div>
