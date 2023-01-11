@extends($templateLayout)

@section('page-title',$title)
@section('inline-title',$title)
@section('inner-title','')
@section('crumb')
    <li>{{$title}}</li>
@endsection
@section('content')

    <form name="categoryForm" id="categoryForm" action="{{ route('vacancies') }}" method="get">
    <!-- Start Find Job Area -->
    <section class="find-job section">
        <div class="search-job">
            <div class="container">
                @include('partials.flash_message')
                <div class="search-nner">
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <select class="form-control" name="category" id="category" onchange="$('#categoryForm').submit()">
                                <option value="">@lang('site.all-vacancies')</option>
                                @foreach($categories as $category)
                                    <option @if(request('category')==$category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </form>
        <div class="container">
            <div class="single-head">
                <div class="row">
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
                    <div class="col-12">
                        <div class="pagination center">
                            {{ $vacancies->appends(['category' => Request::get('category')])->links('jobportal.views.partials.paginator') }}
                        </div>
                    </div>
                </div>
                <!--/ End Pagination -->
            </div>
        </div>
    </section>
    <!-- /End Find Job Area -->





@endsection

