<?php

// perform log-out
session_start();
unset($_SESSION["username"]);
unset($_SESSION["password"]);

// TODO: "log out" from database too?
// TODO: unset "valid" session variable?

// wait 2 seconds and redirect to account page
header("Refresh: 3; url=account.php");
echo 'You have been signed out. Redirecting to website...';
die();
?>