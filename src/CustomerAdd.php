<?php

include 'connection.php';
  
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

$sql = "insert into customer (Firstname, LastName, Points, telephone, Email) 
values (:fname, :lname, :points, :telephone, :email)";
$statement = $conn -> prepare($sql);

$statement -> bindValue(':fname', $firstname);
$statement -> bindValue(':lname', $lastname);
$statement -> bindValue(':points', $points);
$statement -> bindValue(':telephone', $telephone);
$statement -> bindValue(':email', $email);


$queryComplete = $statement->execute();


if ($queryComplete){
	echo "<h1>You have added a customer to the database, their name is $firstname $lastname , with $points points, 
	and number $telephone, with email $email</h1><br><h2>Back to <a href='addcustomer.php'>Add Customer</a>";
} else {
    echo "Error: " .$sql. "<br>" . "PDO::errorInfo():\n";
	print_r($conn->errorInfo());
}


?>