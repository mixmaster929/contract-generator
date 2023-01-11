<?php

function carepro_pay($output){
    $code =  $output['code'];
    return view("payment.{$code}.views.pay",$output);
}

function carepro_callback(){

    sendEmail(\Illuminate\Support\Facades\Auth::user()->email,__('site.payment-details'),paymentOption('bank','details'));

    session()->forget('invoice');
    $msg = __('site.payment-pending');
    successMessage($msg);
    return redirect()->route('user.billing.invoices');
}

function carepro_ipn(){

}



