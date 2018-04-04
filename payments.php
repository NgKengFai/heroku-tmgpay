<?php

// PayPal settings - Fill In These Correctly, Pass The Values From Respective Pages To Here
$return_url = 'https://payment.tamago.live/payment-successful.php'; //Redirect openly, user will see it, when success paid
$cancel_url = 'https://payment.tamago.live/payment-cancelled.php'; //Redirect openly, user will see it, when payment failed
$notify_url = 'https://payment.tamago.live/payments.php'; //Callback function to do backend updates when completed payment
$paypal_url = 'www.sandbox.paypal.com'; //Use www.paypal.com for live deployment
$trx_name = 'Tamago LIVE Top Up '.$_COOKIE["tcoins"].' t-coins'; //Remarks of Transaction
$trx_amount = $_COOKIE["value"]; //Amount To Pay
$trx_currency = $_COOKIE["currency"]; //Currency - Some currency only accept in-country payment, means the paypal account must be registered under that country, Refer to https://developer.paypal.com/docs/classic/api/currency_codes/ for more details
$trx_business_email = 'kf-facilitator@tamago.live'; //Email For Company PayPal Account (Business Account)

include("functions.php");

// Run before redirect to paypal for user to payment
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
    $querystring = '';

    $querystring .= "?business=".$trx_business_email."&";
    $querystring .= "item_name=".$trx_name."&";
    $querystring .= "amount=".$trx_amount."&";
    $querystring .= "currency_code=".$trx_currency."&";
    $querystring .= "no_shipping=1&";

    foreach($_POST as $key => $value){
        $value = urlencode(stripslashes($value));
        $querystring .= "$key=$value&";
    }

    $querystring .= "return=".urlencode(stripslashes($return_url))."&";
    $querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
    $querystring .= "notify_url=".urlencode($notify_url);

    header('location:https://'.$paypal_url.'/cgi-bin/webscr'.$querystring);
    exit();

} else {

    $req = 'cmd=_notify-validate';
    foreach ($_POST as $key => $value) {
        $value = urlencode(stripslashes($value));
        $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);
        $req .= "&$key=$value";
    }

    $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

    $fp = fsockopen ('ssl://'.$paypal_url, 443, $errno, $errstr, 30);

    if (!$fp) {

        // HTTP ERROR

    } else {
        fputs($fp, $header . $req);
        while (!feof($fp)) {
            $res = fgets ($fp, 1024);
            if (strcmp($res, "VERIFIED") == 0) {

                //Successfully made payment, Update DB Here

            } else if (strcmp ($res, "INVALID") == 0) {

                //Transaction invalid
                
            }
        }
    }
}

?>