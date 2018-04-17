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
 *                                     #############
 *                               ############
 *
 * Adyen Checkout Example (https://www.adyen.com/)
 *
 * Copyright (c) 2017 Adyen BV (https://www.adyen.com/)
 *
 * Author: Adyen
 */
require_once __DIR__ . '/lib/Client.php';
//date_default_timezone_set("Europe/Amsterdam"); //need to set correct time zone

?>

<!DOCTYPE html>
<html class="html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="robots" content="noindex"/>
    <title>Checkout Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript"
            src="https://checkoutshopper-test.adyen.com/checkoutshopper/assets/js/sdk/checkoutSDK.1.2.1.min.js"></script>
    <script src="assets/js/setupCall.js" type="text/javascript"></script>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="body">

<div><?php  
date_default_timezone_set('Asia/Singapore');
//setcookie("order_id",date("Ymdhis").mt_rand(1000,9999),time()+(5*60*1000),"/");
//echo $_COOKIE["order_id"]; ?></div>

<div class="content">


    <div class="checkout-container">
	<div id="order-id"></div>
        <div class="checkout" id="checkout">
            <!-- The checkout interface will be rendered here -->
			
        </div>
    </div>
</div>
<?php
$_POST['uid']=$_COOKIE['uid'];
$_POST['tcoin']=$_COOKIE['tcoin'];
$client = new Client();
$setupData = json_encode($client->setup());
//echo $_POST['uid'];
//echo $_POST['tcoins'];

?>
<script type="text/javascript">
	
    $(document).ready(function () {
        var data = <?php echo $setupData ?>;
        //console.log(data);
        initiateCheckout(data);
        chckt.hooks.beforeComplete = function (node, paymentData) {
            // `node` is a reference to the Checkout container HTML node.
            // `paymentData` is the result of the payment. Includes the `payload` variable,
            // which you should submit to the server for the Checkout API /verify call.
            console.log("test");
            $.ajax({
                url: 'verify.php',
                data: {payloadData: paymentData},
                method: 'POST',// jQuery > 1.9
                type: 'POST', //jQuery < 1.9
                success: function (data) {
                    console.log(data.additionalData);
					$("#order-id").html("<b>Order ID: </b>"+ data.merchantReference);
                    $("#checkout").html("<b>Payment Status: </b>"+ data.authResponse);
					console.log("Successful");
                },
                error: function () {
                    if (window.console && console.log) {
                        console.log('### adyenCheckout::error:: args=', arguments);
                    }
                }
            });

            return false; // Indicates that you want to replace the default handling.
        };
    });

</script>
<script type="text/javascript">
//$('.chckt-checkbox').prop('checked', "false");
//document.querySelector('.chckt-checkbox').setAttribute('checked', 'false');
//var docOrigin = document.location.origin || (document.location.protocol + "//" + document.location.host);
//console.log(docOrigin);
//console.log("Test");
</script>
</body>
</html>