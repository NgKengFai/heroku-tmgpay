		<html>
		<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		</head>
		<body>
		<select id="container" style="width:55px;">
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
		<div ></div>
		<script>
		function showFields(){  
				
				

					function addNewData() {
					var data;
					  $.ajax({
						 type: "POST",
						 url: "option.php",
						 data: {},
						 success: function(data){
							var content = '<select onclick="showFields()">';
							//alert(data);
							//console.log(data);
							//content += '<select id="areacode_'+i+'" name="areacode_'+i+'" class="areacode_list"><option value="" >--- Select ---</option>"';
							//populate list into options select
							content += data;
							//content += '</select></br>';
							//console.log(content);
							content += '</select>';
							$("#container").html(content);
							//console.log($("#container").html(content));
						 }
						});
					}                  
				
				addNewData();
				
		}
							$('select').on('blur focus', function (e) {
						$(this.options).text(function () {
							return e.type === 'focus' ? this.getAttribute('data-default-text') : this.value;
						});
					}).children().attr('data-default-text', function () {
						return this.textContent;
					}).end().on('change', function () {
						$(this).blur();
					}).blur();
		</script>
		</body>
		</html>
		
		
		