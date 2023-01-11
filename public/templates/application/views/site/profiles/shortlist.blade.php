@extends($templateLayout)

@section('page-title',__('site.your-shortlist'))


@section('content')

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">{{ __('site.your-shortlist') }}</h2>

        </div>
    </div>
    @include('partials.flash_message')
    <!-- az-dashboard-one-title -->
    @if(Session::has('candidate') && \App\Candidate::find(session()->get('candidate')))

    <p class="alert alert-success">
        @lang('site.shortlist-add-msg',['name'=>\App\Candidate::find(session()->get('candidate'))->display_name])
        <br/>
        <a class="btn btn-primary rounded" href="{{ route('profiles') }}">@lang('site.browse-more-profiles')</a>
        <a class="btn btn-success rounded" href="{{ route('order-forms') }}?shortlist">@lang('site.complete-order-form')</a>
    </p>

    @endif

    @if(!is_array($cart) || count($cart)==0)
    @lang('site.empty-shortlist') <br/>
    <a class="btn btn-primary rounded" href="{{ route('profiles') }}">@lang('site.browse-profiles')</a>
    @else

        <div class="row">

           @foreach($cart as $item)

               <?php
                    $candidate = \App\Candidate::find($item);
                    ?>

            <div class="col-md-2 int_mb50" >

                <div class="az-profile-overview">
                    <div class="az-img-user">
                        <a href="{{ route('profile',['candidate'=>$candidate->id]) }}">
                        @if(!empty($candidate->picture) && file_exists($candidate->picture))
                            <img  class="img-fluid"   src="{{ asset($candidate->picture) }}">
                        @elseif($candidate->gender=='m')
                            <img     src="{{ asset('img/man.jpg') }}">
                        @else
                            <img  class="img-fluid"   src="{{ asset('img/woman.jpg') }}">
                        @endif
                        </a>
                    </div><!-- az-img-user -->
                    <div class="d-flex justify-content-between mg-b-20">
                        <div>
                            <h5 class="az-profile-name"><a href="{{ route('profile',['candidate'=>$candidate->id]) }}">{{ $candidate->display_name }}</a></h5>
                            <p class="az-profile-name-text">{{ getAge(\Illuminate\Support\Carbon::parse($candidate->date_of_birth)->timestamp) }}/{{ gender($candidate->gender) }}</p>
                        </div>
                        <div >

                        </div>
                    </div>

                    <div class="az-profile-bio int_pd10"  >
                        <a onclick="return confirm('@lang('site.confirm-delete')')" href="{{ route('shortlist.remove',['candidate'=>$candidate->id]) }}" class="btn btn-sm  btn-danger rounded"><i class="fa fa-trash"></i> @lang('site.remove')</a>

                     </div><!-- az-profile-bio -->



                </div><!-- az-profile-overview -->

            </div>

            @endforeach
        </div>

  <div>
      <hr/>
      <a  class="int_mb10 btn btn-primary rounded" href="{{ route('profiles') }}">@lang('site.browse-more-profiles')</a>
      <a class="btn btn-success rounded float-right" href="{{ route('order-forms') }}?shortlist">@lang('site.complete-order-form')</a>
  </div>


    @endif




@endsection
