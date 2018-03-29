<!DOCTYPE html>
<html>


<head>
	<meta name="referrer" content="no-referrer"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<script src="jquery.redirect.js"></script>
    <style>


    </style>
	<link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

    <div class="backgroundColor">

        <div class="text-center">
			<img class="logo" src="logo.png">
            <span class="topUpCss"> </img> Redeem</span>

            <div class="phoneDiv" id="phoneDiv">
                <div class="pull-left areaCode">
					<select id="countrycode" class="countrycode" style="width:55px;" onchange="">
								<option value=''>--</option>
								<?php
$json = file_get_contents("http://api-v2.tamago.tv//mobile/mobileAreaCodes.html");
$data = json_decode($json, true);

try {
    if (!empty($data['data']['code_maps'])) {

        foreach ($data['data']['code_maps'] as $code_maps) {

            echo "<option data-display='$code_maps[country] $code_maps[area]' value='$code_maps[area]'>$code_maps[country] $code_maps[area]</option>";

        }

    } else {
        echo "empty";
    }
} catch (Exception $e) {
    echo $e;
}
?>
					</select>
                </div>
                <div>
                    <input type="text" id="txtPhoneNo" class="txtPhoneNoCss" placeholder="Phone Number without zero in front" maxlength="12" onBlur="checkAvailability()"/>
					<p><span id="phone-status"></span></p>
                </div>
				<p><img src="LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
            </div>
            <div>
                <span id="lblRequiredPhoneNumber" class="requiredPhoneNumber">Phone Number is Required</span>
            </div>

            <div class="pickAmountCss">
                <span>


                </span>
            </div>
        </div>

       <input id="inputCode" class="bottomRow2" type="text" name="code" placeholder="Enter your code here"><br>
			<div class="redeemStatus"></div>
        <div class="bottomDiv">

           <!-- <div class="bottomRow1">Amount to Pay :</div>

            <div class="bottomRow2">

                <span id="currency9">USD</span><span id="lblRM"> 0</span>
            </div>-->
            <div class="bottomRow3">
				<span id="topup-status"></span>
                <input type="button" id="submit-button" class="topUpButton" value="Redeem" onclick="topup()" />
            </div>
        </div>

	</div>
	<div class="redeemMessage"></div>
	<div class="userImg">
			</div>
			<div class="userName"></div>
			<div id="topupPhone" class="topupPhone"></div>
			<div id="refNoStatus" style="display:none">Your reference code no. is: <span class="refNo"></span></div>
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
						//console.log(document.getElementById("lblRM").innerHTML);
						if ($("#txtPhoneNo").val() != ''){
							checkAvailability();
						}


		}).blur();

		//disable button from the start
		$('#submit-button').prop('disabled',true).css('background-color', 'grey');

		//init params
        var selections = jQuery(".boxCss"), txtPhoneNo = jQuery("#txtPhoneNo"), lblRequiredPhoneNumber = jQuery("#lblRequiredPhoneNumber");
        var coinData = { "1": "1", "2": "10", "3": "20", "4": "25", "5": "75", "6": "175", "7": "250","8": "1,250" };
        var currentSelection;
		var flag;

		//set cookies function - will removing it because of cookie injection
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

		//i dunno why kangbao need this, no idea
	   (function () {

            Init()
        })();

        function Init() {

            //selections[0].click();
        }

		//selection to change display payment value
        function select(evt, type) {

			currencyChange();

            for (i = 0; i < selections.length; i++) {
                selections[i].className = selections[i].className.replace(" active", "");
            }

            evt.currentTarget.className += " active";
            currentSelection = type;

            jQuery("#lblRM").html(" " + coinData[type]);

			//window.sessionStorage.currency = coinData[type];
			//window.sessionStorage.value = "USD";


			//for payment steps but will migrate to post method
			setCookie("value",parseFloat(coinData[type].replace(/,/g, '')));
			$('#submit-button').prop('disabled',false).css('background-color', '#5EBFB8');

        }

		//the final step
        /**
		function topup() {
			//to change for checking
			checkAvailability();

			//flag from found phone numbers
			if (flag == 1) {


						//whether data is empty
						if (document.getElementById("countrycode").value ==''){
								$('#phone-status').css('color', 'red');
								$('#submit-button').prop('disabled',true).css('background-color', 'grey');
								content= "Select Your country prefix";
								$("#phone-status").html(content);
							}else{
							//console.log(document.getElementById("lblRM").innerHTML);
								if (document.getElementById("lblRM").innerHTML ==' -'){
									//console.log("What the fuck going on here");
									content= "Select your top up value";
									$('#topup-status').css('display', 'block');
									$('#topup-status').css('color', 'red');
									$("#topup-status").html(content);
									$('#submit-button').prop('disabled',true).css('background-color', 'grey');
								}else{
									$('#submit-button').prop('disabled',false).css('background-color', '#5EBFB8');
									$('#topup-status').css('display', 'none');
										if (txtPhoneNo.val().length > 0) {
											var e = document.getElementById("countrycode");
											var countryCode = e.options[e.selectedIndex].value;
											//window.sessionStorage.countrycode= countryCode;
											//window.sessionStorage.phonenumber = txtPhoneNo.val();
											setCookie("countrycode",countryCode);
											phone = document.getElementById("countrycode").value + txtPhoneNo.val();
											//console.log(phone);
											setCookie("phonenumber",phone);setCookie("select",currentSelection)
											//localStorage.setItem("countrycode",countryCode);
											//localStorage.setItem("phonenumber",txtPhoneNo.val());
											window.location.href = "PaymentType.php"; //change to redirect using redirect plugin
										}else {

											lblRequiredPhoneNumber.show();
										}
								}
					}
			}else if (flag == 0) {
			$('#submit-button').prop('disabled',true).css('background-color', 'grey');
			$('.phoneDiv').css('border', '2px solid red');
			content="Your phone number is invalid or missing area code";
			$("#phone-status").html(content);

			}

        }
		*/

		//dynamically checks for key strokes
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

		//changes currency and paying values as per operation
		function currencyChange(){

			var x = document.getElementById("countrycode").value;

			if (x == "+60" ){
				currency ="MYR";
                cCode = 'MY';
				coinData = { "1": "4", "2": "40", "3": "80", "4": "100", "5": "300", "6": "700","7": "1,000","8": "5,000" };
				for (i = 1; i <= 8; i++) {
				document.getElementById("payvalue"+ i).innerHTML = coinData[i];
				}
				y = currency;
			}else if (x == "+84")	{
				//vietnam
				currency ="VND";
                cCode = 'VN';
				coinData = { "1": "21,600", "2": "216,000", "3": "432,000", "4": "540,000", "5": "1,620,000", "6": "3,780,000", "7": "5,400,000","8": "27,000,000" };
				for (i = 1; i <= 8; i++) {
				document.getElementById("payvalue"+ i).innerHTML = coinData[i];
				}
				y = currency;
			}else if (x == "+62")	{
				//indonesia
				currency ="IDR";
                cCode = 'ID';
				coinData = { "1": "13,200", "2": "132,000", "3": "264,000", "4": "330,000", "5": "990,000", "6": "2,310,000","7": "3,300,000","8": "16,500,000" };
				for (i = 1; i <= 8; i++) {
				document.getElementById("payvalue"+ i).innerHTML = coinData[i];
				}
				y = currency;
			}else if (x == "+65")	{
				//singapore
				currency ="SGD";
                cCode = 'SG';
				coinData = { "1": "1.50", "2": "13", "3": "25", "4": "35", "5": "100", "6": "230", "7": "330","8": "1,650" };
				for (i = 1; i <= 8; i++) {
				document.getElementById("payvalue"+ i).innerHTML = coinData[i];
				}
				y = currency;
			}else if (x == "+63")	{
				//phil
				currency ="PHP";
                cCode = 'PH';
				coinData = { "1": "50", "2": "500", "3": "995", "4": "1,245", "5": "3,730", "6": "8,700","7": "12,450","8": "62,100" };
				for (i = 1; i <= 8; i++) {
				document.getElementById("payvalue"+ i).innerHTML = coinData[i];
				}
				y = currency;
			}else{
				currency ="USD";
                cCode = '';
				coinData = { "1": "1", "2": "10", "3": "20", "4": "25", "5": "75", "6": "175", "7": "250","8": "1,250" };
				for (i = 1; i <= 8; i++) {
				document.getElementById("payvalue"+ i).innerHTML = coinData[i];
				}
				y = currency;
			}
				for (j = 1; j <= 9; j++) {
				document.getElementById("currency"+j).innerHTML = currency;

				}

			//param value for payment - migrate to post method
			setCookie("currency",y);
            setCookie('cCode',cCode);
			jQuery("#lblRM").html(" -" );
			for (i = 0; i < selections.length; i++) {
                selections[i].className = selections[i].className.replace(" active", "");
            }
			$('#submit-button').prop('disabled',false).css('background-color', '#5EBFB8');
			//document.getElementById('countrycode').addEventListener('change', showDisplayValue, false);
		}

		//test whether leading zero exist in phone number
			function testzeroes(e){

								var regExp = /^0[0-9]/;
					e = regExp.test($("#txtPhoneNo").val());

				return e;
			}


			//checks whether phone number is available in db - not sure api is sanitize but i trust George did it
			function checkAvailability() {

				if (testzeroes() ==true){
							content = "Please remove your first zero in your phone number";
							$('#phone-status').css('color', 'red');
							$("#phone-status").html(content);
				}else{

						if ($("#txtPhoneNo").val() !=''){

							$("#loaderIcon").show();


							jQuery.ajax({
							url: "phonecheck.php",
							data:{phone: $("#txtPhoneNo").val()},
							type: "POST",
							success:function(data){
								data = JSON.parse(data);
								console.log(data.data);
								if (data.data != ''){
									for (i = 0; i < data.data.length; i++){
										if (document.getElementById("countrycode").value == data.data[i].area){
											//console.log("Yes it matched");
											if ($("#txtPhoneNo").val() == data.data[i].mobile){
												//console.log("Con lan firm matched");
												content = "Your phone number is eligible to redeem";
										$('#phone-status').css('color', 'green');
										//$('#submit-button').attr('disabled',false);
										$('#submit-button').prop('disabled',false).css('background-color', '#5EBFB8');
										flag = 1;
											}
										}else{

											content = "Phone number is not in our system. Check your area code.";
											$('#phone-status').css('color', 'red');
											//$('#submit-button').attr('disabled',true);
											$('#submit-button').prop('disabled',true).css('background-color', 'grey');
											flag = 0;
										}


									}
									//console.log(document.getElementById("countrycode").value);


								}else{
									console.log(data.data);
									content = "Your phone number is not in our system";
									$('#phone-status').css('color', 'red');
									//$('#submit-button').attr('disabled',true);
									$('#submit-button').prop('disabled',true).css('background-color', 'grey');
									flag = 0;
								}
							$("#phone-status").html(content);
							$("#loaderIcon").hide();
									if (flag==1){
										$('.phoneDiv').css('border', 'none');

									}
							},
							error:function (){}
							});
						}else{
							content = "You forgot to insert your phone number";
							$('#phone-status').css('color', 'red');
							$("#phone-status").html(content);
						}
				}
			}

		//useless commafy which I dont need it
		function commafy( num ) {
			var str = num.toString().split('.');
			if (str[0].length >= 5) {
				str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
			}
			if (str[1] && str[1].length >= 5) {
				str[1] = str[1].replace(/(\d{3})/g, '$1 ');
			}
			return str.join('.');
		}

        //ISO Country Code for later param to parse to Adyen, currently using user IP for payment, might need to implement in post data
		function ISOCountryCode(country){
			jQuery.ajax({
				url: "names.json",
				data: "",
				type: "POST",
				success:function(data){
					Object.entries(data).map(([key, value]) => {
						if (value === country) console.log(key)
					})
				},
				error:function (){}
				});
		}
		//ISOCountryCode("Malaysia");

