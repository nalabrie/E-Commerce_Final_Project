<?php
// these two lines are needed to keep the user logged in throughout the site
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Summary - Final Project - Nicky Labrie</title>
</head>
<body>
<h3><a href="index.php">Return to homepage</a></h3> <!-- one of two ways back to the main site -->

<?php
/* this php block places the order and gathers required information about the order */

// connect to database
$servername = "localhost";
$username = "nalabrie_nalabrie";
$password = "cheese_admin";
$dbname = "nalabrie_cheeseburger_hut";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql query to insert order into database
$sql = "";

// check if order placed successfully
if ($conn->query($sql) === FALSE) {
    echo "An unknown error occurred while placing your order, please <a href=cart.php>try again</a>.";
    die();
}

// sql query to get relevant order information
$sql = "SELECT * FROM ITEM";

$result = $conn->query($sql);

// store sql results in variables
if ($result->num_rows > 0) {
}

// database unneeded for remainder of file, close connection
$conn->close();
?>

<h1>Order Summary</h1>


<h3><a href="index.php">Return to homepage</a></h3> <!-- one of two ways back to the main site -->
</body>
</html>