<?php
/**
 *                       ######
 *                       ######
 * ############    ####( ######  #####. ######  ############   ############
 * #############  #####( ######  #####. ######  #############  #############
 *        ######  #####( ######  #####. ######  #####  ######  #####  ######
 * ###### ######  #####( ######  #####. ######  #####  #####   #####  ######
 * ###### ######  #####( ######  #####. ######  #####          #####  ######
 * #############  #############  #############  #############  #####  ######
 *  ############   ############  #############   ############  #####  ######
 *                                      ######
 *                               #############
 *                               ############
 *
 * Adyen Checkout Example (https://www.adyen.com/)
 *
 * Copyright (c) 2017 Adyen BV (https://www.adyen.com/)
 *
 */
require_once __DIR__ . '/Order.php';
require_once __DIR__ . '/Config.php';

class Client
{

    public function setup()
    {
        $order = new Order();
		$order->init();
        $authentication = Config::getAuthentication();
        $url = Config::getSetupUrl();
        $request = array(
            /** All order specific settings can be found in payment/Order.php */

            'amount' => $order->getAmount(),
            'channel' => $order->getChannel(),
            'countryCode' => $order->getCountryCode(),
            'html' => $order->getHtml(),
            'shopperReference' => $order->getShopperReference(),
            'shopperLocale' => $order->getShopperLocale(),
            'reference' => $order->getReference(),
            'enableOneClick' => 'false',
            //'additionalData' => $this->additionalData(),
			//'shopper.telephoneNumber'=> , //modded

            /** All server specific settings can be found in config/Config.php */

            'origin' => Config::getOrigin(),
            'shopperIP' => Config::getShopperIP(),
            'returnUrl' => Config::getReturnUrl(),

            /** All merchant/authentication specific settings can be found in config/authentication.php */

            'merchantAccount' => $authentication['merchantAccount']
        );
        $data = json_encode($request);
            //print_r($data);
            //print_r($url);
            //print_r($authentication);
        return $this->doPostRequest($url, $data, $authentication);
    }


    public function verify($data)
    {
        $url = Config::getVerifyUrl();
        $authentication = Config::getAuthentication();
        return $this->doPostRequest($url, $data, $authentication);

        
    }

    /** Set up the cURL call to  adyen */
    private function doPostRequest($url, $data, $authentication)
    {
        //  Initiate curl
        $curlAPICall = curl_init();

        // Set to POST
        curl_setopt($curlAPICall, CURLOPT_CUSTOMREQUEST, "POST");

        // Will return the response, if false it print the response
        curl_setopt($curlAPICall, CURLOPT_RETURNTRANSFER, true);

        // Add JSON message
        curl_setopt($curlAPICall, CURLOPT_POSTFIELDS, $data);

        // Set the url
        curl_setopt($curlAPICall, CURLOPT_URL, $url);

        // Api key
        curl_setopt($curlAPICall, CURLOPT_HTTPHEADER,
            array(
                "X-Api-Key: " . $authentication['checkoutAPIkey'],
                "Content-Type: application/json",
                "Content-Length: " . strlen($data)
            )
        );

        // Execute
        $result = curl_exec($curlAPICall);

        // Closing
        curl_close($curlAPICall);

        // When this file gets called by javascript or another language, it will respond with a json object
        return $result;
    }

    public function sendtoDB() {
        require "config.php";
        $query = $query = '
        INSERT INTO `hm_money`.`money_topup`
        (
        `uid`,
        `transactionid`,
        `status`,
        `tcoin`,
        `money`,
        `type`,
        `paidts`
        )
        VALUES
        (
        "'.$_POST['uid'].'",
        "'.$order->getReference().'",
        "1",
        "'.$_POST['tcoins'].'",
        "'.$order->getAmount().'",
        "2",
        "'.date("Y-m-d H:i:s").'"
        )';
        
        mysqli_query($db,$query) or die(mysqli_error($db));
    
    }

    public function verifyPaymenttoDB(){
            $que1 = urlencode($order->getReference());
            $que2 = $_POST['uid'];
            $que = "transactionid=$que1 &uid=$que2";
            //echo $query;
            $json = file_get_contents("http://api-v2-dev.tamago.tv/topup/money?".$que);
            $response = json_decode($json, true);

            if ($response['status'] == 'success'){
                //$output = $response['message'];
                echo '/payment-successful.php?transactionid='.$invoice.'&status=approved&tcoin='.$coins.'&money='.$currency.$money;
		
	        }

    }

}

