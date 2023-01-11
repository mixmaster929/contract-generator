<?php

use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

function carepro_pay($output){
  $code =  $output['code'];
  return view("payment.{$code}.views.pay",$output);
}

function carepro_callback(){

    if(!request()->isMethod('post'))
    {

        return redirect()->route('user.invoice.cart');
    }

    $invoiceId = session()->get('invoice');
    $invoice = App\Invoice::find($invoiceId);

    $token  = request()->input('stripeToken');

    Stripe::setApiKey(paymentOption('stripe','secret_key'));

    try{

        $customer = Customer::create([
            'email'=>$invoice->user->email,
            'source'=>$token
        ]);

        $charge = Charge::create(array(
            'customer' => $customer->id,
            'amount'   => ($invoice->amount * 100),
            'currency' => strtolower(trim(setting('general_currency_code')))
        ));

        $msg=  approveInvoice($invoice);
        successMessage($msg);
        return redirect()->route('user.billing.invoices');

    }
    catch(\Exception $ex){


        errorMessage(__('site.payment-unsuccessful').$ex->getMessage());

        return redirect()->route('user.invoice.cart');
    }


}

function carepro_ipn(){

}



