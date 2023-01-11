<?php

use Unirest\Request\Body;

function carepro_pay($output){
    $code =  $output['code'];
    return view("payment.{$code}.views.pay",$output);
}

function carepro_callback(){

    $invoiceId = session()->get('invoice');
    $invoice = App\Invoice::find($invoiceId);

    $response = request()->input('resp');
    $responsObj= json_decode($response);


    $ref = $responsObj->tx->txRef;

    $data = array('txref' => $ref,
        'SECKEY' => paymentOption('rave','secret_key'), //secret key from pay button generated on rave dashboard
        'include_payment_entity' => 1
    );

    if(paymentOption('rave','mode')=='test'){
        $endPoint = 'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/v2/verify';
    }
    else{
        $endPoint = 'https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify';
    }


    // make request to endpoint using unirest.
    $headers = array('Content-Type' => 'application/json');
    $body = Body::json($data);


    try{

        $response = \Unirest\Request::post($endPoint, $headers, $body);

        //check the status is success
        if ($response->body->status === "success" && $response->body->data->chargecode === "00") {
            $msg=  approveInvoice($invoice);
            successMessage($msg);
            return redirect()->route('user.billing.invoices');
        }
        else{
            errorMessage(__('site.payment-unsuccessful'));
            return redirect()->route('user.invoice.cart');
        }

    }
    catch(\Exception $ex){
        errorMessage(__('site.payment-unsuccessful').$ex->getMessage());
        return redirect()->route('user.invoice.cart');
    }


}

function carepro_ipn(){

}
