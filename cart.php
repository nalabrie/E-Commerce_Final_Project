<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart - Final Project - Nicky Labrie</title>
</head>
<body>
<?php include("./navbar.inc"); ?>

<?php
// these two lines are needed to keep the user logged in throughout the site
ob_start();
session_start();
?>

<br>

<?php
// can not use cart if user is not signed in
if (!isset($_SESSION['username'])) {
    echo "Orders can't be placed unless you are signed in. Either <a href='create_account.php'>create an account</a> or <a href='account.php'>sign in</a>.";
}
else {
    var_dump($_SESSION['cartArray']);

    // TODO: items aren't adding to on this page, probably another session issue











//    // user is signed in, check if cart is empty
//    if (isset($_SESSION['cartArray']) || count($_SESSION['cartArray']) === 0) {
//        // cart is empty, do not show table
//        echo "Cart is empty! Add items to order at the <a href='menu.php'>menu</a> page.";
//    }
//    else {
//        // cart has items, show table
//        echo "table goes here";
//    }
}
?>


<!--
TODO: NOTES BELOW THIS LINE

1. the cart is checkboxes holding ITEM_NUM but should be displayed to the user ONLY IF box is checked AND show DESCRIPTION rather than a number
//-->
</body>
</html>
