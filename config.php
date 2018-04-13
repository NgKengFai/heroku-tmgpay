<?php
   define('DB_SERVER', 'tamago-v2-dev.cdcumqgjhhxx.ap-southeast-1.rds.amazonaws.com');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '8unfNmcAJ1Un6crP');
   define('DB_DATABASE', 'hm_money');
   define('DB_PORT','3306');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE,DB_PORT);
   //print_r($db);
?>