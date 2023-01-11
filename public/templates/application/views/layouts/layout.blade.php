<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Meta -->
    <meta name="description" content="@yield('meta-description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>@yield('page-title')</title>

    @if(!empty(setting('image_icon')))
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset(setting('image_icon')) }}">
        @endif

    <!-- vendor css -->
    <link href="{{ tasset('lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ tasset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ tasset('lib/typicons.font/typicons.css') }}" rel="stylesheet">
    <link href="{{ tasset('lib/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
     <!-- azia CSS -->
    <link rel="stylesheet" href="{{ tasset('css/azia') }}">
    <link href="{{ asset('css/fix.css') }}" rel="stylesheet" />

        <!-- Start color cutomizations -->
    @if(optionActive('colors'))
            <style>
            @if(!empty(toption('colors','nav_bg')))
                .az-header {
                    background: #{{ toption('colors','nav_bg') }};
                }
            @endif

            @if(!empty(toption('colors','nav_text_color')))
                .az-header-menu .nav-item > .nav-link, .az-header-notification > a {
                    color: #{{ toption('colors','nav_text_color') }};
                }
            @endif

            @if(!empty(toption('colors','footer_bg')))
                .az-footer {
                    background: #{{ toption('colors','footer_bg') }};
                }
            @endif

            @if(!empty(toption('colors','footer_text_color')))
            .az-footer .container {
                color: #{{ toption('colors','footer_text_color') }};
            }
            @endif

            </style>
        @endif

    @yield('header')

        {!!  setting('general_header_scripts')  !!}
</head>
<body>

