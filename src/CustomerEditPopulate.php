<?php

include 'connection.php';
  
$customerid = $_GET['customerid'];
  



$sql = "select FirstName, LastName, Points,  telephone, Email, Points from customertest where CustomerID = :customerid;";
$statement = $conn -> prepare($sql);
$statement -> bindValue(':customerid', $customerid);
$queryComplete = $statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row){}


?>