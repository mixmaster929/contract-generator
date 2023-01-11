@extends('employer.order.form')
@section('inline-title',$orderForm->name)
@section('content')

    <div class="container pt-50  pb-130">
        @parent
    </div>












@endsection

@section('header')
   @parent
   <link rel="stylesheet" href="{{ asset('css/templates/wizard.css') }}">
    @endsection
