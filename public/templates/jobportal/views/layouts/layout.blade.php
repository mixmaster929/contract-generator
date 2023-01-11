<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('page-title')</title>
    <meta name="description" content="@yield('meta-description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
@if(!empty(setting('image_icon')))
    <!--====== Favicon Icon ======-->
        <link rel="shortcut icon" href="{{ asset(setting('image_icon')) }}" type="image/png">
@endif
    <!-- Place favicon.ico in the root directory -->

    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ tasset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ tasset('assets/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ tasset('assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ tasset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ tasset('assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ tasset('assets/css/main') }}" />

    @yield('header')
    {!!  setting('general_header_scripts')  !!}

    @if(optionActive('navigation'))
        <style>
            @if(!empty(toption('navigation','bg_color')))
                .navbar-area{
                background-color: #{{ toption('navigation','bg_color') }};
            }
            @endif

                     @if(!empty(toption('navigation','font_color')))
                .navbar-nav .nav-item a:hover, .navbar-nav .nav-item a.active,.navbar-nav .nav-item a,.header .button .login{
                color: #{{ toption('navigation','font_color') }};
            }
            @endif

        </style>
    @endif
    <style>
        @if(optionActive('footer'))

            @if(!empty(toption('footer','image')))

                   .footer .footer-middle {
            background: url({{ toption('footer','image') }});
        }

        @endif

            @if(!empty(toption('footer','bg_color')))

            .footer .footer-middle, .footer .footer-bottom {
            background-color: #{{ toption('footer','bg_color') }};
        }

        @endif

            @if(!empty(toption('footer','font_color')))
        .footer .f-about p, .footer .f-link ul li a, .footer .single-footer h3, .footer .footer-bottom .inner .right ul li a, .footer .footer-bottom .inner p, .footer .footer-bottom a, .footer .f-about .contact-address li span, .footer .f-about .contact-address li, .footer .f-about .contact-address li a{
            color: #{{ toption('footer','font_color') }};
        }
        @endif

        @endif



            @if(optionActive('page-title'))

            @if(!empty(toption('page-title','image')))
                .breadcrumbs{
            background-image: url("{{ asset(toption('page-title','image')) }}");
                }
            @endif

                @if(!empty(toption('page-title','bg_color')))
                        .breadcrumbs, .breadcrumbs.overlay::before {
                background-color: #{{ toption('page-title','bg_color') }} ;
            }
            @endif

                 @if(!empty(toption('page-title','font_color')))
                    .breadcrumbs .breadcrumbs-content .page-title{
            color: #{{ toption('page-title','font_color') }};
        }
        @endif

        @endif
    </style>
</head>

<body>
<!--[if lte IE 9]>
<p class="browserupgrade">
    {!! clean(__t('browser-warning')) !!}
</p>
<![endif]-->

<div id="loading-area"></div>

<!-- Start Header Area -->
<header class="header">
    <div class="navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand logo" href="{{ url('/') }}">
                            @if(!empty(setting('image_logo')))
                            <img class="logo1" src="{{ asset(setting('image_logo')) }}" alt="{{ setting('general_site_name') }}" />
                            @else
                                {{ setting('general_site_name') }}
                            @endif

                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">


                                @foreach(headerMenu() as $menu)
                                    <li class="nav-item">
                                        <a  @if(url()->full()==$menu['url'])  class="active"  @endif   href="{{ $menu['url'] }}" >{{ $menu['label'] }}</a>
                                        @if($menu['children'])
                                            <ul class="sub-menu">
                                                @foreach($menu['children'] as $childMenu)
                                                    <li><a href="{{ $childMenu['url'] }}" >{{ $childMenu['label'] }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <!-- navbar collapse -->
                        <div class="button">

                            @guest
                                <a href="{{ route('login') }}"  class="login"><i
                                    class="lni lni-lock-alt"></i> {{ __lang('login') }}<span class="d-none d-md-block">/{{ __lang('register') }}</span></a>
                            @else
                                <a href="{{ route('home') }}"  class="login"><i
                                        class="lni lni-user"></i> {{ __t('account') }}</a>
                            @endif

                            @if(toption('navigation','order_button')==1)
                            <a href="{{ route('order-forms') }}" class="btn"> <i
                                    class="lni lni-add-files "></i> <span class="d-none d-md-inline-block">{{ __t('order-now') }}</span> <span class="d-md-none">{{ __lang('order') }}</span></a>
                            @endif

                        </div>
                    </nav>
                    <!-- navbar -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- navbar area -->
</header>
<!-- End Header Area -->

@hasSection('inline-title')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs overlay">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">@yield('inline-title')</h1>
                    </div>
                    @hasSection('crumb')
                    <ul class="breadcrumb-nav">
                        <li><a href="@route('homepage')">@lang('site.home')</a></li>
                        @yield('crumb')
                    </ul>
                        @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
@endif



@yield('content')


<!-- Start Footer Area -->
<footer class="footer">

    @if(optionActive('footer-top'))
    <div class="footer-top">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-12">
                    <div class="download-text">
                        <h3>{{ toption('footer-top','heading') }}</h3>
                        <p>{!! clean(toption('footer-top','text')) !!}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="download-button">
                        <div class="button">
                            @if(toption('footer-top','profile_button')==1)
                            <a class="btn" href="{{ route('profiles') }}"><i class="lni lni-users"></i> {{ __t('browse-profiles') }}</a>
                            @endif

                            @if(toption('footer-top','order_button')==1)
                            <a class="btn" href="{{ route('order-forms') }}"><i class="lni lni-add-files"></i> {{ __t('place-order') }}</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Start Middle Top -->
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="f-about single-footer">
                        <div class="logo">
                            <a href="{{ url('/') }}">

                                @if(!empty(setting('image_logo')))
                                    <img  src="{{ asset(setting('image_logo')) }}" alt="{{ setting('general_site_name') }}" />
                                @else
                                    {{ setting('general_site_name') }}
                                @endif

                            </a>
                        </div>
                        <p>{{ toption('footer','text') }}</p>

                        <div class="footer-social">
                            <ul>
                                @if(!empty(toption('footer','social_facebook')))
                                <li><a href="{{ toption('footer','social_facebook') }}"><i class="lni lni-facebook-original"></i></a></li>
                                @endif
                                @if(!empty(toption('footer','social_twitter')))
                                <li><a href="{{ toption('footer','social_twitter') }}"><i class="lni lni-twitter-original"></i></a></li>
                                @endif
                                @if(!empty(toption('footer','social_linkedin')))
                                <li><a href="{{ toption('footer','social_linkedin') }}"><i class="lni lni-linkedin-original"></i></a></li>
                                @endif
                                @if(!empty(toption('footer','social_youtube')))
                                <li><a href="{{ toption('footer','social_youtube') }}"><i class="lni lni-youtube"></i></a></li>
                                @endif
                                @if(!empty(toption('footer','social_instagram')))
                                <li><a href="{{ toption('footer','social_instagram') }}"><i class="lni lni-instagram-original"></i></a></li>
                                @endif

                            </ul>
                        </div>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-8 col-12">
                    <div class="row">
                        @foreach(footerMenu() as $menu)
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>{{ $menu['label'] }}</h3>
                                @if($menu['children'])
                                <ul>
                                    @foreach($menu['children'] as $childMenu)
                                    <li><a href="{{ $childMenu['url'] }}">{{ $childMenu['label'] }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        @endforeach

                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer newsletter">
                                <h3>@lang('site.contact-us')</h3>
                                <div class="f-about single-footer">
                                    <ul class="contact-address">
                                        @if(!empty(setting('general_address')))
                                        <li><span><i class="lni lni-map-marker"></i></span> {{ setting('general_address') }}</li>
                                        @endif
                                        @if(!empty(setting('general_contact_email')))
                                        <li><span><i class="lni lni-envelope"></i></span> <a href="mailto:{!! clean( setting('general_contact_email') ) !!}">{!! clean( setting('general_contact_email') ) !!}</a></li>
                                        @endif
                                        @if(!empty(setting('general_tel')))
                                        <li><span><i class="lni lni-phone"></i></span> {{ setting('general_tel') }}</li>
                                        @endif


                                    </ul>
                                </div>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Middle -->
    <!-- Start Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="left">
                            <p>{!! clean( toption('footer','credits') ) !!} </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"  class="int_hide">
                            @csrf
                        </form>
                        <div class="right">
                            <ul>
                                @guest
                                <li><a href="{{ route('login') }}">@lang('site.login-register')</a></li>
                                @else
                                    <li>
                                        <a href="{{ route('home') }}">@lang('site.my-account')</a>
                                    </li>
                                    <li>
                                        <a  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" >@lang('site.logout')</a>
                                    </li>
                                @endif

                                <li><a href="{{ route('contact') }}">{{ __lang('contact') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Middle -->
</footer>
<!--/ End Footer Area -->


<!-- ========================= scroll-top ========================= -->
<a href="#" class="scroll-top btn-hover">
    <i class="lni lni-chevron-up"></i>
</a>

<!-- ========================= JS here ========================= -->
<script src="{{ tasset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ tasset('assets/js/wow.min.js') }}"></script>
<script src="{{ tasset('assets/js/tiny-slider.js') }}"></script>
<script src="{{ tasset('assets/js/glightbox.min.js') }}"></script>
<script src="{{ tasset('assets/js/main.js') }}"></script>

@yield('footer')
{!!  setting('general_footer_scripts')  !!}

</body>

</html>
