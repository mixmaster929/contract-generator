<?php

function carepro_pay($output){
    $code =  $output['code'];
    return view("payment.{$code}.views.pay",$output);
}

function carepro_callback(){
    $invoiceId = session()->get('invoice');
    $invoice = App\Invoice::find($invoiceId);
    $hashSecretWord = trim(paymentOption('twocheckout','secret_word')); //2Checkout Secret Word
    $hashSid = trim(paymentOption('twocheckout','account_number')); //2Checkout account number
    $hashTotal = number_format(floatval($invoice->amount), 2, '.', ''); //Sale total to validate against
    $hashOrder = request()->input('order_number'); //2Checkout Order Number
    $StringToHash = strtoupper(md5($hashSecretWord . $hashSid . $hashOrder . $hashTotal));
    if ($StringToHash != request()->input('key') || request()->input('credit_card_processed') != 'Y' ) {
        errorMessage(__('site.payment-unsuccessful'));
        return redirect()->route('user.invoice.cart');

    } else {
        $msg= approveInvoice($invoice);
        successMessage($msg);
        return redirect()->route('user.billing.invoices');

    }



}

function carepro_ipn(){

}
