@extends($templateLayout)
@section('page-title',setting('general_homepage_title'))
@section('meta-description',setting('general_homepage_meta_desc'))

@section('content')

    @if(optionActive('slideshow'))
        @php
        $count=0;
        @endphp
    <!-- Start Hero Area -->
    <section class="hero-area style2">
        <!-- Single Slider -->
        <div class="hero-inner">
            <div class="home-slider">
                @for($i=1;$i<=10;$i++)
                    @if(!empty(toption('slideshow','file'.$i)))

                    @section('header')
                        @parent

                        <style>
                            @if(!empty(toption('slideshow','heading_font_color'.$i)))

                                            .slhc{{ $i }}{
                                color: #{{ toption('slideshow','heading_font_color'.$i) }} !important;
                            }

                            @endif

                                        @if(!empty(toption('slideshow','text_font_color'.$i)))
                                        .sltx{{ $i }}{
                                color: #{{ toption('slideshow','text_font_color'.$i) }} !important;
                            }
                            @endif

                        </style>



                    @endsection


                    <div class="single-slider">
                    <div class="container">
                        <div class="row ">
                            <div class="col-lg-6 co-12">
                                <div class="inner-content">
                                    <div class="hero-text">
                                        @if(!empty(toption('slideshow','slide_heading'.$i)))
                                        <h1 class="wow fadeInUp slhc{{ $i }}" data-wow-delay=".3s">{!! clean(toption('slideshow','slide_heading'.$i))  !!}
                                        </h1>
                                        @endif

                                        @if(!empty(toption('slideshow','slide_text'.$i)))
                                        <p class="wow fadeInUp sltx{{ $i }}" data-wow-delay=".5s">{!! clean(toption('slideshow','slide_text'.$i))   !!}</p>
                                        @endif

                                        <div class="button wow fadeInUp" data-wow-delay=".7s">

                                            @if(!empty(toption('slideshow','button_1_text_'.$i)))
                                            <a href="{{ url(toption('slideshow','url_1_'.$i)) }}" class="btn">{{ toption('slideshow','button_1_text_'.$i) }}</a>
                                           @endif

                                            @if(!empty(toption('slideshow','button_2_text_'.$i)))
                                            <a href="{{ url(toption('slideshow','url_2_'.$i)) }}" class="btn btn-alt">{{ toption('slideshow','button_2_text_'.$i) }}</a>
                                            @endif
                                        </div>


                                    </div>
                                </div>
                            </div>
                            @if(!empty(toption('slideshow','file'.$i)))
                            <div class="col-lg-6 co-12">
                                <div class="hero-image wow fadeInRight" data-wow-delay=".4s">
                                    <img src="{{ asset(toption('slideshow','file'.$i)) }}" alt="#">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                        @php
                        $count++;
                        @endphp
                    @endif
                @endfor
            </div>
        </div>
        <!--/ End Single Slider -->
    </section>
    <!--/ End Hero Area -->

        @section('footer')
            @parent
            <script>
                //======== Home Slider
                var slider = new tns({
                    container: '.home-slider',
                    slideBy: 'page',
                    autoplay: true,
                    autoplayButtonOutput: false,
                    mouseDrag: true,
                    gutter: 0,
                    items: 1,
                    nav: false,
                    controls: true,
                    controlsText: [
                        '<i class="lni lni-arrow-left prev"></i>',
                        '<i class="lni lni-arrow-right next"></i>'
                    ],
                    responsive: {
                        1200: {
                            items: 1,
                        },
                        992: {
                            items: 1,
                        },
                        0: {
                            items: 1,
                        }

                    }
                });
            </script>
        @endsection

    @endif

    @if(optionActive('order-prompt'))
    <!-- Start Call Action Area -->
    <section class="call-action style2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="text">
                        <h2>{{ toption('order-prompt','text') }}</h2>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="button">
                        <a href="{{ route('order-forms') }}" class="btn"><i class="lni lni-add-files"></i> {{ __t('place-order') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /End Call Action Area -->
    @endif

    @if(optionActive('homepage-about'))
    <!-- Start About Area -->
    <section class="about-us section">
        <div class="container">
            <div class="row align-items-center_ justify-content-center">
                <div class="col-lg-6 col-md-10 col-12">
                    <div class="content-left wow fadeInLeft" data-wow-delay=".3s">
                        <div calss="row">
                            <div calss="col-lg-6 col-12">
                                <div class="row">
                                    @if(!empty(toption('homepage-about','image_1')))
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <img class="single-img" src="{{ toption('homepage-about','image_1') }}" alt="#">
                                    </div>
                                    @endif

                                    @if(!empty(toption('homepage-about','image_2')))
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <img class="single-img mt-50" src="{{ toption('homepage-about','image_2') }}" alt="#">
                                    </div>
                                    @endif

                                </div>
                            </div>
                            <div calss="col-lg-6 col-12">
                                <div class="row">

                                    @if(!empty(toption('homepage-about','image_3')))
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <img class="single-img" src="{{ toption('homepage-about','image_3') }}" alt="#">
                                    </div>
                                    @endif

                                    @if(!empty(toption('homepage-about','image_4')))
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <img class="single-img mt-50" src="{{ toption('homepage-about','image_4') }}" alt="#">
                                    </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-10 col-12">
                    <!-- content-1 start -->
                    <div class="content-right wow fadeInRight" data-wow-delay=".5s">
                        <!-- Heading -->
                        <h2>{{ toption('homepage-about','heading') }}</h2>
                        <p>{!! toption('homepage-about','text') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->
    @endif

    @if(optionActive('candidates'))
    <!-- Start Job Category Area -->
    <section class="job-category style2 section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <span class="wow fadeInDown" data-wow-delay=".2s">{{ toption('candidates','sub_heading') }}</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ toption('candidates','heading') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{{ toption('candidates','text') }}</p>
                    </div>
                </div>
            </div>
            <div class="cat-head">
                <div class="row">
                    @php

                    if(toption('candidates','order')=='r'){
                        $candidates = \App\User::where('role_id',3)->inRandomOrder();
                    }
                    else{
                        $candidates = \App\User::where('role_id',3)->latest();
                    }


                    $candidates = $candidates->limit((toption('candidates','candidate_limit')==0? 5:toption('candidates','candidate_limit')));
                    $candidates = $candidates->whereHas('candidate',function($query){
                        $query->where('public',1);
                    });
                    $candidates = $candidates->get();
                    @endphp
                    @foreach($candidates as $item)
                    <div class="col-lg-3 col-md-6 col-12">
                        <a href="{{ route('profile',['candidate'=>$item->candidate->id]) }}" class="single-cat wow fadeInUp" data-wow-delay=".2s">
                            <div class="top-side">
                                @if(!empty($item->candidate->picture) && file_exists($item->candidate->picture))
                                    <img  class=" img-fluid"    src="{{ asset($item->candidate->picture) }}" >
                                @elseif($item->candidate->gender=='m')
                                    <img class="img-fluid" src="{{ asset('img/man.jpg') }}">
                                @else
                                    <img class="img-fluid" src="{{ asset('img/woman.jpg') }}">
                                @endif
                            </div>
                            <div class="bottom-side">
                                <span class="available-job">{{ getAge(\Illuminate\Support\Carbon::parse($item->candidate->date_of_birth)->timestamp) }}/{{ gender($item->candidate->gender) }}</span>
                                <h3>{{ $item->candidate->display_name }}</h3>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- /End Job Category Area -->
    @endif

    @if(optionActive('candidate-prompt'))
        @if(!empty(toption('candidate-prompt','bg_color')))
            @section('header')
                @parent
                <style>
                    .call-action.overlay::before {
                        background-color: #{{ toption('candidate-prompt','bg_color') }};
                    }
                </style>
            @endsection
        @endif
    <!-- Start Call Action Area -->
    <section class="call-action overlay section">
        <div class="container">
            <div class="row ">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="inner">
                        <div class="section-title">
                            <span class="wow fadeInDown" data-wow-delay=".2s">{{ toption('candidate-prompt','sub_heading') }}</span>
                            <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ toption('candidate-prompt','heading') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay=".6s">{{ toption('candidate-prompt','text') }}</p>
                            <div class="button wow fadeInUp" data-wow-delay=".8s">
                                <a href="{{ route('register.candidate') }}" class="btn"><i class="lni lni-user"></i> {{ __t('create-profile') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /End Call Action Area -->
    @endif

    @if(optionActive('vacancies'))
    <!-- Start Find Job Area -->
    <section class="find-job section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <span class="wow fadeInDown" data-wow-delay=".2s">{{ toption('vacancies','sub_heading') }}</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ toption('vacancies','heading') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{{ toption('vacancies','text') }}</p>
                    </div>
                </div>
            </div>
            <div class="single-head">
                <div class="row">



                        @php
                            $vacancies = \App\Vacancy::limit((toption('vacancies','limit')==0? 5:toption('vacancies','limit')));
                           $vacancies = $vacancies->where('active',1)->where(function($q){
            $q->where('closes_at','>',\Illuminate\Support\Carbon::now()->toDateTimeString())->orWhere('closes_at','');
        })->get();


                        @endphp
                         @foreach($vacancies as $vacancy)

                            <div class="col-lg-6 col-12">


                        <!-- Single Job -->
                        <div class="single-job wow fadeInUp pl-4 pr-4" data-wow-delay=".3s">
                            <div class="job-content">
                                <h4><a href="{{ route('view-vacancy',['vacancy'=>$vacancy->id]) }}">{{ $vacancy->title }}</a></h4>
                                <p>{{ limitLength(strip_tags($vacancy->description),200) }}</p>
                                <ul>
                                    <li><i class="lni lni-money-protection"></i> {{ $vacancy->salary }}</li>
                                    <li><i class="lni lni-map-marker"></i> {{ $vacancy->location }}</li>
                                    <li><i class="lni lni-calendar"></i> @lang('site.closes-on') {{ \Illuminate\Support\Carbon::parse($vacancy->closes_at)->format('d/M/Y') }}</li>
                                </ul>
                            </div>
                            <div class="job-button">
                                <ul>
                                    <li><a href="{{ route('view-vacancy',['vacancy'=>$vacancy->id]) }}">{{ __lang('details') }}</a></li>
                                    <li><a class="apply_button" href="{{ route('candidate.vacancy.apply',['vacancy'=>$vacancy->id]) }}">{{ __t('apply') }}</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Job -->
                    </div>

                             @endforeach




                </div>
                <!-- Pagination -->
                <div class="row">
                    <div class="col-12 text-center mt-5">
                        <div class="button" data-wow-delay=".3s">
                            <a href="{{ route('vacancies') }}" class="btn">{{ __t('view-jobs') }}</a>
                        </div>
                    </div>
                </div>
                <!--/ End Pagination -->
            </div>
        </div>
    </section>
    <!-- /End Find Job Area -->
    @endif

    @if(optionActive('testimonials'))
    <!-- Start Testimonials Section -->
    <section class=" testimonials">
        <img class="patern1 wow fadeInRight" data-wow-delay=".3s" src="{{ tasset('assets/images/testimonial/patern1.png') }}" alt="#">
        <img class="patern2 wow fadeInLeft" data-wow-delay=".5s" src="{{ tasset('assets/images/testimonial/patern1.png') }}" alt="#">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="section-title align-left wow fadeInLeft" data-wow-delay=".3s">
                        <span>{{ toption('testimonials','sub_heading') }}</span>
                        <h2>{{ toption('testimonials','heading') }}</h2>
                    </div>
                    <div class=" testimonial-inner-head wow fadeInLeft" data-wow-delay=".3s">
                        <div class=" testimonial-inner">
                            <div class="testimonial-slider">
                            @for($i=1;$i <= 6; $i++)
                                @if(!empty(toption('testimonials','name'.$i)))
                                <!-- Single Testimonial -->
                                <div class="single-testimonial">
                                    <div class="quote">
                                        <i class="lni lni-quotation"></i>
                                    </div>
                                    <p>"{{ toption('testimonials','text'.$i) }}" </p>
                                    <div class="bottom">
                                        <div class="clien-image">
                                            @if(!empty(toption('testimonials','image'.$i)))
                                                <img  src="{{ asset(toption('testimonials','image'.$i)) }}" >
                                            @else
                                                <img   src="{{ asset('img/man.jpg') }}">
                                            @endif

                                        </div>
                                        <h4 class="name">{{ toption('testimonials','name'.$i) }} <span>{{ toption('testimonials','role'.$i) }}</span></h4>
                                    </div>
                                </div>
                                <!--/ End Single Testimonial -->

                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                @if(!empty(toption('testimonials','image')))
                <div class="col-lg-6 col-12">
                    <div class="testimonial-right wow fadeInRight" data-wow-delay=".5s">
                        <img src="{{ asset(toption('testimonials','image')) }}" alt="#">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- /End Testimonials Section -->
        @section('footer')
            @parent
            <script>
                //========= testimonial
                tns({
                    container: '.testimonial-slider',
                    items: 1,
                    slideBy: 'page',
                    autoplayButtonOutput: false,
                    autoplay: true,
                    mouseDrag: true,
                    gutter: 0,
                    nav: false,
                    controls: true,
                    controlsText: ['<i class="lni lni-arrow-left"></i>', '<i class="lni lni-arrow-right"></i>'],
                    responsive: {
                        0: {
                            items: 1,
                        },
                        540: {
                            items: 1,
                        },
                        768: {
                            items: 1,
                        },
                        992: {
                            items: 1,
                        },
                        1170: {
                            items: 1,
                        }
                    }
                });
            </script>
        @endsection
    @endif

    @if(optionActive('blog'))
    <!-- Start Latest News Area -->
    <div class="latest-news-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <span class="wow fadeInDown" data-wow-delay=".2s">{{ toption('blog','sub_heading') }}</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ toption('blog','heading') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">{{ toption('blog','text') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(\App\BlogPost::whereDate('publish_date','<=',\Illuminate\Support\Carbon::now()->toDateTimeString())->where('status',1)->orderBy('publish_date','desc')->limit(intval(toption('blog','limit')))->get() as $post)

                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single News -->
                    <div class="single-news wow fadeInUp" data-wow-delay=".3s">
                        @if(!empty($post->cover_photo))
                        <div class="image">
                            <img class="thumb" src="{{ asset($post->cover_photo) }}" alt="#">
                        </div>
                        @endif
                        <div class="content-body">
                            <h4 class="title"><a href="{{ route('blog.post',['blogPost'=>$post->id]) }}">{{ $post->title }}</a></h4>
                            <div class="meta-details">
                                <ul>
                                    <li><a href="#"><i class="lni lni-calendar"></i> {{  \Carbon\Carbon::parse($post->publish_date)->format('F d, Y') }}</a></li>
                                    @if($post->user)
                                    <li><a href="#"><i class="lni lni-user"></i> {{ $post->user->name }}</a></li>
                                    @endif
                                </ul>
                            </div>
                            <p>{{ limitLength(strip_tags($post->content),200) }}</p>
                            <div class="button">
                                <a href="{{ route('blog.post',['blogPost'=>$post->id]) }}" class="btn">{{ __t('read-more') }}</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single News -->
                </div>

                @endforeach
            </div>
        </div>
    </div>
    <!-- End Latest News Area -->
    @endif

    @if(optionActive('clients'))
    <!-- Start Clients Area -->
    <div class="client-logo-section">
        <div class="container">
            <div class="client-logo-wrapper">
                <div class="client-logo-carousel d-flex align-items-center justify-content-between">
                    @for($i=1;$i <= 9; $i++)
                    @if(!empty(toption('clients','file'.$i)))
                    <div class="client-logo">
                        <img src="{{ toption('clients','file'.$i) }}" alt="#">
                    </div>
                        @endif
               @endfor
                </div>
            </div>
        </div>
    </div>
    <!-- End Clients Area -->
        @section('footer')
            @parent
            <script>
                //====== Clients Logo Slider
                tns({
                    container: '.client-logo-carousel',
                    slideBy: 'page',
                    autoplay: true,
                    autoplayButtonOutput: false,
                    mouseDrag: true,
                    gutter: 15,
                    nav: false,
                    controls: false,
                    responsive: {
                        0: {
                            items: 1,
                        },
                        540: {
                            items: 2,
                        },
                        768: {
                            items: 3,
                        },
                        992: {
                            items: 4,
                        },
                        1170: {
                            items: 6,
                        }
                    }
                });
            </script>
        @endsection

    @endif


@endsection

@section('header')
    <link rel="stylesheet" href="{{ asset('css/templates/bhome.css') }}">
@endsection

@section('footer')


@endsection
