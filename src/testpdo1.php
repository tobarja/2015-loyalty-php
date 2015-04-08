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

$sql = "select * from customertest";
$statement = $conn -> prepare($sql);
$queryComplete = $statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
echo "<table>";

if ($queryComplete){
	foreach($rows as $row){
	echo "<tr><td>".$row['FirstName']."</td><td>".$row['LastName']."</td></tr>";
	}
}

else {
    echo "Error: " .$sql. "<br>" . "PDO::errorInfo():\n";
	print_r($conn->errorInfo());
}

echo "</table>"

?>