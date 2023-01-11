@extends($templateLayout)
@section('page-title',setting('general_homepage_title'))
@section('meta-description',setting('general_homepage_meta_desc'))

@section('content')
    @if(optionActive('slideshow'))
        <?php
        $count=0;
        ?>
    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="slider-active">
            @for($i=1;$i<=10;$i++)
                @if(!empty(toption('slideshow','file'.$i)))

                <div class="single-slider slider-height d-flex align-items-center" data-background="{{ asset(toption('slideshow','file'.$i)) }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-8">
                            <div class="hero__caption">
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
                                @if(!empty(toption('slideshow','slide_heading'.$i)))
                                <p  @if(!empty(toption('slideshow','heading_font_color'.$i))) class="slhc{{ $i }}" @endif data-animation="fadeInLeft" data-delay=".4s">{{ toption('slideshow','slide_heading'.$i) }}</p>
                                @endif

                                @if(!empty(toption('slideshow','slide_text'.$i)))
                                <h1 @if(!empty(toption('slideshow','text_font_color'.$i))) class="sltx{{ $i }}" @endif  data-animation="fadeInLeft" data-delay=".6s" >{{ toption('slideshow','slide_text'.$i) }}</h1>
                                @endif

                                @if(!empty(toption('slideshow','button_text'.$i)))
                                <!-- Hero-btn -->
                                <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s">
                                    <a  href="{{ toption('slideshow','url'.$i) }}" class="btn hero-btn">{{ toption('slideshow','button_text'.$i) }}</a>
                                </div>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <?php
                    $count++;
                    ?>
                @endif
            @endfor


        </div>
    </div>
    <!-- slider Area End-->
    @endif


    @if(optionActive('homepage-services'))
    <!-- Team-profile Start -->
    <div class="team-profile team-padding">
        <div class="container">
            <div class="row">

                <?php
                $count=0;
                ?>

                    @for($i=1;$i<=2;$i++)
                        @if(!empty(toption('homepage-services','file'.$i)))
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-profile mb-30">
                        <!-- Front -->
                        <div class="single-profile-front">
                            <div class="profile-img">
                                <img src="{{ asset(toption('homepage-services','file'.$i)) }}" alt="">
                            </div>
                            <div class="profile-caption">
                                <h4><a href="#">{{ toption('homepage-services','heading'.$i) }}</a></h4>
                                <p>
                                    {!! clean( toption('homepage-services','text'.$i) ) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                        @endif
                    @endfor

                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-profile mb-30">
                        <!-- Back -->
                        <div class="single-profile-back-last">
                            <h2>{{ toption('homepage-services','info_heading') }}</h2>
                            <p>{!! clean( toption('homepage-services','info_text') ) !!}</p>
                            <a href="{{ toption('homepage-services','url')  }}">{{ toption('homepage-services','button_text') }} »</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Team-profile End-->
    @endif

    @if(optionActive('homepage-about'))
    <!-- We Trusted Start-->
    <div class="we-trusted-area trusted-padding">
        <div class="container">
            <div class="row d-flex align-items-end">
                @if(!empty(toption('homepage-about','image')))
                <div class="col-xl-7 col-lg-7">
                    <div class="trusted-img">
                        <img src="{{ asset(toption('homepage-about','image')) }}" alt="">
                    </div>
                </div>
                @endif

                <div class="col-xl-5 col-lg-5">
                    <div class="trusted-caption">
                        <h2>{{ toption('homepage-about','heading') }}</h2>
                        <p>{!! clean( toption('homepage-about','text') ) !!}</p>
                        <a href="{{ toption('homepage-about','button_url') }}" class="btn trusted-btn">{{ toption('homepage-about','button_text') }}</a>
                    </div>
                </div>


            </div>
        </div>

    </div>
    <!-- We Trusted End-->
    @endif

    @if(optionActive('candidates'))

        <?php

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
        ?>



        <!-- Testimonial Start -->
        <div class="testimonial-area fix blue-bg" >
            <div class="container">
                <div class="row mt-60 mb-20">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <h2>{{ toption('candidates','heading') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="h1-testimonial-active" id="candidateslide">

                        @foreach($candidates as $item)
                            <!-- Single Testimonial -->
                            <div class="single-testimonial pt-40 int_mrl50"  >
                                <!-- Testimonial tittle -->
                                <div class="testimonial-icon mb-30">
                                    <a href="{{ route('profile',['candidate'=>$item->candidate->id]) }}">
                                    @if(!empty($item->candidate->picture) && file_exists($item->candidate->picture))
                                        <img  class=" ani-btn img-fluid"    src="{{ asset($item->candidate->picture) }}">
                                    @elseif($item->candidate->gender=='m')
                                        <img      class=" ani-btn img-fluid"     src="{{ asset('img/man.jpg') }}">
                                    @else
                                        <img      class=" ani-btn img-fluid"        src="{{ asset('img/woman.jpg') }}">
                                    @endif
                                    </a>
                                </div>
                                <!-- Testimonial Content -->
                                <div class="testimonial-caption_ text-center">

                                    <div class="rattiong-caption">
                                        <span>{{ $item->candidate->display_name }}<span> <br/> {{ getAge(\Illuminate\Support\Carbon::parse($item->candidate->date_of_birth)->timestamp) }}/{{ gender($item->candidate->gender) }}</span> </span>
                                    </div>
                                    @if(false)
                                    <p>
                                        <a href="{{ route('profile',['candidate'=>$item->candidate->id]) }}" class="btn btn-sm  btn-success rounded"><i class="fa fa-user"></i> @lang('site.view-profile')</a>

                                    </p>
                                        @endif
                                </div>
                            </div>
                            <!-- Single Testimonial -->
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->




@section('footer')
    <script src="{{ asset('js/templates/bushome.js') }}"></script>


@endsection





   @endif

@if(optionActive('testimonials'))
    <!-- Testimonial Start -->
    <div class="testimonial-area fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-9 col-md-9">
                    <div class="h1-testimonial-active" id="testimonials">

                    @for($i=1;$i <= 6; $i++)
                        @if(!empty(toption('testimonials','name'.$i)))

                                <!-- Single Testimonial -->
                                <div class="single-testimonial pt-65">
                                    <!-- Testimonial tittle -->
                                    <div class="testimonial-icon mb-45">
                                        @if(!empty(toption('testimonials','image'.$i)))
                                            <img   class="int_imgmaxwh ani-btn " src="{{ asset(toption('testimonials','image'.$i)) }}" >
                                        @else
                                            <img   class="int_imgmaxwh ani-btn "    src="{{ asset('img/man.jpg') }}">
                                        @endif

                                    </div>
                                    <!-- Testimonial Content -->
                                    <div class="testimonial-caption text-center">
                                        <p>{{ toption('testimonials','text'.$i) }}</p>
                                        <!-- Rattion -->
                                        <div class="testimonial-ratting">
                                            @for($j=1;$j <= toption('testimonials','stars'.$i); $j++)
                                            <i class="fas fa-star"></i>
                                            @endfor
                                        </div>
                                        <div class="rattiong-caption">
                                            <span>{{ toption('testimonials','name'.$i) }}<span> - {{ toption('testimonials','role'.$i) }}</span> </span>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endif
@if(optionActive('blog'))
    <!-- Recent Area Start -->
    <div class="recent-area section-paddingt">
        <div class="container">
            <!-- section tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center">
                        <h2>{{ toption('blog','heading') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(\App\BlogPost::whereDate('publish_date','<=',\Illuminate\Support\Carbon::now()->toDateTimeString())->where('status',1)->orderBy('publish_date','desc')->limit(intval(toption('blog','limit')))->get() as $post)

                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-recent-cap mb-30">
                        <div class="recent-img">
                            @if(!empty($post->cover_photo))
                            <img src="{{ asset($post->cover_photo) }}" alt="">
                            @endif

                        </div>
                        <div class="recent-cap">
                            <span>{{ $post->title }}</span>
                            <h4><a href="{{ route('blog.post',['blogPost'=>$post->id]) }}">{{ $post->title }}</a></h4>
                            <p>{{  \Carbon\Carbon::parse($post->publish_date)->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Recent Area End-->
@endif



@endsection

@section('header')
    <link rel="stylesheet" href="{{ asset('css/templates/bhome.css') }}">
@endsection

@section('footer')


@endsection
