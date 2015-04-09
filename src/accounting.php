<?php
session_start();

if (isset($_SESSION["logged_in"]) && isset($_SESSION["admin_logged_in"]))
{

?>
<!DOCTYPE html>

<html>

<head>

<script>
function checkForm(form){
if(form.password.value != form.conpassword.value){
alert("Error: passwords do not match");
return false;
}
}
</script>

<title>MeanBean - Admin - Edit Customer</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="styleSheet.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <style>

    table
    {
	    margin-left:auto;
	    margin-right:auto;
	    border-collapse:collapse;
    }

    td
    {
	    text-align: right;
	    padding: 5px;
    }

    </style>

</head>

<body>

<!-- Navigation Bar -->

<nav class="navbar navbar-inverse" style="margin-bottom:0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="custSearch.php">MeanBean</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="admin.php">Admin</a></li>
        <li><a href="AddCustomer.php">New Customer</a></li>
        <li><a href="custSearch.php">Search</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- End Navigation Bar -->

<br>
<table>
<?php
?>
<tr>
<td style="border-bottom:1px solid black;font-size:20px;">Accounting Info</td>
<td style="border-bottom:1px solid black;"></td>
</tr>
<tr><td><form action="deleteAccounting.php" method="post">
<input type="submit" value="Delete All Entries" name="delete" onclick="return confirm('Are you sure you want to continue?')" />
</form></td></tr>
<?php include 'AccountingSum.php'; ?>

<tr>
<td >Total Points Redeemed in System:</td>
<td ><?php echo $row['points'] ?></td>
</tr>
<?php include 'AccountingPopulate.php'; ?>
<?php 

foreach($rows as $row){
echo "<tr><td >Date and Time:</td><td>".$row['time']."</td></tr>";
echo "<tr><td >User Who Was Logged In:</td><td>".$row['user']."</td></tr>";
echo "<tr><td >Point Redeemed (1) <br>or Redeem Undone (-1):</td><td>".$row['point']."</td></tr>";
}

?>
</table>



</body>

</html>


<?php
}
else{
	
	echo "You are not logged in.  Click the <a href='login.php'>login page</a> link.";
}
?>