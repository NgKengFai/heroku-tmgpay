<body>

    <script>
        res = '{"id":"PAY-26W93683BM750625HLLKOEUY","intent":"sale","state":"approved","cart":"1JH07322P9601232A","payer":{"payment_method":"paypal","status":"VERIFIED","payer_info":{"email":"kf-buyer@tamago.live","first_name":"test","last_name":"buyer","payer_id":"MLJVAEDATALMW","country_code":"MY"}},"transactions":[{"amount":{"total":"1.50","currency":"SGD","details":{"subtotal":"1.50"}},"payee":{"merchant_id":"SNS4FYVN7U9TL","email":"kf-facilitator@tamago.live"},"description":"Tamago Top Up 1040 t-coins. Ref: TMG-201804160550109033","related_resources":[{"sale":{"id":"1MR16665E5133993V","state":"completed","amount":{"total":"1.50","currency":"SGD","details":{"subtotal":"1.50"}},"payment_mode":"INSTANT_TRANSFER","protection_eligibility":"ELIGIBLE","protection_eligibility_type":"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE","transaction_fee":{"value":"0.55","currency":"SGD"},"parent_payment":"PAY-26W93683BM750625HLLKOEUY","create_time":"2018-04-16T17:50:31Z","update_time":"2018-04-16T17:50:31Z","links":[{"href":"https://api.sandbox.paypal.com/v1/payments/sale/1MR16665E5133993V","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v1/payments/sale/1MR16665E5133993V/refund","rel":"refund","method":"POST"},{"href":"https://api.sandbox.paypal.com/v1/payments/payment/PAY-26W93683BM750625HLLKOEUY","rel":"parent_payment","method":"GET"}],"soft_descriptor":"PAYPAL *TESTFACILIT"}}]}],"create_time":"2018-04-16T17:50:31Z","links":[{"href":"https://api.sandbox.paypal.com/v1/payments/payment/PAY-26W93683BM750625HLLKOEUY","rel":"self","method":"GET"}]}';
        res = JSON.parse(res);
        console.log(res);
        console.log(res.id);
        console.log(res.state);
        console.log(res.payer["payer_info"].payer_id);
        console.log(res.transactions[0].related_resources[0].sale.id);
    </script>
<?php
include "config.php";
$res = '{"id":"PAY-26W93683BM750625HLLKOEUY","intent":"sale","state":"approved","cart":"1JH07322P9601232A","payer":{"payment_method":"paypal","status":"VERIFIED","payer_info":{"email":"kf-buyer@tamago.live","first_name":"test","last_name":"buyer","payer_id":"MLJVAEDATALMW","country_code":"MY"}},"transactions":[{"amount":{"total":"1.50","currency":"SGD","details":{"subtotal":"1.50"}},"payee":{"merchant_id":"SNS4FYVN7U9TL","email":"kf-facilitator@tamago.live"},"description":"Tamago Top Up 10 t-coins. Ref: TMG-201804160550109033","related_resources":[{"sale":{"id":"1MR16665E5133993V","state":"completed","amount":{"total":"1.50","currency":"SGD","details":{"subtotal":"1.50"}},"payment_mode":"INSTANT_TRANSFER","protection_eligibility":"ELIGIBLE","protection_eligibility_type":"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE","transaction_fee":{"value":"0.55","currency":"SGD"},"parent_payment":"PAY-26W93683BM750625HLLKOEUY","create_time":"2018-04-16T17:50:31Z","update_time":"2018-04-16T17:50:31Z","links":[{"href":"https://api.sandbox.paypal.com/v1/payments/sale/1MR16665E5133993V","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v1/payments/sale/1MR16665E5133993V/refund","rel":"refund","method":"POST"},{"href":"https://api.sandbox.paypal.com/v1/payments/payment/PAY-26W93683BM750625HLLKOEUY","rel":"parent_payment","method":"GET"}],"soft_descriptor":"PAYPAL *TESTFACILIT"}}]}],"create_time":"2018-04-16T17:50:31Z","links":[{"href":"https://api.sandbox.paypal.com/v1/payments/payment/PAY-26W93683BM750625HLLKOEUY","rel":"self","method":"GET"}]}';
$res = json_decode($res, true);

//get data
$descriptor = $res['transactions'][0]['description'];
$state = $res['state'];
$uid = 100008;
$invoice = mb_substr($descriptor,-22);
$coins = mb_substr($descriptor, strpos($descriptor, "Up")+3,-37);
$money = $res['transactions'][0]['amount']['total'];
$currency =  $res['transactions'][0]['amount']['currency'];
$createtime =  $res['create_time'];
$paypalid = $res['payer']['payer_info']['payer_id'];
$orderid = $res['transactions'][0]['related_resources'][0]['sale']['id'];

if (isset($state) && $state == 'approved'){
    //echo $state;
    //echo $res['id'];
    $query = "
    INSERT INTO `hm_money`.`money_topup`
(
`uid`,
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
'".$uid."'
'".$invoice."',
'1',
'".$coins."',
'".$money."',
'1',
'".$createtime."',
'".$paypalid."',
'".$orderid."';
    ";
//echo $query;
    mysqli_query($db,$query);
}else {
    return;
}
?>

</body>
