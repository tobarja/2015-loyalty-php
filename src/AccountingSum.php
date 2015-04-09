<?php

include 'connection.php';


$sql = "select sum(point) as 'points' from redeemlog";

$statement = $conn -> prepare($sql);
$queryComplete = $statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row){}

?>