<?php

	//Transaction ID - Required For Refund
	$_POST['payment']['transactions'][0]['related_resources'][0]['sale']['id'];

	//Status of The Payment, "approved" as successfully paid
	$_POST['payment']['state'];

	//Payment ID
	$_POST['payment']['id'];

	//Transaction Amount
	$_POST['payment']['transactions'][0]['amount']['currency'];

	//Transaction Currency
	$_POST['payment']['transactions'][0]['amount']['total'];

	//Transaction Time
	$_POST['payment']['create_time'];
	

?>