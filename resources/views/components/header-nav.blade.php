<div class="header-navigation">
    <div class="wsmenucontainer clearfix">
      <div class="overlapblackbg"></div>
      <div class="wsmobileheader clearfix"> <a href="#" id="wsnavtoggle" class="animated-arrow"><span></span></a> <a
          class="smallogo"><img src="{{asset('web/images/logo.png')}}" alt=""></a></div>


      <div class="headerfull">
        <!--Main Menu HTML Code-->
        <div class="wsmain">
          <nav class="wsmenu clearfix">
            <ul class="mobile-sub wsmenu-list">
              <li><span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href="javascript:;"
                  class="navtext"><span> {{ __('main.shopBy') }} </span> <span>{{ __('main.department') }} </span></a>
                <div class="wsshoptabing wtsdepartmentmenu clearfix">
                  <div class="wsshopwp clearfix" style="height: 421px;">
                    <ul class="wstabitem clearfix">

                      @foreach ($departments as $department)

                        <li class=""><span class="wsmenu-click02"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a
                            href="javscript:;">
                            {{-- @if ($cat->name == " men's")
                              <i class="fa fa-male"></i>
                            @endif
                            {{ url("categories/show/{$cat->id}/{$cat->name}") }}

                            @if ($cat->name == " women's")
                              <i class="fa fa-female"></i>
                            @endif --}}
                            {{ $department->name() }}
                          </a>
                          <div class="wstitemright clearfix wstitemrightactive" style="height: auto;">

                            <div class="wstmegamenucoll clearfix">


                              {{-- <div class="wstheading">Women's Clothing</div> --}}
                              @foreach ($department->categories as $cat)
                                <div class="wstheading">
                                  {{ $cat->name() }}
                                </div>

                                @foreach ($cat->subcategories as $subCat)
                                  <ul class="wstliststy01">
                                    <li><a href="{{ url("/sub-categories/show/$subCat->id") }}"> {{ $subCat->name() }} <span
                                          class="wstmenutag greentag">New</span></a></li>
                                  </ul>
                                @endforeach


                              @endforeach


                            </div>
                          </div>
                        </li>


                      @endforeach

                    </ul>
                  </div>
                </div>
              </li>





              {{-- <li class="wssearchbar clearfix">
                <form class="topmenusearch">
                  <input placeholder="Search Product By Name, Category...">
                  <button class="btnstyle"><i class="searchicon fa fa-search" aria-hidden="true"></i></button>
                </form>
              </li> --}}



              @auth
                <li class="wsshopmyaccount clearfix">

                  <span class="wsmenu-click">
                    <i class="wsmenu-arrow fa fa-angle-down"></i>
                  </span>
                  <a href="javascript:void(0); " class="wtxaccountlink">
                    <i class="fa fa-align-justify"></i>

                    {{ Auth::user()->name }}

                    <i class="fa  fa-angle-down"></i>
                  </a>
                  <ul class="wsmenu-submenu">
                    {{-- <li><a href=""><i class="fa fa-user"></i></a></li> --}}



                    @if (Auth::user()->rule->name == 'superadmin' or Auth::user()->rule->name == 'admin')
                      <li><a href="{{url("/dashboard")}}"><i class="fa fa-user"></i> {{ __('main.dashboard') }} </a></li>

                    @else
                      <li><a href="#"><i class="fa fa-user"></i> {{ __('main.profile') }} </a></li>
                      <li><a href="{{ url('/wishlist') }}"><i class="fa fa-heart"></i>{{ __('main.wishlist') }}</a></li>
                    @endif




                    <li>
                      <form style="display: none" action="{{ route('logout') }}" method="post" id="logoutForm">
                        @csrf
                      </form>
                      <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                        <i class="fa fa-sign-out"></i>
                        {{ __('main.signout') }}
                      </a>
                    </li>
                  @endauth
                </ul>
              </li>
            </ul>
          </nav>

        </div>
        <!--Menu HTML Code-->

      </div>
    </div>

  </div> <!-- End Navigation header -->
