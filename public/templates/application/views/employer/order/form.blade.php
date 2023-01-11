@extends('employer.order.form')

@section('content')

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">{{ $orderForm->name }}</h2>

        </div>
    </div><!-- az-dashboard-one-title -->
@parent
@endsection

@section('header')
   @parent
   <link rel="stylesheet" href="{{ asset('css/templates/wizard.css') }}">

    @endsection
