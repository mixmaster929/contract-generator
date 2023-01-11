<?php

function carepro_pay($output){
    $code =  $output['code'];

    $invoiceId = session()->get('invoice');
    $invoice = App\Invoice::find($invoiceId);

  $data = [];
    $url = '';
    $mode = paymentOption($code,'mode');
    $key = paymentOption($code,'merchant_key');
    $salt = paymentOption($code,'salt');

    if($mode==0){
        $url = 'https://sandboxsecure.payu.in';
    }
    else{
        $url = 'https://secure.payu.in';
    }

    $user = \Illuminate\Support\Facades\Auth::user();
    $transaction = uniqid().'-'.$invoice->id;
    $data['action'] = $url.'/_payment';
    $data['surl'] = route('cart.ipn',['code'=>$code]);//HTTP_SERVER.'/index.php?route=payment/payu/callback';
    $data['furl'] = route('cart.method',['code'=>$code,'function'=>'carepro_failure']);
    $data['curl'] = route('cart.method',['code'=>$code,'function'=>'carepro_failure']);
    $key          =  trim($key);
    $amount       =  $invoice->amount;
    $productInfo  = $invoice->title;
    $firstname    = $user->name;
    $email        = $user->email;
    $salt         = trim($salt);
    $udf5 		  = "carepro";
    $Hash=hash('sha512', $key.'|'.$transaction.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||||||||'.$salt);
    $data['user_credentials'] = $key.':'.$email;
    $data['udf5'] = $udf5;
    $data['hash'] = $Hash;
    $data['key'] = $key;
    $data['student'] = $user;
    $service_provider = 'payu_paisa';
    $data['service_provider'] = $service_provider;
    $data['amount'] = $amount;
    $data['productinfo'] = $productInfo;
    $data['phone'] = $user->telephone;
    $data['lastname'] = $user->email;
    $data['firstname'] = $firstname;
    $data['udf5']= $udf5;
    $data['email'] = $email;


    $data['tid'] = $transaction;
    $data['mode'] = $mode;
    $output += $data;
  return view("payment.{$code}.views.pay",$output);
}

function carepro_callback(){

    $invoiceId = session()->get('invoice');
    $invoice = App\Invoice::find($invoiceId);
    $code = 'payuin';

    $mode = paymentOption($code,'mode');
    $key = paymentOption($code,'merchant_key');
    $salt = paymentOption($code,'salt');

    $tid = $_POST["txnid"];

    $status=$_POST["status"];
    $firstname=$_POST["firstname"];
    $amount=$_POST["amount"];
    $txnid=$_POST["txnid"];
    $posted_hash=$_POST["hash"];
    $key=$_POST["key"];
    $productInfo=$_POST["productinfo"];
    $email=$_POST["email"];
    $udf5 		  = "carepro";


    //check if transaction is successful
    If (isset($_POST["additionalCharges"])) {
        $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productInfo.'|'.$amount.'|'.$txnid.'|'.$key;
    } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productInfo.'|'.$amount.'|'.$txnid.'|'.$key;
    }

    $hash = hash("sha512", $retHashSeq);

    try{


        if($amount  != floatval($invoice->amount)) {
            throw new \Exception(__lang("invalid-amount-rec"));
        }

        if ($hash != $posted_hash)
        {
            throw new \Exception(__lang('Payment failed!'));
        }
        else{
            $msg=  approveInvoice($invoice);
            successMessage($msg);
            return redirect()->route('user.billing.invoices');
        }

    }
    catch(\Exception $ex)
    {
        flashMessage(__lang('payment-unsuccessful').$ex->getMessage());
        return redirect()->route('cart');
        // throw new \Exception('Error validating transaction. Please try again.');
    }

}

function carepro_ipn(){
    $code = 'payuin';

    $cart = getCart();

    $mode = paymentOption($code,'mode');
    $key = paymentOption($code,'merchant_key');
    $salt = paymentOption($code,'salt');

    $tid = $_POST["txnid"];
    $invId = substr($tid,stripos($tid,'-')+1);


    $invoice = \App\Invoice::find($invId);


    \Illuminate\Support\Facades\Auth::login($invoice->user);


    $status=$_POST["status"];
    $firstname=$_POST["firstname"];
    $amount=$_POST["amount"];
    $txnid=$_POST["txnid"];
    $posted_hash=$_POST["hash"];
    $key=$_POST["key"];
    $productInfo=$_POST["productinfo"];
    $email=$_POST["email"];
    $udf5 		  = "carepro";



    //check if transaction is successful
    If (isset($_POST["additionalCharges"])) {
        $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productInfo.'|'.$amount.'|'.$txnid.'|'.$key;
    } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productInfo.'|'.$amount.'|'.$txnid.'|'.$key;
    }

    $hash = hash("sha512", $retHashSeq);

    try{



        if(!($tid))
        {
            throw new \Exception(__lang('Invalid Transaction'));
        }


        if($amount  != floatval($invoice->amount)) {
            throw new \Exception(__lang("invalid-amount-rec"));
        }

        if ($hash != $posted_hash)
        {
            throw new \Exception(__lang('Payment failed!'));
        }
        else{
            $msg=  approveInvoice($invoice);
            successMessage($msg);
            return redirect()->route('user.billing.invoices');
        }

    }
    catch(\Exception $ex)
    {
        flashMessage(__lang('payment-unsuccessful').$ex->getMessage());
        return redirect()->route('cart');
        // throw new \Exception('Error validating transaction. Please try again.');
    }
}

function carepro_failure(){
    $tid = $_POST["txnid"];
    $invId = substr($tid,stripos($tid,'-'))+1;
    $invoice = \App\Invoice::find($invId);
    \Illuminate\Support\Facades\Auth::login($invoice->user);
    session(['invoice'=>$invId]);
    flashMessage(__lang('Payment failed!'));
    return redirect()->route('cart');
}
