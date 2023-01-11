@extends($templateLayout)

@section('page-title',__('site.profile').': '.$candidate->display_name)

@section('content')

    <div class="row">
        <div class="col-md-9">
            <h4>@lang('site.profile')</h4>
        </div>
        <div class="col-md-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-0">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">@lang('site.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profiles') }}">@lang('site.profiles')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('site.view-profile')</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="az-content az-content-profile">
        <div class="container mn-ht-100p">
            <div class="az-content-left az-content-left-profile">

                <div class="az-profile-overview">
                    <div class="az-img-user">
                        @if(!empty($candidate->picture) && file_exists($candidate->picture))
                            <img  class="img-fluid"   src="{{ asset($candidate->picture) }}">
                        @elseif($candidate->gender=='m')
                            <img   class="img-fluid"    src="{{ asset('img/man.jpg') }}">
                        @else
                            <img  class="img-fluid"   src="{{ asset('img/woman.jpg') }}">
                        @endif

                    </div><!-- az-img-user -->
                    <div class="d-flex justify-content-between mg-b-20">
                        <div>
                            <h5 class="az-profile-name">{{ $candidate->display_name }}</h5>
                            <p class="az-profile-name-text">{{ getAge(\Illuminate\Support\Carbon::parse($candidate->date_of_birth)->timestamp) }}/{{ gender($candidate->gender) }}</p>
                        </div>
                        <div >

                        </div>
                    </div>

                    <div class="az-profile-bio">
                        <a href="{{ route('shortlist-candidate',['candidate'=>$candidate->id]) }}" class="btn btn-primary btn-block rounded"><i class="typcn typcn-plus-outline"></i>@lang('site.shortlist')</a>
                    </div><!-- az-profile-bio -->



                </div><!-- az-profile-overview -->

            </div><!-- az-content-left -->
            <div class="az-content-body az-content-body-profile">





                <div class="az-profile-body">
                    <div >
                            @if(!empty($candidate->video_code))
                             <div class="int_tpmb"  >   {!! $candidate->video_code  !!}</div>
                            @endif

                                <div class="az-content-label tx-13 mg-b-25">@lang('site.basic-info')</div>
                                <div class="az-profile-work-list int_tpmb"   >
                                    <div class="media">
                                        <div class="media-logo bg-success"><i class="fa fa-calendar-day"></i></div>
                                        <div class="media-body">
                                            <h6>@lang('site.date-of-birth')</h6>
                                            <span>{{ \Illuminate\Support\Carbon::parse($candidate->date_of_birth)->format('F Y') }} ({{ getAge(\Illuminate\Support\Carbon::parse($candidate->date_of_birth)->timestamp) }} @lang('site.years-old'))</span>
                                        </div><!-- media-body -->
                                    </div><!-- media -->



                                    <div class="media">
                                        <div class="media-logo bg-primary"><i class="fa fa-venus-mars"></i></div>
                                        <div class="media-body">
                                            <h6>@lang('site.gender')</h6>
                                            <span>{{ gender($candidate->gender) }} </span>
                                        </div><!-- media-body -->
                                    </div><!-- media -->


                                    @if($candidate->categories()->exists())
                                        <div class="media">
                                            <div class="media-logo bg-primary"></div>
                                            <div class="media-body">
                                                <h6>@lang('site.categories')</h6>
                                                <span>
                                                    <ul  class="csv">
                                                        @foreach($candidate->categories as $category)
                                                            <li>{{ $category->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </span>
                                            </div><!-- media-body -->
                                        </div><!-- media -->

                                    @endif


                                </div><!-- az-profile-work-list -->

                                @foreach($groups as $group)
                                    <div class="az-content-label tx-13 mg-b-25">{{ $group->name }}</div>

                                    <div class="az-profile-work-list int_tpmb"   >
                                        @foreach($group->candidateFields()->orderBy('sort_order')->get() as $field)
                                            <?php
                                            $value = ($candidate->user->candidateFields()->where('id',$field->id)->first()) ? $candidate->user->candidateFields()->where('id',$field->id)->first()->pivot->value:'';
                                            ?>
                                        @if($field->type != 'file' && $value != '')
                                            <div class="media">

                                                <div class="media-body">
                                                    <h6>{{ $field->name }}</h6>
                                                    <span>
                                                        @if($field->type=='checkbox')
                                                            {{ boolToString($value) }}
                                                         @elseif($field->type=='text' || $field->type=='textarea' || $field->type=='select' || $field->type=='radio')
                                                            {{ $value }}
                                                        @endif
                                                    </span>
                                                </div><!-- media-body -->
                                            </div><!-- media -->
                                                @endif

                                        @endforeach

                                    </div>

                                    @endforeach

                    </div>

                    @if(false)
                    <div class="row mg-b-20">
                        <div class="col-md-7 col-xl-8">
                            <div class="az-profile-view-chart">
                                <canvas id="chartArea"></canvas>
                                <div class="az-profile-view-info">
                                    <div class="d-flex align-items-baseline">
                                        <h6>508</h6>
                                        <span>-1.2% since last week</span>
                                    </div>
                                    <p>Profile viewers past 10 days</p>
                                </div>
                            </div>
                        </div><!-- col -->
                        <div class="col-md-5 col-xl-4 mg-t-40 mg-md-t-0">
                            <div class="az-content-label tx-13 mg-b-20">Traffic Details</div>
                            <div class="az-traffic-detail-item">
                                <div>
                                    <span>People with title Founder &amp; CEO</span>
                                    <span>24 <span>(20%)</span></span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar wd-20p" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><!-- progress -->
                            </div>
                            <div class="az-traffic-detail-item">
                                <div>
                                    <span>People with title UX Designer</span>
                                    <span>16 <span>(15%)</span></span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-success wd-15p" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><!-- progress -->
                            </div>
                            <div class="az-traffic-detail-item">
                                <div>
                                    <span>People with title Recruitment</span>
                                    <span>87 <span>(45%)</span></span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-pink wd-45p" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><!-- progress -->
                            </div>
                            <div class="az-traffic-detail-item">
                                <div>
                                    <span>People with title Software Engineer</span>
                                    <span>32 <span>(25%)</span></span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-teal wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><!-- progress -->
                            </div>
                        </div><!-- col -->
                    </div><!-- row -->
                    <hr class="mg-y-40">
                    <div class="row">
                        <div class="col-md-7 col-xl-8">
                            <div class="az-content-label tx-13 mg-b-25">Work &amp; Education</div>
                            <div class="az-profile-work-list">
                                <div class="media">
                                    <div class="media-logo bg-success"><i class="icon ion-logo-whatsapp"></i></div>
                                    <div class="media-body">
                                        <h6>UI/UX Designer at <a href="#">Whatsapp</a></h6>
                                        <span>2016 - present</span>
                                        <p>Past Work: BootstrapDash, Inc.</p>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <div class="media">
                                    <div class="media-logo bg-primary"><i class="icon ion-logo-buffer"></i></div>
                                    <div class="media-body">
                                        <h6>Studied at <a href="#">Buffer University</a></h6>
                                        <span>2002 - 2006</span>
                                        <p>Degree: Bachelor of Science in Computer Science</p>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                            </div><!-- az-profile-work-list -->
                        </div><!-- col -->
                        <div class="col-md-5 col-xl-4 mg-t-40 mg-md-t-0">
                            <div class="az-content-label tx-13 mg-b-25">Contact Information</div>
                            <div class="az-profile-contact-list">
                                <div class="media">
                                    <div class="media-icon"><i class="icon ion-md-phone-portrait"></i></div>
                                    <div class="media-body">
                                        <span>Mobile</span>
                                        <div>(+63) 123 4567 890</div>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <div class="media">
                                    <div class="media-icon"><i class="icon ion-logo-slack"></i></div>
                                    <div class="media-body">
                                        <span>Slack</span>
                                        <div>@sophia.w</div>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <div class="media">
                                    <div class="media-icon"><i class="icon ion-md-locate"></i></div>
                                    <div class="media-body">
                                        <span>Current Address</span>
                                        <div>San Francisco, CA</div>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                            </div><!-- az-profile-contact-list -->
                        </div><!-- col -->
                    </div><!-- row -->
                    <div class="mg-b-20"></div>
                     @endif

                </div><!-- az-profile-body -->

            </div><!-- az-content-body -->
        </div><!-- container -->
    </div><!-- az-content -->



@endsection

@section('header')
    <link rel="stylesheet" href="{{ asset('css/templates/azprofile.css') }}">

    @endsection
