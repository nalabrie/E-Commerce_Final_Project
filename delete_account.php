<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Account - Assignment 10 - Nicky Labrie</title>
</head>
<body>
This is the page for deleting an account and all related orders. Already have an account and want to sign in? Go <a
        href="./account.php">back</a>.<br><br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table>
        <tr>
            <td><label for="name">Full name </label></td>
            <td><input type="text" name="name" id="name" required/></td>
        </tr>
        <tr>
            <td><label for="street">Street address </label></td>
            <td><input type="text" name="street" id="street" required/></td>
        </tr>
    </table>
    By clicking submit, the account associated with that name and street will be deleted and all orders made will be
    cleared from the history.<br>
    <input type="submit">
</form>
<?php
if (!empty($_POST)) {
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

    // sql queries to delete the customer and all orders they have made (Unit Objective #2)
    $sql1 = "DELETE FROM ORDERS WHERE CUSTOMER_NUM = (SELECT CUSTOMER_NUM FROM CUSTOMER WHERE TRIM(UPPER(CUSTOMER_NAME)) = '" . trim(strtoupper($_POST['name'])) . "' AND TRIM(UPPER(STREET)) = '" . trim(strtoupper($_POST['street'])) . "')";
    $sql2 = "DELETE FROM CUSTOMER WHERE CUSTOMER_NUM = (SELECT CUSTOMER_NUM FROM (SELECT * FROM CUSTOMER) AS TEMP WHERE TRIM(UPPER(CUSTOMER_NAME)) = '" . trim(strtoupper($_POST['name'])) . "' AND TRIM(UPPER(STREET)) = '" . trim(strtoupper($_POST['street'])) . "')";

    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        echo "Account deleted successfully!";
    }
    else {
        echo "Error: " . $sql1 . "<br>" . $sql2 . "<br><br>" . $conn->error;
    }
    $conn->close();
}
?>
</body>
</html>
