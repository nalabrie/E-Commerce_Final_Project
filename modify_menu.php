<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modify Menu - Assignment 10 - Nicky Labrie</title>
</head>
<body>
This is the page for modifying the menu. Submit the form below and then view the menu <a href="./menu.php">here</a> to see the changes.<br><br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table>
        <caption>Add an item to the menu</caption>
        <tr>
            <td><label for="description">Description </label></td>
            <td><input type="text" name="description" id="description" required/></td>
        </tr>
        <tr>
            <td><label for="on_hand">On Hand </label></td>
            <td><input type="text" name="on_hand" id="on_hand" required/></td>
        </tr>
        <tr>
            <td><label for="category">Category </label></td>
            <td><input type="text" name="category" id="category" required/></td>
        </tr>
        <tr>
            <td><label for="price">Price </label></td>
            <td><input type="text" name="price" id="price" required/></td>
        </tr>
    </table>
    <input type="submit">
</form>
<br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table>
        <caption>Delete an item from the menu</caption>
        <tr>
            <td><label for="remove_by_description">Description </label></td>
            <td><input type="text" name="remove_by_description" id="remove_by_description" required/></td>
        </tr>
    </table>
    <input type="submit">
</form>
<?php
// remove item from menu
if (!empty($_POST['remove_by_description'])) {
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

    // sql query to modify the menu (Unit Objective #1)
    $sql = "DELETE FROM ITEM WHERE TRIM(UPPER(DESCRIPTION)) = '" . trim(strtoupper($_POST['remove_by_description'])) . "'";

    if ($conn->query($sql) === TRUE) {
        echo "Menu item removed successfully!";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
// add item to menu
else if (!empty($_POST)) {
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

    // sql query to modify the menu (Unit Objective #1)
    $sql = "INSERT INTO ITEM (DESCRIPTION, ON_HAND, CATEGORY, PRICE) VALUES ('" . trim($_POST['description']) . "', '" . trim($_POST['on_hand']) . "', '" . trim(strtoupper($_POST['category'])) . "', '" . trim($_POST['price']) . "')";

    if ($conn->query($sql) === TRUE) {
        echo "Menu item added successfully!";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
</body>
</html>
