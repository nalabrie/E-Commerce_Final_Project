<?php
// next two lines are needed to store session information when adding items to the cart
ob_start();
session_start();

include("./navbar.inc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu - Final Project - Nicky Labrie</title>
</head>
<body>

<!-- submitting this form adds all the selected items to the cart -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php
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

    // only generate table when there is at least one thing to show in it
    if ($result->num_rows > 0) {
        // title row of table
        echo "<table border='1px solid black'><tr><th>Item Number</th><th>Description</th><th>On Hand</th><th>Category</th><th>Price</th><th>Add to cart?</th></tr>";
        // output data of each row along with a way to add an item to the cart
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["ITEM_NUM"] . "</td><td>" . $row["DESCRIPTION"] . "</td><td>" . $row["ON_HAND"] . "</td><td>" . $row["CATEGORY"] . "</td><td>" . $row["PRICE"] . "</td> . <td><input type=\"checkbox\" name=\"addToCart[]\" value=\"" . $row['ITEM_NUM'] . "\"/></td></tr>";
        }
        echo "</table>$result->num_rows results";   // show number of rows in table
    }
    else {
        echo "0 results";
    }
    $conn->close();
    ?>
    <br><br>
    <button type="submit">Add checked items to cart</button>
</form>

<br>
Edit the menu <a href="modify_menu.php">here</a>.
<br><br>

<?php

/* this php block adds the items to the cart by storing them in a session-wide array and informing the user of successes and errors */

// only run code if form has been submitted
if (isset($_POST['addToCart'])) {
    // store cart in session
    $_SESSION['cartArray'] = $_POST['addToCart'];

    // notify user of success
    echo count($_POST['addToCart']) . " items were added to the cart. Ready to check out? <a href='cart.php'>Go to cart</a>.";
}
?>
</body>
</html>