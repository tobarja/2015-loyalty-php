<?php

	try {
    $hostname = "localhost";
    $dbname = "customertest";
    $username = "user";
    $pw = "root";
    $connstr = "mysql:host=$hostname;dbname=$dbname";
	$conn = new PDO($connstr,$username,$pw);
	} 
	catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
	}

$sql = "insert into customertest (Firstname, LastName) values (:fname, :lname)";
$statement = $conn -> prepare($sql);

$statement -> bindValue(':fname', 'whoever');
$statement -> bindValue(':lname', 'ball');

$queryComplete = $statement->execute();


if ($queryComplete){
	echo "add successful";
} else {
    echo "Error: " .$sql. "<br>" . "PDO::errorInfo():\n";
	print_r($conn->errorInfo());
}


?>