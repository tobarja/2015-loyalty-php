<?php

include 'connection.php';
  

$updatenum = $_POST['updatenum'];
$customerid = $_POST['customerid'];

$sql = "update customer set Points = (Points - :updatenum) 
where CustomerID=:customerid;";
$statement = $conn -> prepare($sql);

$statement -> bindValue(':updatenum', $updatenum);
$statement -> bindValue(':customerid', $customerid);

$queryComplete = $statement->execute();

if($queryComplete){

$sql = "select points from customer where CustomerID=:customerid;";
$statement = $conn -> prepare($sql);

$statement -> bindValue(':customerid', $customerid);
$queryComplete = $statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row){ 
    echo $row['points'];
}
}
else {
    echo "0 results";
}
?>
