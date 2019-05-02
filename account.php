<?php
// these two lines are needed to keep the user logged in throughout the site
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account - Final Project - Nicky Labrie</title>
</head>
<body>

<?php include("./navbar.inc") ?>

<br>Need an account? Create one <a href="./create_account.php">here</a>.<br>
Delete accounts <a href="./delete_account.php">here</a>.<br><br>

<div>
    <?php
    /* This chunk of php code logs in the user after they submit the login form. It connects to the database
     * to compare the form data to existing customers.
     */

    // only run if the form is completed and submitted
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

        // form submitted, connect to database
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

        // sql query to check if username and password exists in database
        $sql = "SELECT CUSTOMER_NAME FROM CUSTOMER WHERE UPPER(CUSTOMER_NAME) = '" . trim(strtoupper($_POST['username']))
            . "' AND UPPER(STREET) = '" . trim(strtoupper($_POST['password'])) . "'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // sign in successful, store in session
            $_SESSION['username'] = $result->fetch_assoc()['CUSTOMER_NAME'];
        }
        else {
            // sign in failed, show warning
            echo 'Wrong username or password, please try again.';
        }

        // database unneeded for remainder of file, close connection
        $conn->close();
    }
    ?>
</div>

<div>
    <?php
    /* this chunk of php code displays the currently signed in user if any */

    // do not show if not signed in as anybody
    if (isset($_SESSION['username'])) {
        echo "You are currently signed in as <span style=\"color: red; \">" . trim($_SESSION['username']) .
            "</span>. Not you? <a href='logout.php'>Sign out</a>.";
    }

    ?>
</div>

<h2>Sign in with name and address</h2>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <table>
        <tr>
            <td><label for="name">Full name </label></td>
            <td><input type="text" name="username" id="username" required autofocus/></td>
        </tr>
        <tr>
            <td><label for="street">Street address </label></td>
            <td><input type="text" name="password" id="password" required/></td>
        </tr>
        <tr>
            <td><!-- intentionally empty --></td>
            <td>
                <button type="submit" name="login">Sign in</button>
            </td>
        </tr>
    </table>
</form>

Click <a href="logout.php">here</a> to log out.

</body>
</html>
