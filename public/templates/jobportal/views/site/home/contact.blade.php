@extends($templateLayout)

@section('page-title',__('site.contact-us'))
@section('inline-title',__('site.contact-us'))
@section('crumb')
    <li>{{ __('site.contact-us') }}</li>
@endsection
@section('content')


    <!-- Start Contact Area -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head wow fadeInUp" data-wow-delay=".4s">
                <div class="row">
                    <div class="col-lg-7 col-12">
                        <div class="form-main">
                            <form class="form"  action="{{ route('contact.send-mail') }}" method="post" >
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <input name="name" type="text" placeholder="{{ __t('enter-your-name') }}" required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <input name="email" type="email" placeholder="{{ __t('enter-email') }}"
                                                   required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <input name="subject" type="text" placeholder="{{ __t('enter-subject') }}"
                                                   required="required">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group message">
                                            <textarea name="message" placeholder="{{ __t('enter-message') }}"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label>@lang('site.verification')</label><br/>
                                        <label class="mb-3">{!! clean( captcha_img() ) !!}</label> <br>
                                        <div class="form-group">
                                        <input  type="text" name="captcha" placeholder="@lang('site.verification-hint')"/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group button">
                                            <button type="submit" class="btn ">{{ __t('send') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                        <div class="single-head">
                            <div class="contant-inner-title">
                                <h4>{{ toption('contact-page','heading') }}</h4>
                                <p>{{ toption('contact-page','text') }}</p>
                            </div>
                            @if(!empty(setting('general_tel')))
                            <div class="single-info">
                                <i class="lni lni-phone"></i>
                                <ul>
                                    <li>{{ setting('general_tel') }}</li>
                                </ul>
                            </div>
                            @endif
                            @if(!empty(setting('general_contact_email')))
                            <div class="single-info">
                                <i class="lni lni-envelope"></i>
                                <ul>
                                    <li><a href="mailto:{!! clean( setting('general_contact_email') ) !!}">{!! clean( setting('general_contact_email') ) !!}</a></li>
                                </ul>
                            </div>
                            @endif
                            @if(!empty(setting('general_address')))
                            <div class="single-info">
                                <i class="lni lni-map"></i>
                                <ul>
                                    <li>{{ setting('general_address') }}</li>
                                </ul>
                            </div>
                            @endif
                            <div class="contact-social">
                                <h5>{{ __t('follow-us') }}</h5>
                                <ul>
                                    @if(!empty(toption('contact-page','social_facebook')))
                                        <li><a href="{{ toption('contact-page','social_facebook') }}"><i class="lni lni-facebook-original"></i></a></li>
                                    @endif
                                    @if(!empty(toption('contact-page','social_twitter')))
                                        <li><a href="{{ toption('contact-page','social_twitter') }}"><i class="lni lni-twitter-original"></i></a></li>
                                    @endif
                                    @if(!empty(toption('contact-page','social_linkedin')))
                                        <li><a href="{{ toption('contact-page','social_linkedin') }}"><i class="lni lni-linkedin-original"></i></a></li>
                                    @endif
                                    @if(!empty(toption('contact-page','social_youtube')))
                                        <li><a href="{{ toption('contact-page','social_youtube') }}"><i class="lni lni-youtube"></i></a></li>
                                    @endif
                                    @if(!empty(toption('contact-page','social_instagram')))
                                        <li><a href="{{ toption('contact-page','social_instagram') }}"><i class="lni lni-instagram-original"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(toption('contact-page','google_map')==1)
        <!-- Start Google-map Area -->
        <div class="map-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="map-container">
                            <div class="mapouter">
                                <div class="gmap_canvas"><iframe width="100%" height="400" id="gmap_canvas"
                                                                 src="https://maps.google.com/maps?q={!! urlencode(toption('contact-page','map_address')) !!}&ie=UTF8&iwloc=&output=embed"
                                                                 frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                    <style>
                                        .mapouter {
                                            position: relative;
                                            text-align: right;
                                            height: 400px;
                                            width: 100%;
                                        }

                                        .gmap_canvas {
                                            overflow: hidden;
                                            background: none !important;
                                            height: 400px;
                                            width: 100%;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Google-map Area -->
            @endif

    </section>
    <!--/ End Contact Area -->


    @if(false)
    <!-- ================ contact section start ================= -->
    <section class="contact-section">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">@lang('site.get-in-touch-text')</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form_" action="{{ route('contact.send-mail') }}" method="post" >
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea required class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ addslashes(__t('enter-message')) }}'" placeholder=" {{ __t('enter-message') }}"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input required  class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ addslashes(__t('enter-your-name')) }}'" placeholder="{{ __t('enter-your-name') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input required  class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ addslashes(__t('enter-email')) }}'" placeholder="{{ __t('enter-email') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ addslashes(__t('enter-subject')) }}'" placeholder="{{ __t('enter-subject') }}">
                                </div>
                            </div>

                            <div class="col-12">
                                <label>@lang('site.verification')</label><br/>
                                <label for="">{!! clean( captcha_img() ) !!}</label>
                                <input class="form-control" type="text" name="captcha" placeholder="@lang('site.verification-hint')"/>

                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">{{ __t('send') }}</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>@lang('site.address')</h3>
                            <p>{{ setting('general_address') }}</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>@lang('site.telephone')</h3>
                            <p>{{ setting('general_tel') }}</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>@lang('site.email')</h3>
                            <p>{!! clean( setting('general_contact_email') ) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->

    @endif






@endsection
