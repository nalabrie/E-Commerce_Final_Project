<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories - Final Project - Nicky Labrie</title>
</head>
<body>
<?php include("./navbar.inc") ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Pick a menu category from the drop down list:<br>
    <label>
        <select name="chosen_category">
            <option value="BURGER">Burgers</option>
            <option value="SIDE">Sides</option>
            <option value="DRINK">Drinks</option>
            <option value="OTHER">Other</option>
        </select>
    </label>
    <input type="submit"/>
</form>
<?php
// once a category is chosen, show a table of items in that category
if (!empty($_POST["chosen_category"])) {
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

    $sql = "SELECT * FROM ITEM WHERE CATEGORY = '" . $_POST["chosen_category"] . "'";
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
}
?>
</body>
</html>
