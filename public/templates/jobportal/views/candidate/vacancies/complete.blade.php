@extends($templateLayout)

@section('page-title',__('site.application-complete'))
@section('inline-title',__('site.application-complete'))
@section('crumb')
    <li><a href="{{ route('vacancies') }}">@lang('site.vacancies')</a></li>
    <li>@lang('site.application-complete')</li>
@endsection
@section('content')



        <div class="container  pt-50">


            @lang('site.application-complete-msg')

        </div>






@endsection

