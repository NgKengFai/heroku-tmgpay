<?php
include "PayPalConfig.php";
	//Transaction ID - Required For Refund
	//$_POST['payment']['transactions'][0]['related_resources'][0]['sale']['id'];

	//Status of The Payment, "approved" as successfully paid
	//$_POST['payment']['state'];

	//Payment ID
	//$payment_id = $_POST['payment']['id'];
	$payment_id = $_POST['paymentID'];
	$payer_id  = $_POST['payerID'];
	
	//echo "The post details".$payment_id.$payer_id;
	//Transaction Currency
	$currency = $_POST['payment']['transactions'][0]['amount']['currency'];

	//Transaction Value
	$value = $_POST['payment']['transactions'][0]['amount']['total'];

	//Description
	$description =$_POST['payment']['transactions'][0]['description'];
	//Transaction Time
	//$_POST['payment']['create_time'];

	//get url params	
	$execute_url = "https://api.sandbox.paypal.com/v1/payments/payment/".$payment_id."/execute/";	
	$token_url = "https://api.sandbox.paypal.com/v1/oauth2/token";

	//API Credentials - Can Be Generated at https://developer.paypal.com/developer/applications/create
	//$clientID = "AXgrVs0H9QureJhIGNHrkTuQKWSnw3Yf0T82hi7DpiJpMAwbJ_8h6t-rAcasVZHiPC5J3X2DvekefJRq";
	//$clientSecret = "EG75KBlg7zFwUtmyyICwupK5TDk-GLSuLeJE2t5PZTTGaqAxkSuFn0T_Z56hhNeLqCwfGdg1FR1OtlBg";

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

	//Header
	$headers = array();
	$headers[] = "Content-Type: application/json";
	$headers[] = "Authorization: Bearer " . $access_token;

	//body
	$body = '{
		"payer_id": "' . $payer_id . '",

	}';


	//cURL Operation
	$ch = curl_init($execute_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	curl_close ($ch);

	echo $result;
?>