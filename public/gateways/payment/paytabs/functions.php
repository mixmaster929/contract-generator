<?php


use App\Invoice;

function carepro_pay($output){
    $code =  $output['code'];
    $invoice = $output['invoice'];
    $user = \Illuminate\Support\Facades\Auth::user();


    $billingAddress = $output['address'];

    if (!$billingAddress){
        return redirect()->route('user.billing-address.create');
    }

    $dialCode = getCountryDialCode($billingAddress->country->iso_code_2);

    //get list of products in cart
    $itemList = $invoice->title;




   // $output += compact('invoice','code','dialCode','itemList','transaction','user','successUrl','billingAddress','description');

  return view("payment.{$code}.views.pay",$output);
}

function carepro_send(){

    $invoiceId = session()->get('invoice');
    $invoice = Invoice::find($invoiceId);

    $code = $invoice->paymentMethod->code;
    $transaction = uniqid().'-'.$invoice->id;
    $billingAddress = billingAddress();

    $sessionKey = config('session.cookie') . '=' . session()->getId();
    $successUrl = route('user.callback',['code'=>$code,'tid'=>$transaction]);
    $description = $invoice->title;

    $profileID = paymentOption($code,'profile_id');
    $serverKey = paymentOption($code,'server_key');

    //create request
    $headers = array('Authorization'=>$serverKey,'content-type'=>'application/json');

    $data =[
        "profile_id" => $profileID,
        'tran_type'=>'sale',
        'tran_class'=>'ecom',
        'cart_description'=>$invoice->title,
        'cart_id'=>$transaction,
        'cart_currency'=>$billingAddress->country->currency_code,
        'cart_amount'=>$invoice->amount,
        //'callback'=>$successUrl,
        'return'=>$successUrl,
        'customer_details'=>[
            'name'=>$billingAddress->name,
            'email'=>$invoice->user->email,
            'street1'=>$billingAddress->address,
            'stree2'=>$billingAddress->address_2,
            'city'=>$billingAddress->city,
            'state'=>$billingAddress->state,
            'country'=>strtoupper($billingAddress->country->iso_code_2),
            'ip'=>getClientIp()
        ]

    ];

    $data = json_encode($data);

    $response = \Unirest\Request::post("https://secure-global.paytabs.com/payment/request",$headers,
        $data
    );

    if(isset($response) && !empty($response->body->redirect_url)){
        return redirect($response->body->redirect_url);
    }
    else{
        errorMessage(__lang('transaction-failed').': '.$response->body->message);
        return back();
    }

}

function carepro_callback(){

    $invoiceId = session()->get('invoice');
    $invoice = Invoice::find($invoiceId);
    $code = 'paytabs';
    $data = request()->all();

    $orderId = $data['cartId'];
    $transRef = $data['tranRef'];
    $profileID = paymentOption($code,'profile_id');
    // Profile Key (ServerKey)
    $serverKey = paymentOption($code,'server_key');; // Example

    // Request body include a signature post Form URL encoded field
    // 'signature' (hexadecimal encoding for hmac of sorted post form fields)
    $requestSignature = $_POST["signature"];
    unset($_POST["signature"]);
    $fields = $_POST;

    // Sort form fields
    ksort($fields);

    // Generate URL-encoded query string of Post fields except signature field.
    $query = http_build_query($fields);

    $signature = hash_hmac('sha256', $query, $serverKey);

/*    if (!hash_equals($signature,$requestSignature)==true) {
        // VALID Redirect
        // Do your logic
        errorMessage('Invalid Request'.': '.request()->respMessage);
        return redirect()->route('user.invoice.cart');
    }*/

        // VALID Redirect
        // Do your logic
        $headers = array('Authorization'=>$serverKey,'content-type'=>'application/json');

        $data =[
            "profile_id" => $profileID,
            'tran_ref'=>$transRef
        ];

        $data = json_encode($data);

        $response = \Unirest\Request::post("https://secure-global.paytabs.com/payment/query",$headers,
            $data
        );

        if($response->body->cart_amount != $invoice->amount){
            errorMessage(__lang('transaction-failed').': Invalid amount');
            return redirect()->route('user.invoice.cart');
        }

        if ($response->body->payment_result->response_status=='A') {
            $msg=  approveInvoice($invoice);
            successMessage($msg);
            return redirect()->route('user.billing.invoices');


        }else{
            errorMessage(__lang('transaction-failed').': '.request()->respMessage);
            return redirect()->route('user.invoice.cart');
        }


}

