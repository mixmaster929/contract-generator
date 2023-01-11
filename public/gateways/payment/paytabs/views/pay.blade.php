@extends('account.billing.checkout')
@section('payment-form')


<div class="text-center">
    <form method="post" action="{{ route('cart.method',['function'=>'carepro_send','code'=>$code]) }}">
        @csrf
        <button class="btn btn-lg rounded btn-primary"><i class="fas fa-money-bill"></i> {{ __lang('pay-now') }}</button>
    </form>
</div>








@endsection

