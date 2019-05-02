<?php

// perform log-out
session_start();
session_destroy();

// wait 3 seconds and redirect to account page
header("Refresh: 3; url=account.php");
echo 'You have been signed out. Redirecting to website...';
die();
?>