@extends($templateLayout)

@section('page-title',__('site.vacancy').' : '.$vacancy->title)
@section('inline-title',__('site.vacancy').' : '.$vacancy->title)
@section('crumb')
    <li><a href="{{ route('vacancies') }}">@lang('site.vacancies')</a></li>
    <li>@lang('site.vacancy-details')</li>
@endsection
@section('content')

    <!-- Start Job Details -->
    <div class="job-details section">
        <div class="container">
            @include('partials.flash_message')
            <div class="row mb-n5">
                <!-- Job List Details Start -->
                <div class="col-lg-8 col-12">
                    <div class="job-details-inner">
                        <div class="job-details-head row mx-0">

                            <div class="salary-type col-auto order-sm-3">
                                <span class="salary-range">{{ $vacancy->salary }}</span>
                                <span class="badge badge-success">{{ \Illuminate\Support\Carbon::parse($vacancy->updated_at)->diffForHumans() }}</span>
                            </div>
                            <div class="content col">
                                <h5 class="title">{{ $vacancy->title }}</h5>
                                <ul class="meta">

                                    <li><i class="lni lni-map-marker"></i> {{ $vacancy->location }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="job-details-body">
                            <h6 class="mb-3">{{ __t('job-description') }}</h6>
                            <p>{!! clean($vacancy->description) !!}</p>

                        </div>
                    </div>
                </div>
                <!-- Job List Details End -->
                <!-- Job Sidebar Wrap Start -->
                <div class="col-lg-4 col-12">
                    <div class="job-details-sidebar">
                        <!-- Sidebar (Apply Buttons) Start -->
                        <div class="sidebar-widget">
                            <div class="inner">
                                <div class="row m-n2 button">
                                        <a  onclick="return confirm('@lang('site.confirm-application')')"  href="{{ route('candidate.vacancy.apply',['vacancy'=>$vacancy->id]) }}" class="d-block btn btn-primary">@lang('site.apply')</a>

                                </div>
                            </div>
                        </div>
                        <!-- Sidebar (Apply Buttons) End -->
                        <!-- Sidebar (Job Overview) Start -->
                        <div class="sidebar-widget">
                            <div class="inner">
                                <h6 class="title">{{ __t('job-overview') }}</h6>
                                <ul class="job-overview list-unstyled">
                                    <li><strong>{{__t('published-on')}}:</strong> {{ $vacancy->updated_at->format('M d, Y') }}</li>

                                    <li><strong>{{__t('job-location')}}:</strong> {{ $vacancy->location }}</li>
                                    <li><strong>@lang('site.salary'):</strong> {{ $vacancy->salary }}</li>
                                    @if(!empty($vacancy->closes_at))
                                    <li><strong>{{ __t('application-deadline') }}:</strong> {{ \Illuminate\Support\Carbon::parse($vacancy->closes_at)->format('M d, Y') }}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar (Job Overview) End -->

                        @if(!empty($vacancy->location))
                        <!-- Sidebar (Job Location) Start -->
                        <div class="sidebar-widget">
                            <div class="inner">
                                <h6 class="title">{{__t('job-location')}}</h6>
                                <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q={{ urlencode($vacancy->location) }}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><style>.mapouter{position:relative;text-align:right;height:300px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:300px;width:100%;}</style></div></div>
                            </div>
                        </div>
                        <!-- Sidebar (Job Location) End -->
                        @endif
                    </div>
                </div>
                <!-- Job Sidebar Wrap End -->

            </div>
        </div>
    </div>
    <!-- End Job Details -->



@endsection

@section('breadcrumb')
    @endsection
