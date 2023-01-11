<?php

use Unirest\Request\Body;

function carepro_pay($output){
    $code =  $output['code'];
    return view("payment.{$code}.views.pay",$output);
}

function carepro_callback(){
    $invoiceId = session()->get('invoice');
    $invoice = App\Invoice::find($invoiceId);
    $tid = request()->input('paystack-trxref');
    $result = array();
//The parameter after verify/ is the transaction reference to be verified
    $url = 'https://api.paystack.co/transaction/verify/'.$tid;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt(
        $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.paymentOption('paystack','secret_key')]
    );
    $request = curl_exec($ch);
    if(curl_error($ch)){
        return redirect()->route('user.invoice.cart')->with('flash_message','error:' . curl_error($ch));
    }
    curl_close($ch);

    if ($request) {
        $result = json_decode($request, true);
    }

    if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {

        $msg=  approveInvoice($invoice);
        successMessage($msg);
        return redirect()->route('user.billing.invoices');
    }else{
        errorMessage(__('site.payment-unsuccessful'));

        return redirect()->route('user.invoice.cart');
    }
}


function carepro_ipn(){

}


