<?php

include 'connection.php';
 



$sql = "select time,user,point from redeemlog;";

$statement = $conn -> prepare($sql);
$queryComplete = $statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);


?>