<?php
session_start(); // Start the session
session_destroy(); // Destroy the session
header("Location: ../login/index.php"); // Redirect to login page
exit(); // Ensure that the script stops executing after the redirect
?>
