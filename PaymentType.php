<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <style>
        .backgroundColor {

            max-width: 500px;
            font-family: 'Nunito', sans-serif;
            margin-left: auto;
            margin-right: auto;
			display:block;
        }

        .clearBoth {

            clear: both;
        }

        .boxCss {
            min-width: 47%;
            min-height: 125px;
            height: 35vw;
            text-align: center;
            border: solid 2px #979797;
            margin: 8px 0px;
            border-radius: 10px;
            width: 200px; /** added for moz support */
        }

        .text-center {

            text-align: center;
        }

        .topUpCss {

            font-size: 7vw;
            color: #333333;
            display: block;
            margin-top: 30px;
            margin-bottom: 10vw;
            font-weight: bold;
        }

        .pull-left {

            float: left;
        }

        .pull-right {

            float: right;
        }

        .phoneDiv {

            background-color: whitesmoke;
            border-radius: 5px;
            margin: 10px 8%;
            height: 35px;
        }

        .areaCode {

            background-color: #656565;
            width: 11vw;
            color: white;
            float: left;
            height: 22px;
            margin: 7px 10px;
        }

        .areaCode span {

            padding-top: 2px;
            display: block;
        }

        .txtPhoneNoCss {

            margin-top: 6px;
            width: 70%;
            background-color: transparent;
            border: none;
            height: 20px;
        }

        .txtPhoneNoCss:focus {
            outline: none;
        }

        .wishpayCss {

            text-align: center;
            margin: 30px 0px;
            font-size: 6vw;
        }

        .selectionOuter {

            position: relative;
            font-size: 4vw;
            margin-left: 20px;
            width: 75%;
        }

        .selectionOuter span {

            /* margin-top: 5vw; */
            display: inline-block;
        }

        .selection {

            width: 25px;
            position: absolute;
            left: -1px;
            display: none;
        }

        .paypal-icon {

            width: 24vw;
            display: block;
            margin-left: 4vw;
            margin-top: 3vw;
        }

        .visa-icon {

            width: 35vw;
            display: block;
            margin-left: -5vw;
            margin-top: 3vw;
        }

        .bottomDiv {

            clear: both;
            text-align: center;
            min-height: 200px;
        }

        .bottomRow1 {

            font-size: 6vw;
            padding-top: 30px;
            padding-bottom: 5px;
        }

        .bottomRow2 {

            margin: 0 18%;
            padding: 10px;
            border: solid 1px #E9E9E9;
            border-radius: 3px;
            color: #FC382A;
            font-weight: bold;
            font-size: 8vw;
        }

        .bottomRow3 {

            padding-top: 20px;
        }

        .topUpButton {

            background-color: #5EBFB8;
            border-radius: 5px;
            color: white;
            width: 65%;
            height: 12vw;
            font-size: 6vw;
            border: 0px;
            opacity: 0.5;
        }

        .rmCss {
            float:left;
            color: #999999;
            margin-top: 3vw !important;
        }

        .active {

            border-color: #2DC8A8;
        }

        .active .checkBox {

            background-color: #2DC8A8;
            border-color: #2DC8A8;
        }

        .checkBox {

            width: 15px;
            height: 15px;
            border: solid 2px #979797;
            border-radius: 2px;
            margin-top: 15px;
            margin-left: 7px;
        }

        .spanTitle {

            font-weight: bold;
        }
    </style>

    <style>
        @media only screen and (min-width: 360px) {

            .selectionOuter span {
                margin-top: 1vw;
            }

            .selectionOuter {
                font-size: 4vw;
            }
        }

        @media only screen and (min-width: 500px) {

            .topUpCss {

                font-size: 30px;
                margin-top: 50px;
                margin-bottom: 50px;
            }

            .wishpayCss {

                font-size: 35px;
            }

            .selectionOuter span {
                margin-top: 13px;
            }

            .selectionOuter {
                font-size: 18px;
            }

            .boxCss {
                height: 170px;
                cursor: pointer;
            }

            .paypal-icon,
            .visa-icon {
                width: 150px;
                margin-left: 0;
                margin-top: 0;
            }

            .rmCss {

                margin-top: 1vw !important;
            }

            .bottomRow3 {
                padding-top: 50px;
            }

            .topUpButton {

                width: 30%;
                height: 50px;
                font-size: 30px;
            }
        }
		
		#paypal-button-container{
		display:none;
		text-align:center;	
		}		
		
		#paypal-header{
		display:none;
		text-align:center;	
		}
    </style>
    <!--Paypal Checkout Script-->
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>

