<?php

function carepro_pay($output){

    $invoiceId = session()->get('invoice');
    $invoice = App\Invoice::find($invoiceId);
    $gateway = \Omnipay\Omnipay::create('PayPal_Rest');



    $gateway->initialize(array(
        'clientId' => trim(paymentOption('paypal','client_id')),
        'secret'   => trim(paymentOption('paypal','secret')),
        'testMode' => (paymentOption('paypal','mode') == 0), // Or false when you are ready for live transactions
    ));

    $transaction = $gateway->authorize(array(
        'amount'        => number_format(floatval($invoice->amount), 2, '.', ''),
        'currency'      => trim(strtoupper(setting('general_currency_code'))),
        'description'   => $invoice->title,
        'returnUrl' => route('user.callback',['code'=>$invoice->paymentMethod->code]),
        'cancelUrl' => route('user.invoice.cart'),

    ));


    $response = $transaction->send();

    // dd('paypa;');
//        $session->transactionRef = $response->getTransactionReference();
    session()->put('paypal-ref',$response->getTransactionReference());


    if ($response->isRedirect()) {
        // Yes it's a redirect.  Redirect the customer to this URL:
        $redirectUrl = $response->getRedirectUrl();
        return redirect($redirectUrl);
    }
    else{
        return redirect()->route('user.invoice.cart')->with('flash_message',__('site.unable-load'));

    }

}

function carepro_callback(){
    $invoiceId = session()->get('invoice');
    $invoice = App\Invoice::find($invoiceId);

    $gateway = \Omnipay\Omnipay::create('PayPal_Rest');
    $gateway->initialize(array(
        'clientId' => trim(paymentOption('paypal','client_id')),
        'secret'   => trim(paymentOption('paypal','secret')),
        'testMode' => (paymentOption('paypal','mode') == 0), // Or false when you are ready for live transactionsor live transactions

    ));

    try {

        $transaction = $gateway->completePurchase(array(
            'payerId'             => request()->input('PayerID'),
            'transactionReference' =>  session()->get('paypal-ref')
        ));

        $finalResponse = $transaction->send();

        if ($finalResponse->isSuccessful()) {
            $results = $finalResponse->getTransactionReference();
            $msg=  approveInvoice($invoice);
            successMessage($msg);
            return redirect()->route('user.billing.invoices');

        }else{
            throw new \Exception(__('site.transaction-failed'));
        }

    } catch (\Exception $e) {
        errorMessage(__('site.payment-unsuccessful').': '.$e->getMessage());
        return redirect()->route('user.invoice.cart');
    }

    return redirect()->route('user.invoice.cart');
}

