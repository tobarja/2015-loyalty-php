<?php
session_start();

if (isset($_SESSION["logged_in"]) && isset($_SESSION["admin_logged_in"]))
{
include 'connection.php';
$sql = "delete from redeemlog where point = 1 or point = -1";
$statement = $conn -> prepare($sql);


$queryComplete = $statement->execute();


if ($queryComplete){
	echo "<h1>You have deleted every entry in the redeem table</h1><br><h2>You will now be redirected to the admin page";
	header( "refresh:3;url=admin.php");
	} 

else {
    echo "Error: " .$sql. "<br>" . "PDO::errorInfo():\n";
	print_r($conn->errorInfo());
}
}
else{
	
	echo "You are not logged in.  Click the <a href='login.php'>login page</a> link.";
}

?>