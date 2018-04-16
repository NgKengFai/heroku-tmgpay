<?php
require "PayPalConfig.php";
	//ini_set('display_errors', 'On');
	//serror_reporting(E_ALL);
	/* Setting */

	//Option Configuration

	$payment_amount = $_POST['value'];
	$payment_description = "Tamago Top Up ".$_POST['tcoins']." t-coins";
	$payment_currency = $_POST['currency'];
	
	//Credential Configuration

	$token_url = "https://api.sandbox.paypal.com/v1/oauth2/token";
	$payment_experience_url = "https://api.sandbox.paypal.com/v1/payment-experience/web-profiles";
	$checkout_url = "https://api.sandbox.paypal.com/v1/payments/payment";

	$success_redirect_url = "https://tamago.live";
	$cancel_redirect_url = "https://tamago.live";
	$redirect_url = "/PaymentType.php";
	
	/* Access Token Retrieval*/

	//Header
	$headers = array();
	$headers[] = "Accept: application/json";

	//cURL Operation
	$ch = curl_init($token_url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_USERPWD, $clientID . ":" . $clientSecret);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	curl_close ($ch);
	
	$access_token = json_decode($result)->access_token;
	
	/* Set Web Experience */

	//Header
	$headers = array();
	$headers[] = "Content-Type: application/json";
	$headers[] = "Authorization: Bearer " . $access_token;

	//Body
	$body = '{
	    "name": "tmgProfile",
	    "input_fields": {
	        "no_shipping": 1,
	        "address_override": 1
	    }
	}';

	//cURL Operation
	$ch = curl_init($payment_experience_url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	curl_close ($ch);

	//Get Web Experience

	//cURL Operation
	$ch = curl_init($payment_experience_url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	curl_close ($ch);

	$web_experience_id = json_decode($result)[0]->id;

	/* Get Transaction ID From PayPal */

	//Header
	$headers = array();
	$headers[] = "Content-Type: application/json";
	$headers[] = "Authorization: Bearer " . $access_token;

	//to add negative testing
	//$headers[] = "PayPal-Mock-Response: {\"mock_application_codes\":\"INSTRUMENT_DECLINED\"}";

	//Body
	$body = '{
	  "intent": "sale",
	  "experience_profile_id": "' . $web_experience_id . '",
	  "redirect_urls": 
	  {
	    "return_url": "' . $redirect_url . '",
	    "cancel_url": "' . $cancel_redirect_url . '"
	  },
	  "payer":
	  {
	    "payment_method": "paypal"
	  },
	  "transactions": [
	  {
	    "amount":
	    {
	      "total": ' . $payment_amount . ',
	      "currency": "' . $payment_currency . '",
	      "details":
	      {
	        "subtotal": "' . $payment_amount . '"
	      }
	    },
	    "description": "' . $payment_description . '"
	  }]
	}';

	//cURL Operation
	$ch = curl_init($checkout_url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	curl_close ($ch);

	echo $result;
?>