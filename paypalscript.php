<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>

<body>
    
    <div id="paypal-button"></div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>

        paypal.Button.render({

            env: 'sandbox',

            commit: true,
        
            payment: function(data, actions) {

                return paypal.request.post('/create-payment.php').then(function(res) {
                    return res.id;
                });
            },

            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function(payment) {
                    console.log(payment);

                    $.ajax({
                        type: "POST",
                        url: "/execute-payment.php",
                        data: ({ "payment": payment }),
                        success: function(data) {
                            alert("Success!");
                        },
                        error: function() {
                            
                        }
                    });
                });
            },

            onCancel: function(data, actions) {

                alert("Payment Cancelled!");
            }

        }, '#paypal-button');
    </script>
</body>

</html>
