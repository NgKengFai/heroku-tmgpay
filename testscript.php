<body>

    <script>
        res = '{"id":"PAY-5FJ8827089131380WLLKMVWA","intent":"sale","state":"approved","cart":"05F027234C460441U","payer":{"payment_method":"paypal","status":"VERIFIED","payer_info":{"email":"kf-buyer@tamago.live","first_name":"test","last_name":"buyer","payer_id":"MLJVAEDATALMW","country_code":"MY"}},"transactions":[{"amount":{"total":"1.50","currency":"SGD","details":{"subtotal":"1.50"}},"payee":{"merchant_id":"SNS4FYVN7U9TL","email":"kf-facilitator@tamago.live"},"description":"Tamago Top Up 40 t-coins","related_resources":[{"sale":{"id":"24C67304R4383535R","state":"completed","amount":{"total":"1.50","currency":"SGD","details":{"subtotal":"1.50"}},"payment_mode":"INSTANT_TRANSFER","protection_eligibility":"ELIGIBLE","protection_eligibility_type":"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE","transaction_fee":{"value":"0.55","currency":"SGD"},"parent_payment":"PAY-5FJ8827089131380WLLKMVWA","create_time":"2018-04-16T16:10:19Z","update_time":"2018-04-16T16:10:19Z","links":[{"href":"https://api.sandbox.paypal.com/v1/payments/sale/24C67304R4383535R","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v1/payments/sale/24C67304R4383535R/refund","rel":"refund","method":"POST"},{"href":"https://api.sandbox.paypal.com/v1/payments/payment/PAY-5FJ8827089131380WLLKMVWA","rel":"parent_payment","method":"GET"}],"soft_descriptor":"PAYPAL *TESTFACILIT"}}]}],"create_time":"2018-04-16T16:10:20Z","links":[{"href":"https://api.sandbox.paypal.com/v1/payments/payment/PAY-5FJ8827089131380WLLKMVWA","rel":"self","method":"GET"}]}';
        res = JSON.parse(res);
        console.log(res);
        console.log(res.id);
        console.log(res.state);
        console.log(res.payer["payer_info"].payer_id);
        console.log(res.transactions[0].related_resources[0].sale.id);
    </script>
<?php
echo mb_substr("TMG-201804160517173274",-22);

?>

</body>
