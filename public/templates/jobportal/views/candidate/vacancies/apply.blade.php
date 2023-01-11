@extends($templateLayout)

@section('page-title',__('site.vacancy').': '.$vacancy->title)
@section('inline-title',__('site.vacancy').' : '.$vacancy->title)
@section('inner-title')
@endsection
@section('crumb')
    <li><a href="{{ route('vacancies') }}">@lang('site.vacancies')</a></li>
    <li><a href="{{ route('view-vacancy',['vacancy'=>$vacancy->id]) }}">@lang('site.vacancy-details')</a></li>
    <li>@lang('site.apply')</li>
@endsection
@section('content')





        <div class="container  pt-50">
            @include('partials.flash_message')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('site.upload-cv')</h5>

                    <p class="card-text">@lang('site.upload-cv-text')</p>

                    <form action="{{ route('candidate.vacancy.submit',['vacancy'=>$vacancy->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="cv">@lang('site.cv-resume')</label> <br>
                            <input name="cv" class="form-control" type="file" required />
                        </div>
                        <button type="submit" class="btn btn-primary  btn-block rounded">@lang('site.apply-now')</button>
                    </form>


                </div>
            </div>

        </div>







@endsection

@section('breadcrumb')
@endsection
