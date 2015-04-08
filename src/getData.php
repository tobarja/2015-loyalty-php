<?php

include 'connection.php';
  

$searchString = $_POST['searchString'];


$sql = "select CustomerID, FirstName, LastName, telephone, Points from customertest 
where CONCAT(FirstName, ' ', LastName) like '%$searchString%' 
or LastName like '%$searchString%' 
or telephone like '$searchString%'";


$statement = $conn -> prepare($sql);

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
		"<td><a href='AdminEditCustomer.php?customerid=".$row['CustomerID']."'>Edit</a></td></tr>";
    }
	echo "</table>";
} 
else {
    echo "0 results";
}


?>