<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
	//Transaction ID - Required For Refund
	//$_POST['payment']['transactions'][0]['related_resources'][0]['sale']['id'];

	//Status of The Payment, "approved" as successfully paid
	//$_POST['payment']['state'];

	//Payment ID
	//$payment_id = $_POST['payment']['id'];
	$payment_id = $_POST['paymentID'];
	$payer_id  = $_POST['payerID'];
	$uid = $_POST['uid'];
	//echo "The post details".$payment_id.$payer_id;
	//Transaction Amount
	//$_POST['payment']['transactions'][0]['amount']['currency'];

	//Transaction Currency
	//$_POST['payment']['transactions'][0]['amount']['total'];

	//Transaction Time
	//$_POST['payment']['create_time'];

	$execute_url = "https://api.sandbox.paypal.com/v1/payments/payment/".$payment_id."/execute/";	
	$token_url = "https://api.sandbox.paypal.com/v1/oauth2/token";
	
	//API Credentials - Can Be Generated at https://developer.paypal.com/developer/applications/create
	$clientID = "AXgrVs0H9QureJhIGNHrkTuQKWSnw3Yf0T82hi7DpiJpMAwbJ_8h6t-rAcasVZHiPC5J3X2DvekefJRq";
	$clientSecret = "EG75KBlg7zFwUtmyyICwupK5TDk-GLSuLeJE2t5PZTTGaqAxkSuFn0T_Z56hhNeLqCwfGdg1FR1OtlBg";

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
		"payer_id": "' . $payer_id . '"
	}';


	//cURL Operation
	$ch = curl_init($execute_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	curl_close ($ch);

	//echo $result;
	
	$res = json_decode($result, true);


//get data and add to database


$descriptor = $res['transactions'][0]['description'];
$state = $res['state'];
$invoice = substr($descriptor,-22);
$coins = substr($descriptor, strpos($descriptor, "Up")+3,-37);
$money = $res['transactions'][0]['amount']['total'];
$currency =  $res['transactions'][0]['amount']['currency'];
$createtime =  $res['create_time'];
$paypalid = $res['payer']['payer_info']['payer_id'];
$orderid = $res['transactions'][0]['related_resources'][0]['sale']['id'];

if (isset($state) && $state == 'approved'){
	require("config.php");
    //echo $state;
    //echo $res['id'];
    $query = '
    INSERT INTO `hm_money`.`money_topup`
(
`uid`,
`refno`,
`transactionid`,
`status`,
`tcoin`,
`money`,
`type`,
`paidts`,
`paypalid`,
`orderid`)
VALUES
(
"'.$uid.'",
"'.$payment_id.'",
"'.$invoice.'",
"1",
"'.$coins.'",
"'.$money.'",
"1",
"'.$createtime.'",
"'.$paypalid.'",
"'.$orderid.'"

)';
mysqli_query($db,$query) or die(mysqli_error($db));
$que1 = urlencode($invoice);
$que2 = $uid;

$que = "transactionid=$que1 &uid=$que2";
//echo $query;
$json = file_get_contents("http://api-v2-dev.tamago.tv/topup/money?".$que);
$response = json_decode($json, true);

	if ($response['status'] == 'success'){
		//$output = $response['message'];
		header('Location: /payment-successful.php?transactionid='.$invoice.'&status=approved&tcoin='.$coin.'&money='.$currency.$money);
	}

}else {
    echo "Transaction invalid"; 
}
