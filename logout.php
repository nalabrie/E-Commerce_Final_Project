<?php

// perform log-out
session_start();
unset($_SESSION["username"]);
unset($_SESSION["password"]);

// wait 2 seconds and redirect to account page
echo 'You have been signed out. Redirecting to website...';
header('Location: account.php');