@extends($templateLayout)

@section('page-title',__('site.profile').': '.$candidate->display_name)
@section('inline-title',__('site.profiles'))
@section('crumb')
    <li><a href="{{ route('profiles') }}">@lang('site.profiles')</a></li>
    <li>@lang('site.view-profile')</li>

@endsection
@section('content')



    <!-- Main Content Start -->
    <div class="resume section">
        <div class="container">
            <div class="resume-inner">
                <div class="row">
                    <!-- Start Main Content -->
                    <div class="col-lg-4 col-12">
                        <div class="dashbord-sidebar p-3 text-center">
                            @if(!empty($candidate->picture) && file_exists($candidate->picture))
                                <img  class="img-fluid"    src="{{ asset($candidate->picture) }}">
                            @elseif($candidate->gender=='m')
                                <img  class="img-fluid "      src="{{ asset('img/man.jpg') }}">
                            @else
                                <img  class="img-fluid "    src="{{ asset('img/woman.jpg') }}">
                            @endif

                        </div>
                        <div class="dashbord-sidebar p-3 mt-2 text-center">
                            <a href="{{ route('shortlist-candidate',['candidate'=>$candidate->id]) }}" class="btn btn-primary btn-block btn-lg rounded"><i class="lni lni-circle-plus"></i> @lang('site.shortlist')</a>
                        </div>
                    </div>
                    <!-- End Main Content -->
                    <div class="col-lg-8 col-12">
                        <div class="inner-content">
                            <!-- Start Personal Top Content -->
                            <div class="personal-top-content">
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="content-right">
                                            <h5 class="title-main">{{ $candidate->display_name }}</h5>
                                            <!-- Single List -->
                                            <div class="single-list">
                                                <h5 class="title">@lang('site.age')</h5>
                                                <p>{{ getAge(\Illuminate\Support\Carbon::parse($candidate->date_of_birth)->timestamp) }}</p>
                                            </div>
                                            <!-- Single List -->
                                            <!-- Single List -->
                                            <div class="single-list">
                                                <h5 class="title">@lang('site.gender')</h5>
                                                <p>{{ gender($candidate->gender) }}</p>
                                            </div>
                                            <!-- Single List -->
                                            <!-- Single List -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Personal Top Content -->
                        @if(!empty($candidate->video_code))
                            <!-- Start Single Section -->
                                <div class="single-section">
                                    <h4>@lang('site.video')</h4>
                                   <div>
                                       {!! $candidate->video_code  !!}
                                   </div>
                                </div>
                                <!-- End Single Section -->
                        @endif
                            <!-- Start Single Section -->
                            <div class="single-section">
                                <h4>@lang('site.date-of-birth')</h4>
                                <p class="font-size-4 mb-8">
                                    {{ \Illuminate\Support\Carbon::parse($candidate->date_of_birth)->format('F Y') }} ({{ getAge(\Illuminate\Support\Carbon::parse($candidate->date_of_birth)->timestamp) }} @lang('site.years-old'))
                                </p>
                            </div>
                            <!-- End Single Section -->
                        @if($candidate->categories()->exists())

                            <!-- Start Single Section -->
                                <div class="single-section skill">
                                    <h4>Skills</h4>
                                    <ul class="list-unstyled d-flex align-items-center flex-wrap">
                                        @foreach($candidate->categories as $category)
                                            <li>{{ $category->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            <!-- End Single Section -->
                        @endif

                        @foreach($groups as $group)
                            <h3 class="text-center mt-3">{{ $group->name }}</h3>
                            @foreach($group->candidateFields()->orderBy('sort_order')->get() as $field)
                                <?php
                                $value = ($candidate->user->candidateFields()->where('id',$field->id)->first()) ? $candidate->user->candidateFields()->where('id',$field->id)->first()->pivot->value:'';
                                ?>
                                @if($field->type != 'file' && $value != '')
                            <!-- Start Single Section -->
                            <div class="single-section">
                                <h4>{{ $field->name }}</h4>
                                <p class="font-size-4 mb-8">
                                    <span>
                                                        @if($field->type=='checkbox')
        {{ boolToString($value) }}
    @elseif($field->type=='text' || $field->type=='textarea' || $field->type=='select' || $field->type=='radio')
        {{ $value }}
    @endif
                                                    </span>
                                </p>
                            </div>
                            <!-- End Single Section -->
                                @endif

                            @endforeach

                        @endforeach



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content end -->


    @if(false)
    <section class="about-area them-2 pb-130 pt-50">
        <div class="container">

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-team-item-3">
                            <div class="team-3-bg_ int_txcen"  >
                                @if(!empty($candidate->picture) && file_exists($candidate->picture))
                                    <img      src="{{ asset($candidate->picture) }}">
                                @elseif($candidate->gender=='m')
                                    <img     src="{{ asset('img/man.jpg') }}">
                                @else
                                    <img   src="{{ asset('img/woman.jpg') }}">
                                @endif

                            </div>
                            <div class="team-3-content">
                                <h4>{{ $candidate->display_name }}</h4>
                                <p>{{ getAge(\Illuminate\Support\Carbon::parse($candidate->date_of_birth)->timestamp) }}/{{ gender($candidate->gender) }}</p>


                            </div>


                        </div>

                        <br/>
                        <div class="az-profile-bio">
                            <a href="{{ route('shortlist-candidate',['candidate'=>$candidate->id]) }}" class="btn btn-primary btn-block btn-lg rounded"><i class="fa fa-plus"></i> @lang('site.shortlist')</a>
                        </div><!-- az-profile-bio -->


                    </div>
                    <div class="col-md-6">
                        <div class="single-team-member-details-content">
                            <div >
                                @if(!empty($candidate->video_code))
                                    <div class="int_tpmb" >   {!! $candidate->video_code  !!}</div>
                                @endif

                                    <div class="section-title">
                                        <h3 class="title">@lang('site.basic-info')</h3>
                                    </div>

                                <div class="az-profile-work-list int_tpmb"   >
                                    <div class="media">

                                        <div class="media-body">
                                            <h6>@lang('site.date-of-birth')</h6>
                                            <span>{{ \Illuminate\Support\Carbon::parse($candidate->date_of_birth)->format('F Y') }} ({{ getAge(\Illuminate\Support\Carbon::parse($candidate->date_of_birth)->timestamp) }} @lang('site.years-old'))</span>
                                        </div><!-- media-body -->
                                    </div><!-- media -->



                                    <div class="media">

                                        <div class="media-body">
                                            <h6>@lang('site.gender')</h6>
                                            <span>{{ gender($candidate->gender) }} </span>
                                        </div><!-- media-body -->
                                    </div><!-- media -->


                                    @if($candidate->categories()->exists())

                                        <div class="media">

                                            <div class="media-body">
                                                <h6>@lang('site.categories')</h6>
                                                <span> <ul  class="csv">
                                                        @foreach($candidate->categories as $category)
                                                            <li>{{ $category->name }}</li>
                                                        @endforeach
                                                    </ul>  </span>
                                            </div><!-- media-body -->
                                        </div><!-- media -->




                                    @endif


                                </div><!-- az-profile-work-list -->

                                @foreach($groups as $group)

                                        <div class="section-title">
                                            <h3 class="title">{{ $group->name }}</h3>
                                        </div>

                                    <div class="az-profile-work-list int_tpmb"  >
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

                        </div>
                    </div>
                </div>
            </div>




        </div>
    </section>
    @endif


@endsection

@section('header')
    <link rel="stylesheet" href="{{ asset('css/templates/busprofile.css') }}">
    @endsection