<div class="az-header">
    <div class="container">
        <div class="az-header-left">
            <a href="{{ url('/') }}" class="az-logo"><span></span>
                @if(!empty(setting('image_logo')))
                    <img src="{{ asset(setting('image_logo')) }}" class="navbar-brand-img" >
                @else
                    {{ setting('general_site_name') }}
                @endif
            </a>
            <a href="#" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
            <div class="az-header-menu-header">
                <a href="{{ url('/') }}" class="az-logo"><span></span>
                    @if(!empty(setting('image_logo')))
                        <img src="{{ asset(setting('image_logo')) }}" class="navbar-brand-img" >
                    @else
                        {{ setting('general_site_name') }}
                    @endif
                </a>
                <a href="#" class="close">&times;</a>
            </div><!-- az-header-menu-header -->
            <ul class="nav">
                @foreach(headerMenu() as $menu)

                <li class="nav-item">
                    <a href="{{ $menu['url'] }}" class="nav-link @if($menu['children']) with-sub @endif ">{{ $menu['label'] }}</a>
                   @if($menu['children'])
                    <nav class="az-menu-sub">
                        @foreach($menu['children'] as $childMenu)
                        <a href="{{ $childMenu['url'] }}" class="nav-link">{{ $childMenu['label'] }}</a>
                        @endforeach
                    </nav>
                   @endif

                </li>
                    @endforeach

            </ul>
        </div><!-- az-header-menu -->
        <div class="az-header-right">
            @if(false)
            <a href="#" class="az-header-search-link"><i class="fas fa-search"></i></a>
            <div class="az-header-message">
                <a href="app-chat.html"><i class="typcn typcn-messages"></i></a>
            </div><!-- az-header-message -->
            @endif

            @if(setting('order_enable_shortlist')==1)
            <div class="dropdown az-header-notification">
                <a href="#" @if(getCart()['total']>0) class="new" @endif title="@lang('site.your-shortlist')"><i class="fa fa-users"></i></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header mg-b-20 d-sm-none">
                        <a href="#" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <h6 class="az-notification-title">@lang('site.your-shortlist')</h6>
                    <p class="az-notification-text">{{ getCart()['total'] }} @lang('site.candidates')</p>
                    <div class="az-notification-list">
                        @foreach(getCart()['candidates'] as $candidate)
                        <div class="media new">
                            <div class="az-img-user">

                                @if(!empty($candidate->picture) && file_exists($candidate->picture))
                                    <img     src="{{ asset($candidate->picture) }}">
                                @elseif($candidate->gender=='m')
                                    <img     src="{{ asset('img/man.jpg') }}">
                                @else
                                    <img    src="{{ asset('img/woman.jpg') }}">
                                @endif


                            </div>
                            <div class="media-body">
                                <p><strong>{{ $candidate->display_name }}</strong></p>
                                <span>{{ getAge(\Illuminate\Support\Carbon::parse($candidate->date_of_birth)->timestamp) }}/{{ gender($candidate->gender) }}</span>
                                <a class="float-right"  onclick="return confirm('@lang('site.confirm-delete')')" href="{{ route('shortlist.remove',['candidate'=>$candidate->id]) }}" ><i class="fa fa-trash"></i></a>
                            </div><!-- media-body -->
                        </div><!-- media -->
                            @endforeach

                    </div><!-- az-notification-list -->
                    <div class="dropdown-footer"><a href="{{ route('shortlist') }}">@lang('site.view-shortlist')</a></div>
                </div><!-- dropdown-menu -->
            </div><!-- az-header-notification -->
                @endif
            @guest
            <div class="dropdown az-profile-menu">
                <a href="#" class="az-img-user"><img src="{{ asset('img/man.jpg') }}" alt=""></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header d-sm-none">
                        <a href="#" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="az-header-profile">
                        <div class="az-img-user">
                            <img src="{{ asset('img/man.jpg') }}" alt="">
                        </div><!-- az-img-user -->
                        <h6>@lang('site.my-account')</h6>
                        <span>@lang('site.login-register')</span>
                    </div><!-- az-header-profile -->

                    <a href="{{ route('login') }}" class="dropdown-item"><i class="fa fa-sign-in-alt"></i> @lang('site.login')</a>
                    @if(setting('general_enable_employer_registration')==1)
                    <a href="{{ route('register.employer') }}" class="dropdown-item"><i class="fa fa-user"></i> @lang('site.register'): @lang('site.employers')</a>
                   @endif
                    @if(setting('general_enable_candidate_registration')==1)
                    <a href="{{ route('register.candidate') }}" class="dropdown-item"><i class="fa fa-user-tie"></i> @lang('site.register'): @lang('site.candidates')</a>
                    @endif
                </div><!-- dropdown-menu -->
            </div>
            @else
                    <div class="dropdown az-profile-menu">
                        <a href="#" class="az-img-user"><img src="{{ userPic(Auth::user()->id) }}" alt=""></a>
                        <div class="dropdown-menu">
                            <div class="az-dropdown-header d-sm-none">
                                <a href="#" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                            </div>
                            <div class="az-header-profile">
                                <div class="az-img-user">
                                    <img src="{{ userPic(Auth::user()->id) }}" alt="">
                                </div><!-- az-img-user -->
                                <h6>{{ Auth::user()->name }}</h6>
                                <span>{{ roleName(Auth::user()->role_id) }}</span>
                            </div><!-- az-header-profile -->

                            <a href="{{ route('home') }}" class="dropdown-item"><i class="fa fa-sign-in-alt"></i> @lang('site.dashboard')</a>
                            <a href="{{ route('user.profile') }}" class="dropdown-item"><i class="fa fa-user"></i> @lang('site.my-profile')</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item"><i class="typcn typcn-power-outline"></i> @lang('site.sign-out')</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"  class="int_hide">
                                @csrf
                            </form>
                        </div><!-- dropdown-menu -->
                    </div>



                @endif




        </div><!-- az-header-right -->
    </div><!-- container -->
</div><!-- az-header -->

<div class="az-content az-content-dashboard">
    <div class="container">
        <div class="az-content-body">
            @yield('content')
        </div><!-- az-content-body -->
    </div>
</div><!-- az-content -->

@if(optionActive('footer'))
<div class="az-footer ht-40">
    <div class="container ht-100p pd-t-0-f">

            <span>{{ fullstop(toption('footer','credits')) }} {!! clean( credits() ) !!}</span>

    </div><!-- container -->
</div><!-- az-footer -->
@endif


<script src="{{ tasset('lib/jquery/jquery.min.js') }}"></script>
<script src="{{ tasset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ tasset('lib/ionicons/ionicons.js') }}"></script>
<script src="{{ tasset('lib/jquery.flot/jquery.flot.js') }}"></script>
<script src="{{ tasset('lib/jquery.flot/jquery.flot.resize.js') }}"></script>
<script src="{{ tasset('lib/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ tasset('lib/peity/jquery.peity.min.js') }}"></script>

<script src="{{ tasset('js/azia.js') }}"></script>
<script src="{{ tasset('js/chart.flot.sampledata.js') }}"></script>
<script src="{{ tasset('js/dashboard.sampledata.js') }}"></script>

@yield('footer')

{!!  setting('general_footer_scripts')  !!}
</body>

</html>
