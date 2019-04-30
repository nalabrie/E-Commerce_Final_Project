<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu - Final Project - Nicky Labrie</title>
</head>
<body>
<?php include("./navbar.inc");
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

$sql = "SELECT * FROM ITEM";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1px solid black'><tr><th>Item Number</th><th>Description</th><th>On Hand</th><th>Category</th><th>Price</th></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ITEM_NUM"] . "</td><td>" . $row["DESCRIPTION"] . "</td><td>" . $row["ON_HAND"] . "</td><td>" . $row["CATEGORY"] . "</td><td>" . $row["PRICE"] . "</td></tr>";
    }
    echo "</table>$result->num_rows results";
}
else {
    echo "0 results";
}
$conn->close();
?>
<br><br>
Edit the menu <a href="modify_menu.php">here</a>.
</body>
</html>