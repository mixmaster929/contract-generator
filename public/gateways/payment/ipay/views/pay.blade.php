@extends('account.billing.checkout')
@section('payment-form')


    <div class="text-center">
        <form id="test_pos" method="POST" action="https://community.ipaygh.com/gateway">
            <input name="merchant_key" value="{{ paymentOption($code,'key') }}" type="hidden">
            <input name="success_url" value="{{ route('user.billing.invoices') }}" type="hidden">
            <input name="cancelled_url" value="{{ route('user.invoice.cart') }}" type="hidden">
            <input name="deferred_url" value="{{ route('user.invoice.cart') }}" type="hidden">
            <input name="ipn_url" value="{{ route('cart.ipn',['code'=>$code]) }}" type="hidden">

            <input name="total" value="{{ $invoice->amount }}" type="hidden">
            <input name="invoice_id" id="invoice_id" value="{{ $transactionId  }}" type="hidden">

            <button class="btn btn-primary" type="submit">{{ __lang('make-payment') }}</button>
        </form>
    </div>

@endsection
