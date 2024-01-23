<?php

require APPPATH . 'libraries/Razorpay/razorpay-php/Razorpay.php';

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


function makeOrder( $amount = 0, $receipt = null){
	$api = new Api(RAZORPAY_KEY, RAZORPAY_SECRET);
	$orderData = [
	    'receipt'         => $receipt,
	    'amount'          => (int) ($amount * 100), // rupees in paise
	    'currency'        => RAZORPAY_DISPLAY_CURRENCY,
	    'payment_capture' => 1 // auto capture
	];
	$razorpayOrder = $api->order->create($orderData);
	return $razorpayOrder;
}


function verifyOrder( $order_id='', $payment_id='', $signature='' ){

	if (empty($payment_id) === false)
	{
	    $api = new Api(RAZORPAY_KEY, RAZORPAY_SECRET);

	    try
	    {
	        $attributes = array(
	            'razorpay_order_id'   => $order_id,
	            'razorpay_payment_id' => $payment_id,
	            'razorpay_signature'  => $signature
	        );

	        $api->utility->verifyPaymentSignature($attributes);

	        return ["success" => true];
	    }
	    catch(SignatureVerificationError $e)
	    {
	        $error = 'Razorpay Error : ' . $e->getMessage();
	        return ["success" => false, "error" => $e->getMessage()];
	    }
	}

	return ["success" => false, "error" => 'payment id '.$payment_id.' not found'];

}