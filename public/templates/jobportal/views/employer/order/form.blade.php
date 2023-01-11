@extends('employer.order.form')
@section('inline-title',$orderForm->name)
@section('crumb')
    <li><a href="{{ route('order-forms') }}">@lang('site.order-forms')</a></li>
    <li>@lang('site.form')</li>
@endsection
@section('content')

    <div class="container pt-50  pb-130">
        @parent
    </div>












@endsection

@section('header')
   @parent
   <link rel="stylesheet" href="{{ asset('css/templates/wizard.css') }}">
   <style>
       .wizard > .steps .done a, .wizard > .steps .done a:hover, .wizard > .steps .done a:active {
           background: #3352CC;
       }
       .wizard > .steps .current a, .wizard > .steps .current a:hover, .wizard > .steps .current a:active {
           background: #3F4093;
           color: #fff;
           cursor: default;
       }
       .wizard > .actions a, .wizard > .actions a:hover, .wizard > .actions a:active {
           background: #3833CC;
       }
       section div.card{
           margin-bottom: 30px;
       }
       section div.card img{
           margin-top: 20px;
       }
   </style>
    @endsection

@section('footer')
    <script src="{{ asset('vendor/jquery/jquery-1.12.4.min.js') }}"></script>
    @parent
@endsection
