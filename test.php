<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<div class="phoneDiv">
                <div class="pull-left areaCode">
					<select id="countrycode" class="countrycode" style="width:55px;" onchange="">
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
                    <input type="text" id="txtPhoneNo" class="txtPhoneNoCss" placeholder="Phone Number without zero in front" maxlength="12" onBlur="checkAvailability()"/>
					<p><span id="phone-status"></span></p>
                </div>
				<p><img src="LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
</div>

			<div class="bottomRow3">
				<span id="topup-status"></span>
                <input type="button" id="submit-button" class="topUpButton" value="Top Up" onclick="topup()" />
            </div>
			<div class="userImg">
			</div>
			<div class="userName"></div>
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

		//test whether leading zero exist in phone number
		function testzeroes(e){
						
			var regExp = /^0[0-9]/;
			e = regExp.test($("#txtPhoneNo").val());

		return e;
		}
function checkAvailability() {
				
				if (testzeroes() ==true){
							content = "Please remove your first zero in your phone number";
							$('#phone-status').css('color', 'red');
							$("#phone-status").html(content);					
				}else{
 
						if ($("#txtPhoneNo").val() !=''){
							
							$("#loaderIcon").show();
						
						
							jQuery.ajax({
							url: "https://api.tamago.live/verify?phone="+$("#txtPhoneNo").val(),
							data:$("#txtPhoneNo").val(),
							type: "POST",
							success:function(data){
								//console.log(data.data);
								if (data.data != ''){
									for (i = 0; i < data.data.length; i++){ 
										if (document.getElementById("countrycode").value == data.data[i].area){
											//console.log("Yes it matched");
											if ($("#txtPhoneNo").val() == data.data[i].mobile){
												//console.log("Con lan firm matched");
												content = "Your phone number is eligible to pay";
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


function topup(){
	jQuery.ajax({
							url: "https://api.tamago.live/verify?phone="+$("#txtPhoneNo").val(),
							data:$("#txtPhoneNo").val(),
							type: "POST",
							success:function(data){
								//check if voucher code is empty

								//check phone number is empty

								//ajax on https://api.tamago.live/user?id= for user id from verify phone


								//console.log(data.data);
								if (data.data != ''){
									for (i = 0; i < data.data.length; i++){ 
										if (document.getElementById("countrycode").value == data.data[i].area){
											//console.log("Yes it matched");
											if ($("#txtPhoneNo").val() == data.data[i].mobile){
												//console.log("Con lan firm matched");
												content = "Your phone number is eligible to pay";
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

function userImgNickName(uid){
	if (uid != ''){
		jQuery.ajax({
								url: "https://api.tamago.live/user?id="+uid,
								data: uid,
								type: "POST",
								success:function(data){
										//console.log(data.data.head_img);
										//console.log(data.data.cover_img);
										//console.log(data.data.username);

										if (data.data.head_img == null){
											$(".userImg").html("<img src='img/default_head_0_normal.jpg' alt='userImage' height='250' width='250'>");
										}
										$(".userName").html(data.data.username);
								},
								error:function (){}
								});

	}
}

</script>

</html>