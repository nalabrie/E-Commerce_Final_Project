<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account - Final Project - Nicky Labrie</title>
</head>
<body>
<?php include("./navbar.inc") ?>
Need an account? Create one <a href="./create_account.php">here</a>.<br>
Delete accounts <a href="./delete_account.php">here</a>.<br><br>
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
    <input type="submit">
</form>
Note: signing in is not completed yet. It will determine if your credentials match a valid account but that is it.<br><br>
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

    $sql = "SELECT CUSTOMER_NUM FROM CUSTOMER WHERE UPPER(CUSTOMER_NAME) = '" . trim(strtoupper($_POST['name']))
        . "' AND UPPER(STREET) = '" . trim(strtoupper($_POST['street'])) . "'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Sign-in successful!";
    }
    else {
        echo "Account does not exist.";
    }
    $conn->close();
}
?>
</body>
</html>
