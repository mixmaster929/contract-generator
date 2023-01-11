@extends('candidate.vacancies.apply')

@section('page-title',__('site.vacancy').': '.$vacancy->title)
@section('inline-title',__('site.vacancy').': '.$vacancy->title)
@section('inner-title')
@endsection
@section('content')





        <div class="container  pt-50">

                    @parent

        </div>







@endsection

@section('breadcrumb')
@endsection
