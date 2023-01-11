@extends($templateLayout)
@section('page-title',setting('general_homepage_title'))
@section('meta-description',setting('general_homepage_meta_desc'))

@section('content')

    <div class="az-dashboard-one-title">
        @if(optionActive('welcome'))
        <div>
            <h2 class="az-dashboard-title">{{ toption('welcome','welcome_heading') }}</h2>
            <p class="az-dashboard-text">{!! clean( toption('welcome','welcome_message') ) !!}</p>
        </div>
        @endif

        @if(optionActive('order-buttons'))
        <div class="az-content-header-right">
            @if(!empty(toption('order-buttons','order_form')))
            <a href="{{ route('order-forms') }}" class="btn btn-primary rounded"><i class="fa fa-file-alt"></i> @lang('site.order-form')</a>
            @endif

            @if(!empty(toption('order-buttons','browse_profiles')))
            <a href="{{ route('profiles') }}" class="btn btn-purple rounded"><i class="fa fa-users"></i> @lang('site.browse-profiles')</a>
                @endif
        </div>
        @endif

    </div><!-- az-dashboard-one-title -->

    @if(optionActive('homepage-text'))
    <div>
        {!! clean( toption('homepage-text','text') ) !!}
    </div>
    @endif

    @if(optionActive('login-form'))
        <div id="login-box" class="row"  >

            @if(!empty(toption('login-form','login')))
            <div class="col-md-6 int_tpmb"  >
                <div class="az-signin-header">
                    <h2>@lang('site.login')</h2>
                    <h4>@lang('site.please-login')</h4>
                    @include('partials.flash_message')

                    <div class="row"  >
                        @if(setting('social_enable_facebook')==1)
                            <div class="col-md-6 int_tpmb"  >
                                <a   class="int_mt0p btn btn-az-primary btn-sm btn-block  rounded" href="{{ route('social.login',['network'=>'facebook']) }}"><i class="fab fa-facebook-square"></i> @lang('site.login-facebook')</a>
                            </div>
                        @endif

                        @if(setting('social_enable_google')==1)
                            <div class="col-md-6">
                                <a   class="int_mt0p btn btn-danger  btn-sm  btn-block rounded" href="{{ route('social.login',['network'=>'google']) }}"><i class="fab fa-google"></i> @lang('site.login-google')</a>

                            </div>
                        @endif

                    </div>

                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label>@lang('site.email')</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror"  name="email"  required autocomplete="email" autofocus placeholder="@lang('site.enter-email')" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label>@lang('site.password')</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="@lang('site.enter-password')">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div><!-- form-group -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember" >
                                @lang('site.remember-me')
                            </label>
                        </div>

                        <button class="btn btn-az-primary btn-block">@lang('site.sign-in')</button>
                    </form>
                </div><!-- az-signin-header -->
                @if (Route::has('password.request'))
                    <div class="az-signin-footer"><br/>
                        <p><a href="{{ route('password.request') }}">@lang('site.forgot-password')</a></p>
                    </div><!-- az-signin-footer -->
                @endif

            </div>
            @endif

            @if(!empty(toption('login-form','register')))

                <div class="col-md-6">




                    <div class="az-signin-header">
                        <h2  >@lang('site.register')</h2>
                        <h4>@lang('site.register-help-text')</h4>

                        <div class="row">
                            @if(setting('general_enable_employer_registration')==1)
                                <div class="col-md-6 int_tcmb"  >
                                    <i  class="int_fs80 fa fa-user"></i> <br/>
                                    <a class="btn btn-primary rounded" href="{{ route('register.employer') }}">@lang('site.i-employer')</a>

                                </div>
                            @endif
                            @if(setting('general_enable_candidate_registration')==1)
                                <div class="col-md-6 int_tcmb" >
                                    <i  class="int_fs80 fa fa-user-tie"></i> <br/>
                                    <a class="btn btn-success rounded" href="{{ route('register.candidate') }}">@lang('site.i-candidate')</a>



                                </div>
                            @endif

                        </div>
                    </div><!-- az-signin-header -->



                </div>

            @endif

        </div>
    @endif

    @if(optionActive('candidates'))
        <div class="az-signin-header">
            <h2>@lang('site.profiles')</h2>
        </div>

        <div class="row row-sm">

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
            @if($candidates->count()==0)
                @lang('site.no-records')
            @endif

            @foreach($candidates as $item)
                <div class="col-md-6 col-lg-3 int_mb50" >

                    <div class="az-profile-overview">
                        <div class="az-img-user">
                            @if(!empty($item->candidate->picture) && file_exists($item->candidate->picture))
                                <img  class="img-fluid"   src="{{ asset($item->candidate->picture) }}">
                            @elseif($item->candidate->gender=='m')
                                <img  class="img-fluid"    src="{{ asset('img/man.jpg') }}">
                            @else
                                <img  class="img-fluid"   src="{{ asset('img/woman.jpg') }}">
                            @endif

                        </div><!-- az-img-user -->
                        <div class="d-flex justify-content-between mg-b-20">
                            <div>
                                <h5 class="az-profile-name">{{ $item->candidate->display_name }}</h5>
                                <p class="az-profile-name-text">{{ getAge(\Illuminate\Support\Carbon::parse($item->candidate->date_of_birth)->timestamp) }}/{{ gender($item->candidate->gender) }}</p>
                            </div>
                            <div >

                            </div>
                        </div>

                        <div class="az-profile-bio int_pd10"  >
                            <a href="{{ route('profile',['candidate'=>$item->candidate->id]) }}" class="btn btn-sm  btn-success rounded"><i class="fa fa-user"></i> @lang('site.view-profile')</a>

                            <a href="{{ route('shortlist-candidate',['candidate'=>$item->candidate->id]) }}" class="btn btn-sm btn-primary float-right rounded"><i class="typcn typcn-plus-outline"></i>@lang('site.shortlist')</a>
                        </div><!-- az-profile-bio -->



                    </div><!-- az-profile-overview -->

                </div>
            @endforeach

        </div>

    @endif

@endsection

@section('header')
    <link rel="stylesheet" href="{{ asset('css/templates/azhome.css') }}">

    @endsection

@section('footer')

    <script src="{{ asset('js/templates/aphome.js') }}"></script>

@endsection