function userImgNickName(uid){
	if (uid != ''){
		jQuery.ajax({
								url: "uidcheck.php",
								data: {uid: uid},
								type: "POST",
								success:function(data){
									data = JSON.parse(data);
										console.log(data.data.img);
										//console.log(data.data.cover_img);
										//console.log(data.data.username);
										
										checkCode(uid,data.data.username,data.data.img);
										

								},
								error:function (){}
								});

	}
}

function checkCode(uid,username,headImg){
	
jQuery.ajax({
				url:"validate.php",
				data: {
						code: $("#inputCode").val(),
						uid: uid,
						phone: $("#txtPhoneNo").val(),
						area: document.getElementById("countrycode").value
				},
				type: "POST",
				success:function(data){
						console.log(data);
						refno = JSON.parse(data).ref_no;
						status = JSON.parse(data).message;
						var tCoin = status;
										if (status =="invalid_param"){
											$(".redeemStatus").html("Please contact our support team");
											$(".redeemStatus").css('color', 'red');

										}else if (status == "invalid_code"){
											$(".redeemStatus").html("Invalid Code");
											$(".redeemStatus").css('color', 'red');
										}else if (status == "expired_code"){
											$(".redeemStatus").html("Expired Code");
											$(".redeemStatus").css('color', 'red');											
										}else if (status == "redeemed_code"){
											$(".redeemStatus").html("Code already redeemed");
											$(".redeemStatus").css('color', 'red');
										}else{
											$(".userName").html(username);
											$(".redeemStatus").html("Redeem Successful");
											$(".redeemStatus").css('color', 'green');
											$(".redeemMessage").html(tCoin+" T-coin redeemed successful by");
											$(".refNo").html(refno);
											document.getElementById('refNoStatus').style.display = 'block';
											var topupPhone = document.getElementById("countrycode").value+document.getElementById('txtPhoneNo').value;
											$('#countrycode').prop('selectedIndex',0);
											document.getElementById('txtPhoneNo').value='';
											document.getElementById('inputCode').value='';
											document.getElementById('phone-status').style.display = 'none';
											document.getElementById('phoneDiv').style.display = 'none';
											document.getElementById('inputCode').style.display = 'none';
											document.getElementById('submit-button').style.display = 'none';
											$('#submit-button').prop('disabled',false).css('background-color', '#5EBFB8');
											$("#topupPhone").html(topupPhone);	
											if (headImg == null){
												$(".userImg").html("<img src='img/default_head_0_normal.jpg' alt='userImage' height='250' width='250'>");
											}else{
												$(".userImg").html("<img src='" +headImg + "' alt='userImage' height='250' width='250'>");
											}
										}
				},
				error:function (){
					console.log("Error on output");
				} 

			});



		}
