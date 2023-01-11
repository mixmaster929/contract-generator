@extends($templateLayout)

@section('page-title',__('site.your-shortlist'))
@section('inline-title',__('site.your-shortlist'))

@section('content')

    <section class="about-area them-2 pb-130 pt-50">
        <div class="container">

            <div class="row">

                <div class="col-md-12">
                    <div class="about-content them-2 int_pt10"  >
                        @include('partials.flash_message')
                        <!-- az-dashboard-one-title -->
                        @if(Session::has('candidate') && \App\Candidate::find(session()->get('candidate')))
                            <br/>
                            <p class="alert alert-success">
                                @lang('site.shortlist-add-msg',['name'=>\App\Candidate::find(session()->get('candidate'))->display_name])

                                <a class="btn btn-primary rounded" href="{{ route('profiles') }}">@lang('site.browse-more-profiles')</a>
                                <a class="btn btn-success rounded" href="{{ route('order-forms') }}?shortlist">@lang('site.complete-order-form')</a>
                            </p>

                        @endif

                        @if(!is_array($cart) || count($cart)==0)
                            @lang('site.empty-shortlist') <br/>
                            <a class="btn btn-primary rounded" href="{{ route('profiles') }}">@lang('site.browse-profiles')</a>
                        @else

                            <div class="row int_mt30px"  >

                                @foreach($cart as $item)

                                    <?php
                                    $candidate = \App\Candidate::find($item);
                                    ?>

                                    <div class="col-md-4 int_mb50"  >

                                        <div class="card int_wi18re"  >
                                            <a href="{{ route('profile',['candidate'=>$candidate->id]) }}">

                                                @if(!empty($candidate->picture) && file_exists($candidate->picture))
                                                    <img class="card-img-top"  src="{{ asset($candidate->picture) }}" >
                                                @elseif($candidate->gender=='m')
                                                    <img  class="card-img-top"    src="{{ asset('img/man.jpg') }}">
                                                @else
                                                    <img  class="card-img-top"   src="{{ asset('img/woman.jpg') }}">
                                                @endif
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $candidate->display_name }}</h5>
                                                <p class="card-text">{{ getAge(\Illuminate\Support\Carbon::parse($candidate->date_of_birth)->timestamp) }}/{{ gender($candidate->gender) }}</p>
                                                <a onclick="return confirm('@lang('site.confirm-delete')')" href="{{ route('shortlist.remove',['candidate'=>$candidate->id]) }}" class="btn btn-sm  btn-danger rounded"><i class="fa fa-trash"></i> @lang('site.remove')</a>

                                            </div>
                                        </div>


                                        @if(false)
                                        <div class="single-team-item-3">
                                            <div class="team-3-bg_ int_txcen"  >
                                                <a href="{{ route('profile',['candidate'=>$candidate->id]) }}">
                                                    @if(!empty($candidate->picture) && file_exists($candidate->picture))
                                                        <img src="{{ asset($candidate->picture) }}" >
                                                    @elseif($candidate->gender=='m')
                                                        <img    src="{{ asset('img/man.jpg') }}">
                                                    @else
                                                        <img   src="{{ asset('img/woman.jpg') }}">
                                                    @endif
                                                </a>

                                            </div>
                                            <div class="team-3-content">
                                                <a href="#"><h4>{{ $candidate->display_name }}</h4></a>
                                                <p>{{ getAge(\Illuminate\Support\Carbon::parse($candidate->date_of_birth)->timestamp) }}/{{ gender($candidate->gender) }}</p>

                                                <div class="az-profile-bio int_pd10"  >
                                                    <a onclick="return confirm('@lang('site.confirm-delete')')" href="{{ route('shortlist.remove',['candidate'=>$candidate->id]) }}" class="btn btn-sm  btn-danger rounded"><i class="fa fa-trash"></i> @lang('site.remove')</a>


                                                </div><!-- az-profile-bio -->

                                            </div>
                                        </div>
                                        @endif





                                    </div>

                                @endforeach
                            </div>

                            <div>
                                <hr/>
                                <a   class="int_mb10 btn btn-primary rounded" href="{{ route('profiles') }}">@lang('site.browse-more-profiles')</a>
                                <a class="btn btn-success rounded float-right" href="{{ route('order-forms') }}?shortlist">@lang('site.complete-order-form')</a>
                            </div>


                        @endif



                    </div> <!-- about content -->
                </div>
            </div> <!-- row -->
        </div>
    </section>





















@endsection
