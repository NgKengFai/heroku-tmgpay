<h2>Your payment is Cancelled</h2>
<body>



<?php
    $transaction = $_GET['transactionid'];
    $status = $_GET['status'];
    $tcoin = $_GET['tcoin'];
    $money = $_GET['money'];
    echo "Transaction ID: ".$transaction."<br>";
    echo "Status: ".$status."<br>";
    echo "T-coin: ".$tcoin."<br>";
    echo "Total : ".$money."<br>";
?>
</body>