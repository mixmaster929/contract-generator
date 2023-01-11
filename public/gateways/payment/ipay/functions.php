<?php

function carepro_pay($output){
    $code =  $output['code'];
    $output['transactionId'] = uniqid().'-'.$output['invoice']->id;
    return view("payment.{$code}.views.pay",$output);
}

function carepro_callback(){

}

function carepro_ipn(){


    $tid = trim(request()->get('invoice_id'));
    //$invoiceTransaction = \App\InvoiceTransaction::findOrFail($tid);

    //get invoice
    $invoiceId = substr($tid,stripos($tid,'-')+1);
    $invoice = \App\Invoice::find($invoiceId);
    $merchantKey = paymentOption('ipay','key');

    $url = 'https://manage.ipaygh.com/gateway/json_status_chk?invoice_id='.$tid.'&merchant_key='.$merchantKey;
    $status = file_get_contents($url);

    /* $statusArray = explode('~',$status);
 /*    if(trim($statusArray[1])=='paid'){
         $msg=  approveInvoice($invoice);
     }*/

    $obj = json_decode($status);
    if($obj->{$tid}->status=='paid'){
        approveInvoice($invoice);
    }

    exit('');
}

