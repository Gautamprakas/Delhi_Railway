<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Razorpay/razorpay-php/Razorpay.php';

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Razorpay_controller extends CI_Controller {


	function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}

	public function pay(){

		
		$json = json_encode($data);

		?>
		<button id="rzp-button1">Pay with Razorpay</button>
		<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
		<form name='razorpayform' action="<?php echo base_url("online_payment/verify"); ?>" method="POST">
		    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
		    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
		</form>
		<script>
		// Checkout details as a json
		var options = <?php echo $json?>;
		options.handler = function (response){
		    console.log(response);

		    /*document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
		    document.getElementById('razorpay_signature').value = response.razorpay_signature;
		    document.razorpayform.submit();*/
		};
		// Boolean whether to show image inside a white frame. (default: true)
		options.theme.image_padding = false;
		options.modal = {
		    ondismiss: function() {
		        console.log("This code runs when the popup is closed");
		    },
		    // Boolean indicating whether pressing escape key 
		    // should close the checkout form. (default: true)
		    escape: true,
		    // Boolean indicating whether clicking translucent blank
		    // space outside checkout form should close the form. (default: false)
		    backdropclose: false
		};

		var rzp = new Razorpay(options);

		document.getElementById('rzp-button1').onclick = function(e){
		    rzp.open();
		    e.preventDefault();
		}
		</script>
		<?php
		
	}

	public function verify(){

		$success = true;

		$error = "Payment Failed";

		if (empty($_POST['razorpay_payment_id']) === false)
		{
		    $api = new Api($this->keyId, $this->keySecret);

		    try
		    {
		        // Please note that the razorpay order ID must
		        // come from a trusted source (session here, but
		        // could be database or something else)
		        $attributes = array(
		            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
		            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
		            'razorpay_signature' => $_POST['razorpay_signature']
		        );

		        $api->utility->verifyPaymentSignature($attributes);
		    }
		    catch(SignatureVerificationError $e)
		    {
		        $success = false;
		        $error = 'Razorpay Error : ' . $e->getMessage();
		    }
		}

		if ($success === true)
		{
		    $html = "<p>Your payment was successful</p>
		             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
		}
		else
		{
		    $html = "<p>Your payment failed</p>
		             <p>{$error}</p>";
		}

		echo $html;
	
	}
}