function topup(){
	jQuery.ajax({
							url: "phonecheck.php",
							data:{phone: $("#txtPhoneNo").val()},
							type: "POST",
							success:function(data){
								//check if voucher code is empty

								//check phone number is empty

								//ajax on https://api.tamago.live/user?id= for user id from verify phone

								data = JSON.parse(data);
								console.log(data);
								if (data.data != ''){
									for (i = 0; i < data.data.length; i++){
										if (document.getElementById("countrycode").value == data.data[i].area){
											//console.log("Yes it matched");
											if ($("#txtPhoneNo").val() == data.data[i].mobile){
											//console.log("Con lan firm matched");
												content = "Your phone number is eligible to redeem";
												$('#phone-status').css('color', 'green');
												//$('#submit-button').attr('disabled',false);
												$('#submit-button').prop('disabled',false).css('background-color', '#5EBFB8');
												flag = 1;

												userImgNickName(data.data[i].uid);


											}
										}else{

											content = "Phone number is not in our system. Check your area code.";
											$('#phone-status').css('color', 'red');
											//$('#submit-button').attr('disabled',true);
											$('#submit-button').prop('disabled',true).css('background-color', 'grey');
											flag = 0;
										}


									}
									//console.log(document.getElementById("countrycode").value);


								}else{
									console.log(data.data);
									content = "Your phone number is not in our system";
									$('#phone-status').css('color', 'red');
									//$('#submit-button').attr('disabled',true);
									$('#submit-button').prop('disabled',true).css('background-color', 'grey');
									flag = 0;
								}
							$("#phone-status").html(content);
							$("#loaderIcon").hide();
									if (flag==1){
										$('.phoneDiv').css('border', 'none');

									}
							},
							error:function (){}
							});

}


    </script>
</body>

</html>
