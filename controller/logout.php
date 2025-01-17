<?php
session_start();
session_unset();
session_destroy();
setcookie('logged_in', '', time() - 3600, '/'); // Expire the cookie
header("Location: ../view/login.php");
exit;
?>

