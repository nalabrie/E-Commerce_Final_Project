<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account - Assignment 10 - Nicky Labrie</title>
</head>
<body>
Already have an account? Go <a href="./account.php">back</a>.<br><br>
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
        <tr>
            <td><label for="city">City </label></td>
            <td><input type="text" name="city" id="city" required/></td>
        </tr>
        <tr>
            <td><label for="state">State </label></td>
            <td><input type="text" name="state" id="state" required/></td>
        </tr>
        <tr>
            <td><label for="postal_code">Postal code </label></td>
            <td><input type="text" name="postal_code" id="postal_code" required/></td>
        </tr>
    </table>
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

    $sql = "INSERT INTO CUSTOMER (CUSTOMER_NAME, STREET, CITY, STATE, POSTAL_CODE) VALUES ("
        . "'" . trim($_POST['name']) . "', "
        . "'" . trim($_POST['street']) . "', "
        . "'" . trim($_POST['city']) . "', "
        . "'" . trim(strtoupper($_POST['state'])) . "', "
        . "'" . trim($_POST['postal_code']) . "'"
        . ")";

    if ($conn->query($sql) === TRUE) {
        echo "New account created successfully!";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
</body>
</html>