<body>

    <div id="payment" class="backgroundColor" style="">

        <div class="text-center">

            <span class="topUpCss">Payment</span>

            <div class="wishpayCss">
                <span>

                    How do you wish to pay?
                </span>
            </div>
        </div>

        <div>

            <div class="boxCss pull-left" onclick="selectPayment(event, 1);">
                <div class="pull-left">
                    <div class="checkBox">
                    </div>
                </div>

                <div class="selectionOuter pull-left">
                    <span class="spanTitle">PayPal</span>
                    <br />
                    <span class="rmCss">Safe & Secure
                        <br/>Payment</span>
                    <img class='paypal-icon' src='img/bank-icon-01.png'>
                </div>
            </div>

            <div class="boxCss pull-right" onclick="selectPayment(event, 2);">
                <div class="pull-left">
                    <div class="checkBox">
                    </div>
                </div>

                <div class="selectionOuter pull-left">
                    <span class="spanTitle">Debit/Credit Card</span>
                    <br />
                    <span class="rmCss">Visa, Mastercard,
                        <br/>JCB, Amex</span>
                    <img class='visa-icon' src='img/bank-icon-02.png'>
                </div>
            </div>

<!--            <div class="clearBoth"></div>

             <div class="boxCss pull-left" onclick="select(event, 3)">
                <div class="pull-left">
                    <div class="checkBox">
                    </div>
                </div> -->

