<!DOCTYPE html>
<!-- including this file will show a navigation bar across the top of the page to get around the site -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #dddddd;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            padding: 8px;
        }
    </style>
</head>
<body>
<?php
// these two lines are needed to keep the user logged in throughout the site (needs to be here too so the php below works)
ob_start();
session_start();
?>
<ul>
    <li><a href="./index.php">Home</a></li>
    <li><a href="./menu.php">Menu</a></li>
    <li><a href="./categories.php">Categories</a></li>
    <li><a href="./cart.php">Cart</a></li>
    <li><a href="./account.php">Account</a></li>
    <?php
    if (isset($_SESSION['username'])) {
        // only show when signed in
        echo "<li><a href=\"./logout.php\">Log out</a></li>";
    }
    ?>
</ul>
</body>
</html>