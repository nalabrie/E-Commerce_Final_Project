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
/* this php block places the order */

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
$sql = "INSERT INTO ORDERS(ORDER_DATE, CUSTOMER_NUM, DRIVER_NUM) VALUES(NOW(), '" . $_SESSION['user_num'] . "', '1')";

// check if order placed successfully
if ($conn->query($sql) === FALSE) {
    echo "An unknown error occurred while placing your order, please <a href=cart.php>try again</a>.";
    die();
}

// store order date
$orderDate = date("l n/j/Y g:i A");

// get name of delivery driver (always driver number 1 in this case since this is a fictional system)
$sql = "SELECT FIRST_NAME, LAST_NAME FROM DRIVER WHERE DRIVER_NUM = '1'";
$result = $conn->query($sql);
$driverData = $result->fetch_assoc();
$driverName = $driverData['FIRST_NAME'] . " " . $driverData['LAST_NAME'];

// database unneeded for remainder of file, close connection
$conn->close();
?>

<h1>Order Summary</h1>
Name: <?php echo $_SESSION['username'] ?>
<br>
<br>
Street Address: <?php echo $_SESSION['street'] ?>
<br>
City: <?php echo $_SESSION['city'] ?>
<br>
Sate: <?php echo $_SESSION['state'] ?>
<br>
Postal Code: <?php echo $_SESSION['postal'] ?>
<br>
<br>
Order Date: <?php echo $orderDate ?> &nbsp;&nbsp;&nbsp;&nbsp;<b>Note to Dr. A</b>: this date will always be wrong because the server time at YSU is not correctly set.
<br>
<br>
Your order will be delivered shortly by your driver <span style="color: red;"><?php echo $driverName ?></span>.

<h3><a href="index.php">Return to homepage</a></h3> <!-- one of two ways back to the main site -->
</body>
</html>