<!--                 <div class="selectionOuter pull-left">
                    <span class="spanTitle">Online Banking</span>
                    <br />
                    <span class="rmCss">Online Banking</span>
                </div> -->

            </div>
        </div>

        <div class="bottomDiv">

            <div class="bottomRow3">

                <!-- <form id="PayPalForm" class="paypal" action="payments.php" method="post" id="paypal_form" target="_self">
                    <input type="hidden" name="cmd" value="_xclick" />
                    <input type="hidden" name="no_note" value="1" />
                </form> -->
                <!-- <div id="paypal-header"> -->
                <!-- <input type="button" name="submit" style="background-color: red; color: white;" value="Pay With Paypal (Use This Button To Pay, Can Customize Into Preferred Design)" onclick="payWithPayPal()"/> -->
                    <!-- <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" onclick="payWithPayPal()"/>
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">   -->
                    
                    <div id="paypal-header">Please click here to pay:</div>
                    <div id="paypal-button-container"></div>
                <!-- </div> -->
                <div><input id="btnPay" type="button" class="topUpButton" value="Top Up" onclick="pay()" /></div>
            </div>
        </div>
		<div id="error">-</div>
    </div>

    
    <script>
			paypal.Button.render({

env: 'sandbox',

commit: true,

style: {
        layout: 'vertical',
        size: 'medium',
        color: 'blue',
        shape: 'rect'
    },
    // Specify allowed and disallowed funding sources
        //
        // Options:
        // - paypal.FUNDING.CARD
        // - paypal.FUNDING.CREDIT
        // - paypal.FUNDING.ELV

        funding: {
            allowed: [ paypal.FUNDING.CARD ],
            disallowed: [paypal.FUNDING.CREDIT ]
        },

payment: function(data, actions) {

    return paypal.request.post('/create-payment.php',{value: value, currency: currency, tcoins: getCookie("tcoins") }).then(function(res) {
        return res.id;
    });
},

onAuthorize: function(data, actions) {
    var data = {
                    paymentID: data.paymentID,
                    payerID: data.payerID
                };
    //return actions.payment.execute().then(function(payment) {
        //console.log(data);
        return paypal.request.post("/execute-payment.php", data)
                    .then(function (res) {
        // $.ajax({
        //     type: "POST",
        //     url: ,
        //     data: data ,
        //     success: function(res) {
                //console.log(data);
                //alert("Payment is Completed");
                //console.log(data);
                //window.location.href = "/payment-successful.php";
                console.log(res);
                console.log(res.id);
                console.log(res.payer.state);
                console.log(res.payer.payer_info.payer_id);
                console.log(res.transactions.0.related_resources.sale.id);
            // },
            // error: function(err) {
                
            // }

        //});
    });
},

onCancel: function(data, actions) {

    alert("Payment Cancelled. Please retry again or with another payment method.");
},

onError: function(err) {
            // Show an error page here, when an error occurs
            //window.location.href = "/error.php";
            console.log("You have an error "+err.message);
            document.getElementById("error").innerHTML = "You have an error "+err.message;
        }

}, '#paypal-button-container');
	
					
		//console.log(getCookie("value"));
		//console.log(getCookie("currency"));
		//console.log(getCookie("phonenumber"));
		//console.log(getCookie("countrycode"));
        var currentSelection, selections = jQuery(".boxCss"), btnPay = jQuery("#btnPay");
		
		//retrieve cookie data
		function getCookie(cname) {
			var name = cname + "=";
			var decodedCookie = decodeURIComponent(document.cookie);
			var ca = decodedCookie.split(';');
			for(var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
		}

		//delete cookie
		function delete_cookie(name) {
			document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
		}
			
		function deleteAllCookies() {
			var cookies = document.cookie.split(";");

			for (var i = 0; i < cookies.length; i++) {
				var cookie = cookies[i];
				var eqPos = cookie.indexOf("=");
				var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
				document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
		}
    }
    (function () {

Init()
})();

function Init() {

//selections[0].click();
}

        function selectPayment(evt, type) {

            for (i = 0; i < selections.length; i++) {
                selections[i].className = selections[i].className.replace(" active", "");
            }

            evt.currentTarget.className += " active";
            currentSelection = type;

            btnPay.css("opacity", "1");
			
				if (currentSelection == 1){
				console.log(currentSelection);
				document.getElementById("btnPay").style.display = 'none';
					document.getElementById("paypal-header").style.display = 'block';
					document.getElementById("paypal-button-container").style.display = 'block';
					//document.getElementById("payment").style.display = 'none';
					value = getCookie("value");
					select = getCookie("select");
					
					coinData = { "1": "1", "2": "10", "3": "20", "4": "25", "5": "75", "6": "175", "7": "250","8": "1,250" };
					coinDataSG = { "1": "1.50", "2": "13", "3": "25", "4": "35", "5": "100", "6": "230", "7": "330","8": "1,650" };	
                        if (getCookie("currency")=="VND"){
							currency ="USD";
							value = coinData[select];
						}else if (getCookie("currency") == "IDR"){
							currency ="USD";
							value = coinData[select];
                        }else if (getCookie("currency") == "MYR"){
							currency ="SGD";
							value = coinDataSG[select];
						} else {
							currency = getCookie("currency");
						}
				}else{
				console.log(currentSelection);
				document.getElementById("btnPay").style.display = 'inline';
					document.getElementById("paypal-header").style.display = 'none';
					document.getElementById("paypal-button-container").style.display = 'none';
				}
        }

        function pay() {

            if (currentSelection > 0) {

                console.log(currentSelection);
				//localStorage.setItem("paymentmethod",currentSelection);
                // jQuery("#btnPay").prop("disabled", true);
				
				
				//if current selection is 1 go to paypal
				if (currentSelection == 1){
					document.getElementById("paypal-header").style.display = 'block';
					document.getElementById("paypal-button-container").style.display = 'block';
					//document.getElementById("payment").style.display = 'none';
				}
				//if current selection is 2 go to adyen
				else if (currentSelection ==2){
				window.location.href = "payment.php";
				}
				
            }
        }

        // function payWithPayPal() {
        //     document.getElementById("PayPalForm").submit();
        // }

    </script>
</body>

</html>
