<?php

include 'connection.php';
  
$customerid = $_GET["customerid"];  
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$telephone = $_POST['telephone'];
$points = $_POST['points'];
$email = $_POST['email']; 

$firstname = mysql_real_escape_string($firstname);
$lastname = mysql_real_escape_string($lastname);
$telephone = mysql_real_escape_string($telephone);
$points = mysql_real_escape_string($points);
$email = mysql_real_escape_string($email);

if (isset($_POST['save'])) {


$sql = "UPDATE customer SET FirstName = :fname, LastName = :lname, Points = :points,  telephone = :telephone, Email= :email 
where CustomerID = :customerid";

$statement = $conn -> prepare($sql);

$statement -> bindValue(':fname', $firstname,PDO::PARAM_STR);
$statement -> bindValue(':lname', $lastname,PDO::PARAM_STR);
$statement -> bindValue(':points', $points,PDO::PARAM_STR);
$statement -> bindValue(':telephone', $telephone,PDO::PARAM_STR);
$statement -> bindValue(':email', $email,PDO::PARAM_STR);
$statement -> bindValue(':customerid', $customerid, PDO::PARAM_INT);

$queryComplete = $statement->execute();

}

else if (isset($_POST['delete'])) {
$sql = "delete from customer 
	where CustomerID = :customerid";
	$statement = $conn -> prepare($sql);
	
	$statement -> bindValue(':customerid', $customerid);
	
	$queryComplete = $statement->execute();

}

if ($queryComplete) {
	header( "refresh:3;url=custSearch.php?firstname="."$firstname"."&lastname="."$lastname");
    echo "<h1>You will be redirected in 3 seconds.  <br>  You have updated a customer in the database, their name is $firstname $lastname , with $points points, and number $telephone, with email $email</h1>";
} else {
    echo "Error: " .$sql. "<br>" . "PDO::errorInfo():\n";
	print_r($conn->errorInfo());
}

?>