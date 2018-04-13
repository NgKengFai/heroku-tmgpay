<?php
//echo $_POST["code"];
//echo $_POST["phone"];
//echo $_POST["area"];
//ini_set("allow_url_fopen", 1);
//$code = "1122233334444";
//echo mb_substr($code, 2, 3);

//semi-migration to hash.
//if (strlen($_POST['code'])>17){
    $code = hash("sha256",$_POST['code']);
//    echo $code;
//}else if (strlen($_POST['code'])<17){
//    $code = $_POST['code'];
//}
$area = urlencode($_POST['area']);
$batchno =substr($_POST["code"],2,3);
$query = "code=$_POST[code]&phoneno=$_POST[phone]&areacode=$area&uid=$_POST[uid]&batchno=$batchno";

//dev
$json = file_get_contents("http://api-v2-dev.tamago.tv/topup/validate?".$query);

//prod
//$json = file_get_contents("http://api-v2.tamago.tv/topup/validate?".$query);
echo $json;
?>



