<?php
session_start();

if (isset($_SESSION["logged_in"]))
{
?>


<!DOCTYPE html>

<html>

<head>

	<title>MeanBean - Admin - Add Customer</title>

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
        <li><a href="adminAddCustomer.php">New Customer</a></li>
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

<tr>
<td style="border-bottom:1px solid black;font-size:20px;">Add Customer</td>
<td style="border-bottom:1px solid black;"></td>
</tr>
<form action="CustomerAdminAdd.php" method="post">
<tr>
<td >First Name:</td>
<td ><input name="firstname" type="text" /></td>
</tr>

<tr>
<td >Last Name:</td>
<td ><input name="lastname" type="text" /></td>
</tr>

<tr>
<td >Telephone:</td>
<td ><input name="telephone" type="text" /></td>
</tr>

<tr>
<td >E-mail:</td>
<td ><input name="email" type="text" /></td>
</tr>

<tr>
<td >Freebies:</td>
<td ><input type="text" /></td>
</tr>

<tr>
<td >Points:</td>
<td ><input name="points" type="text" /></td>
</tr>

<tr>
<td></td>
<td><input type="submit" /></td>
</tr>

</table>
</form>

</body>

</html>

<?php
}
else{
	
	echo "You are not logged in.  Click the <a href='login.php'>login page</a> link.";
}
?>