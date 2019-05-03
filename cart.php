<?php
// these two lines are needed to keep the user logged in throughout the site
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart - Final Project - Nicky Labrie</title>
</head>
<body>
<?php include("./navbar.inc"); ?>

<br>

<?php
// can not use cart if user is not signed in
if (!isset($_SESSION['username'])) {
    echo "Orders can't be placed unless you are signed in. Either <a href='create_account.php'>create an account</a> or <a href='account.php'>sign in</a>.";
}
else {
    // user is signed in, check if cart is empty
    if (isset($_SESSION['cartArray']) && count($_SESSION['cartArray']) == 0) {
        // cart is empty, do not show table
        echo "Cart is empty! Add items to order at the <a href='menu.php'>menu</a> page.";
    }
    else {
        // cart has items, show table

        // parallel arrays to store cart information
        $description = array();
        $price = array();

        // connect to database to get cart item information
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

        foreach ($_SESSION['cartArray'] as $key => $item) {
            // sql query to get item description and price for every item in the cart
            $sql = "SELECT DESCRIPTION, PRICE FROM ITEM WHERE ITEM_NUM = '" . $item . "'";

            $result = $conn->query($sql);

            // only add item to cart if it is found in the database
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $description[$key] = $row['DESCRIPTION'];
                $price[$key] = $row['PRICE'];
            }
        }

        // database unneeded for remainder of file, close connection
        $conn->close();

        // generate table to show cart

        // title row of table
        echo "<table border='1px solid black'><tr><th>Item Description</th><th>Price</th></tr>";
        // in every row show the description and price
        for ($i = 0; $i < count($description); $i++) {
            echo "<tr><td>" . $description[$i] . "</td><td>" . $price[$i] . "</td></tr>";
        }
        echo "</table>$result->num_rows items in cart<br><br>";   // show number of rows in table

        // sum up items in cart
        $sum = 0;
        foreach ($price as $value) {
            $sum += $value;
        }

        // cart total
        echo "Total: $" . number_format($sum, 2);
    }
}
?>


<!--
TODO: NOTES BELOW THIS LINE

1. the cart is checkboxes holding ITEM_NUM but should be displayed to the user ONLY IF box is checked AND show DESCRIPTION rather than a number
2. empty cart button
3. entire thing needs to be in form to submit it
//-->
</body>
</html>
