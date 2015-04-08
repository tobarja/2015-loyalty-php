<?php

include 'connection.php';
  

$updatenum = $_POST['updatenum'];
$customerid = $_POST['customerid'];


if($conn->query("update customer set Points = (Points + $updatenum) 
where CustomerID='$customerid';")== true){

}

$sql = "select points from customer where CustomerID='$customerid';";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of row
    $row = $result->fetch_assoc(); 
    echo $row['points'];
}
else {
    echo "0 results";
}

$conn->close();
?>
