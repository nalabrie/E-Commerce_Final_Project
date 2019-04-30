<?php

// perform log-out
session_start();
unset($_SESSION["username"]);
unset($_SESSION["password"]);

// wait 2 seconds and redirect to account page
echo 'You have been signed out.';
header('Refresh: 2; URL = account.php');
?>