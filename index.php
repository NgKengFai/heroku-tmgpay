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
        }

        .clearBoth {

            clear: both;
        }

        .boxCss {

            min-width: 45%;
            height: 55px;
            text-align: center;
            border: solid 1px #E9E9E9;
            margin: 8px 6px;
            border-radius: 3px;
        }

        .text-center {

            text-align: center;
        }

        .topUpCss {

            font-size: 7vw;
            color: #333333;
            display: block;
            margin-top: 30px;
            margin-bottom: 15vw;
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

        .pickAmountCss {

            text-align: left;
            margin: 30px 0px;
            padding-left: 10px;
        }

        .selectionOuter {

            position: relative;
            font-size: 4.5vw;
        }

        .selectionOuter span {

            margin-top: 2vw;
            display: inline-block;
        }

        .selection {

            width: 25px;
            position: absolute;
            left: -1px;
            display: none;
        }

        .icon-coin {

            width: 7.5vw;
            position: absolute;
            right: 5px;
            top: 5px;
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
            width: 55%;
            height: 12vw;
            font-size: 6vw;
            border: 0px;
            cursor: pointer;
        }

        .rmCss {

            color: #999999;
            margin-top: 0 !important;
        }

        .active {

            border-color: #FC382A;
        }

        .active .selectionOuter span {

            color: #FC382A;
        }

        .active .selection {

            display: block;
        }

        .requiredPhoneNumber {

            color: red;
            display: none;
        }

        .bottomRow1 {

            font-size: 20px;
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

            .areaCode {
                width: 50px;
            }

            .selectionOuter span {
                margin-top: 3px;
            }

            .selectionOuter {
                font-size: 18px;
            }

            .icon-coin {
                width: 30px;
            }

            .bottomRow2 {
                margin: 0px 27%;
                font-size: 30px;
            }

            .topUpButton {

                width: 51%;
                height: 50px;
                font-size: 28px;
            }

            .boxCss {
                cursor: pointer;
            }
        }
    </style>
</head>

<body>

    <div class="backgroundColor">

        <div class="text-center">

            <span class="topUpCss">Top Up</span>

            <div class="phoneDiv">
                <div class="pull-left areaCode">
                    <select id="countrycode">
						<option value="MY">+60</option>
						<option value="ID">+62</option>
						<option value="VN">+84</option>
						<option value="PI">+63</option>
					</select>
                </div>
                <div>
                    <input type="text" id="txtPhoneNo" class="txtPhoneNoCss" placeholder="Phone Number" maxlength="12" />
                </div>
            </div>
            <div>
                <span id="lblRequiredPhoneNumber" class="requiredPhoneNumber">Phone Number is Required</span>
            </div>

            <div class="pickAmountCss">
                <span>

                    Pick the amount you would like to top up
                </span>
            </div>
        </div>

        <div>
            <div class="boxCss pull-left active" onclick="select(event, 1)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>39 T-Coins</span>
                    <br />
                    <span class="rmCss">USD3.90</span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>

            <div class="boxCss pull-right" onclick="select(event, 2)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>169 T-Coins</span>
                    <br />
                    <span class="rmCss">USD16.90</span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>

            <div class="clearBoth"></div>

            <div class="boxCss pull-left" onclick="select(event, 3)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>579 T-Coins</span>
                    <br />
                    <span class="rmCss">USD57.90</span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>

            <div class="boxCss pull-right" onclick="select(event, 4)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>999 T-Coins</span>
                    <br />
                    <span class="rmCss">USD99.90</span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>

            <div class="clearBoth"></div>

            <div class="boxCss pull-left" onclick="select(event, 5)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>2999 T-Coins</span>
                    <br />
                    <span class="rmCss">USD299.90</span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>

            <div class="boxCss pull-right" onclick="select(event, 6)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>6999 T-Coins</span>
                    <br />
                    <span class="rmCss">USD699.90</span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>
        </div>

        <div class="bottomDiv">

            <div class="bottomRow1">Amount to Pay :</div>

            <div class="bottomRow2">

                <span id="lblRM">USD 0</span>
            </div>
            <div class="bottomRow3">

                <input type="button" class="topUpButton" value="Top Up" onclick="topup()" />
            </div>
        </div>

    </div>

    <script>

        var selections = jQuery(".boxCss"), txtPhoneNo = jQuery("#txtPhoneNo"), lblRequiredPhoneNumber = jQuery("#lblRequiredPhoneNumber");
        var coinData = { "1": "3.90", "2": "16.90", "3": "57.90", "4": "99.90", "5": "299.90", "6": "699.90" };
        var currentSelection;
		
		//set cookies function
					function setCookie(cname,cvalue) {
						var d = new Date();
						d.setTime(d.getTime() + (5*60*1000)); //set expiry time for the cookie
						var expires = "expires=" + d.toGMTString();
						document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
					}
					/*
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

					function checkCookie() {
						var user=getCookie("username");
						if (user != "") {
							alert("Welcome again " + user);
						} else {
						   user = prompt("Please enter your name:","");
						   if (user != "" && user != null) {
							   setCookie("username", user);
						   }
						}
					}*/
        (function () {

            Init()
        })();

        function Init() {

            selections[0].click();
        }

        function select(evt, type) {

            for (i = 0; i < selections.length; i++) {
                selections[i].className = selections[i].className.replace(" active", "");
            }

            evt.currentTarget.className += " active";
            currentSelection = type;

            jQuery("#lblRM").html("USD " + coinData[type]);
			setCookie("currency","USD");
			setCookie("value",coinData[type]);
			//localStorage.setItem("currency","USD");
			//localStorage.setItem("value",coinData[type]);
        }

        function topup() {
//to change for checking
            if (txtPhoneNo.val().length > 0) {
				var e = document.getElementById("countrycode");
				var countryCode = e.options[e.selectedIndex].value;
				setCookie("countrycode",countryCode);
				setCookie("phonenumber",txtPhoneNo.val());				
				//localStorage.setItem("countrycode",countryCode);
				//localStorage.setItem("phonenumber",txtPhoneNo.val());
                window.location.href = "PaymentType.html";
            }
            else {

                lblRequiredPhoneNumber.show();
            }
        }

        $(document).ready(function () {
            $("#txtPhoneNo").keydown(function (e) {

                lblRequiredPhoneNumber.hide();

                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        });

    </script>
</body>

</html>