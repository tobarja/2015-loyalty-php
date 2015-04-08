<?php

include 'connection.php';
  

$searchString = $_POST['searchString'];
$searchString = "%".$searchString."%";


$sql = "select CustomerID, FirstName, LastName, telephone, Points from customer
where CONCAT(FirstName, ' ', LastName) like :searchString 
or LastName like :searchString 
or telephone like :searchString";


$statement = $conn -> prepare($sql);
$statement -> bindValue(':searchString', $searchString,PDO::PARAM_STR);


$queryComplete = $statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($queryComplete){
	echo"<table>";	
		foreach($rows as $row){

        echo 
		"<tr><td><a href='freebies.php?customerid=".$row['CustomerID']."'>" . $row["FirstName"] .  ",</a></td>" 
		. 
		"<td><a href='freebies.php?customerid=".$row['CustomerID']."'>" . $row["LastName"]. ",</a></td>" 
		.
		"<td><a href='freebies.php?customerid=".$row['CustomerID']."'>" . $row["telephone"]. ",</a></td>"
		.
		"<td><a href='freebies.php?customerid=".$row['CustomerID']."'> Points: " . $row["Points"] . "</a></td>"
		.
		"<td><a href='EditCustomer.php?customerid=".$row['CustomerID']."'>Edit</a></td></tr>";
    }
	echo "</table>";
} 
else {
    echo "0 results";
}


?>