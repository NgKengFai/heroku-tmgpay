<!DOCTYPE html>
<html>


<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

            /* background-color: #656565; */
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
            top: 12px;
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
					<select id="countrycode" class="countrycode" style="width:55px;" onchange="currencyChange()">
								<option value=''>--</option>
								<?php
 									$json=file_get_contents("http://api-v2.tamago.tv//mobile/mobileAreaCodes.html");
									$data =  json_decode($json,true);


								try{
									 if (!empty($data['data']['code_maps'])) {

										foreach ($data['data']['code_maps'] as $code_maps) {
											
											echo "<option data-display='$code_maps[country] $code_maps[area]' value='$code_maps[area]'>$code_maps[country] $code_maps[area]</option>";
											
										}


									} 
									else{
										echo "empty";
									}
								}
								catch(Exception $e){
									echo $e; 
								}
								?>
					</select> 
                </div>
                <div>
                    <input type="text" id="txtPhoneNo" class="txtPhoneNoCss" placeholder="Phone Number" maxlength="12" onBlur="checkAvailability()"/>
					<p><span id="phone-status"></span></p>
                </div>
				<p><img src="LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
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
                    <span>40 T-Coins</span>
                    <br />
                    <span class="rmCss"><span id="currency1">USD</span><span id="payvalue1">1</span></span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>

            <div class="boxCss pull-right" onclick="select(event, 2)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>410 T-Coins</span>
                    <br />
                    <span class="rmCss"><span id="currency2">USD</span><span id="payvalue2">10</span></span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>

            <div class="clearBoth"></div>

            <div class="boxCss pull-left" onclick="select(event, 3)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>840 T-Coins</span>
                    <br />
                    <span class="rmCss"><span id="currency3">USD</span><span id="payvalue3">20</span></span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>

            <div class="boxCss pull-right" onclick="select(event, 4)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>1,060 T-Coins</span>
                    <br />
                    <span class="rmCss"><span id="currency4">USD</span><span id="payvalue4">25</span></span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>

            <div class="clearBoth"></div>

            <div class="boxCss pull-left" onclick="select(event, 5)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>3,300 T-Coins</span>
                    <br />
                    <span class="rmCss"><span id="currency5">USD</span><span id="payvalue5">75</span></span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>

            <div class="boxCss pull-right" onclick="select(event, 6)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>7,850 T-Coins</span>
                    <br />
                    <span class="rmCss"><span id="currency6">USD</span><span id="payvalue6">175</span></span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>
			
			<div class="clearBoth"></div>
			
            <div class="boxCss pull-left" onclick="select(event, 7)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>11,500 T-Coins</span>
                    <br />
                    <span class="rmCss"><span id="currency7">USD</span><span id="payvalue7">250</span></span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>
			
            <div class="boxCss pull-right" onclick="select(event, 8)">
                <div class="selectionOuter">
                    <img class='selection' src='img/T-coins-02.png'>
                    <span>60,000 T-Coins</span>
                    <br />
                    <span class="rmCss"><span id="currency8">USD</span><span id="payvalue8">1,250</span></span>
                    <img class='icon-coin' src='img/T-coins-01.png'>
                </div>
            </div>			
        </div>

        <div class="bottomDiv">

            <div class="bottomRow1">Amount to Pay :</div>

            <div class="bottomRow2">

                <span id="currency9">USD</span><span id="lblRM"> 0</span>
            </div>
            <div class="bottomRow3">

                <input type="button" id="submit-button" class="topUpButton" value="Top Up" onclick="topup()" />
            </div>
        </div>

    </div>

    <script>
		//blur for prefixes
		$('select').on('blur focus', function (e) {
				$(this.options).text(function () {
					return e.type === 'focus' ? this.getAttribute('data-default-text') : this.value;
				});
		}).children().attr('data-default-text', function () {
					return this.textContent;
		}).end().on('change', function () {
						$(this).blur();
						console.log(document.getElementById("lblRM").innerHTML);
		}).blur();
		
		//disable button from the start
		$('#submit-button').prop('disabled',true).css('opacity',0.5);
        var selections = jQuery(".boxCss"), txtPhoneNo = jQuery("#txtPhoneNo"), lblRequiredPhoneNumber = jQuery("#lblRequiredPhoneNumber");
        var coinData = { "1": "1", "2": "10", "3": "20", "4": "25", "5": "75", "6": "175", "7": "250","8": "1,250" };
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

            //selections[0].click();
        }

        function select(evt, type) {

            for (i = 0; i < selections.length; i++) {
                selections[i].className = selections[i].className.replace(" active", "");
            }

            evt.currentTarget.className += " active";
            currentSelection = type;

            jQuery("#lblRM").html(" " + coinData[type]);
			
			//window.sessionStorage.currency = coinData[type];
			//window.sessionStorage.value = "USD";
			
			//setCookie("currency","USD");
			setCookie("value",coinData[type]);
			//localStorage.setItem("currency","USD");
			//localStorage.setItem("value",coinData[type]);
			$('#submit-button').prop('disabled',false).css('opacity',1);
        }
		
		//the final step
        function topup() {
			//to change for checking
			if (document.getElementById("countrycode").value ==''){
				$('#phone-status').css('color', 'red');
				$('#submit-button').prop('disabled',true).css('opacity',0.5);
				content= "Select Your country prefix";
				$("#phone-status").html(content);
			}else{
			//console.log(document.getElementById("lblRM").innerHTML);			
				if (document.getElementById("lblRM").innerHTML ==' -'){
					content= "Select your top up value";
					$("#phone-status").html(content);
					$('#submit-button').prop('disabled',true).css('opacity',0.5);						
				}else{
					$('#submit-button').prop('disabled',false).css('opacity',1);				
			
						if (txtPhoneNo.val().length > 0) {
							var e = document.getElementById("countrycode");
							var countryCode = e.options[e.selectedIndex].value;
							//window.sessionStorage.countrycode= countryCode;
							//window.sessionStorage.phonenumber = txtPhoneNo.val();
							setCookie("countrycode",countryCode);
							setCookie("phonenumber",txtPhoneNo.val());				
							//localStorage.setItem("countrycode",countryCode);
							//localStorage.setItem("phonenumber",txtPhoneNo.val());
							window.location.href = "PaymentType.php"; //change to redirect using redirect plugin
						}else {

							lblRequiredPhoneNumber.show();
						}
				}
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
		
/* 		function showFields(){  
				function addNewData() {
					var data;
					  $.ajax({
						 type: "POST",
						 url: "option.php",
						 data: {},
						 success: function(data){
							var content = '<select id="countrycode" class="countrycode" style="width:55px;" onchange="currencyChange()" onclick="showFields()">';
							//alert(data);
							//console.log(data);
							//content += '<select id="areacode_'+i+'" name="areacode_'+i+'" class="areacode_list"><option value="" >--- Select ---</option>"';
							//populate list into options select
							content += data;
							//content += '</select></br>';
							//console.log(content);
							content += '</select>';
							$("#countrycode").html(content);
							
						 }
						});
					}                  
				
				addNewData();
				
		} */
		
		
		//replaces label for options
/* 		function showDisplayValue(e) {
		  var options = e.target.options,
			  option = e.target.selectedOptions[0],
			  i;
		  
		  // reset options
		  for (i = 0; i < options.length; ++i) {
			options[i].innerText = options[i].getAttribute('data-display');
		  }
		  
		  // change the selected option's text to its `value` attribute value
		  option.innerText = option.getAttribute('value');
		} */

		//document.getElementById('countrycode').addEventListener('change', showDisplayValue, false);
		
		function currencyChange(){
			
			var x = document.getElementById("countrycode").value;
			
			if (x == "+60" ){
				currency ="RM";
				coinData = { "1": "4", "2": "40", "3": "80", "4": "100", "5": "300", "6": "700","7": "1,000","8": "5,000" };
				for (i = 1; i <= 8; i++) { 
				document.getElementById("payvalue"+ i).innerHTML = coinData[i];
				}
				y = currency;							
			}else if (x == "+84")	{
				//vietnam
				currency ="VND";
				coinData = { "1": "21,600", "2": "216,000", "3": "432,000", "4": "540,000", "5": "1,620,000", "6": "3,780,000", "7": "5,400,000","8": "27,000,000" };
				for (i = 1; i <= 8; i++) { 
				document.getElementById("payvalue"+ i).innerHTML = coinData[i];
				}
				y = currency;
			}else if (x == "+62")	{
				//indonesia
				currency ="IDR";
				coinData = { "1": "13,200", "2": "132,000", "3": "264,000", "4": "330,000", "5": "990,000", "6": "2,310,000","7": "3,300,000","8": "16,500,000" };
				for (i = 1; i <= 8; i++) { 
				document.getElementById("payvalue"+ i).innerHTML = coinData[i];
				}
				y = currency;
			}else if (x == "+65")	{
				//singapore
				currency ="SGD";
				coinData = { "1": "1.50", "2": "13", "3": "25", "4": "35", "5": "100", "6": "230", "7": "330","8": "1,650" };
				for (i = 1; i <= 8; i++) { 
				document.getElementById("payvalue"+ i).innerHTML = coinData[i];
				}
				y = currency;
			}else if (x == "+63")	{
				//phil
				currency ="PHP";
				coinData = { "1": "50", "2": "500", "3": "995", "4": "1,245", "5": "3,730", "6": "8,700","7": "12,450","8": "62,100" };
				for (i = 1; i <= 8; i++) { 
				document.getElementById("payvalue"+ i).innerHTML = coinData[i];
				}
				y = currency;				
			}else{
				currency ="USD";
				coinData = { "1": "1", "2": "10", "3": "20", "4": "25", "5": "75", "6": "175", "7": "250","8": "1,250" };
				for (i = 1; i <= 8; i++) {					
				document.getElementById("payvalue"+ i).innerHTML = coinData[i];
				}
				y = currency;				
			}
				document.getElementById("currency1").innerHTML = currency;
				document.getElementById("currency2").innerHTML = currency;
				document.getElementById("currency3").innerHTML = currency;
				document.getElementById("currency4").innerHTML = currency;
				document.getElementById("currency5").innerHTML = currency;
				document.getElementById("currency6").innerHTML = currency;
				document.getElementById("currency7").innerHTML = currency;
				document.getElementById("currency8").innerHTML = currency;
				document.getElementById("currency9").innerHTML = currency;
			
			//param value
			setCookie("currency",y);
			jQuery("#lblRM").html(" -" );
			for (i = 0; i < selections.length; i++) {
                selections[i].className = selections[i].className.replace(" active", "");
            }
			$('#submit-button').prop('disabled',false).css('opacity',1);
			//document.getElementById('countrycode').addEventListener('change', showDisplayValue, false);
		}
		
			

			
			
			function checkAvailability() {
				$("#loaderIcon").show();
				jQuery.ajax({
				url: "https://api.tamago.live/verify?phone="+$("#txtPhoneNo").val(),
				data:$("#txtPhoneNo").val(),
				type: "POST",
				success:function(data){
					//console.log(data.data);
					if (data.data != ''){
						content = "Your phone number is eligible to pay";
						$('#phone-status').css('color', 'green');
						//$('#submit-button').attr('disabled',false);
						$('#submit-button').prop('disabled',false).css('opacity',1);
						
					}else{
						content = "Your phone number is not in our system";
						$('#phone-status').css('color', 'red');
						//$('#submit-button').attr('disabled',true);
						$('#submit-button').prop('disabled',true).css('opacity',0.5);
					}
				$("#phone-status").html(content);
				$("#loaderIcon").hide();
				},
				error:function (){}
				});
			}
    </script>
</body>

</html>