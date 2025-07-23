<?php
session_start();
session_destroy();

echo "User has logged out, " . $_SESSION['user_name'] . "!";

// echo "<br><a href='user-login.php'>Login</a>";
header("Refresh:2, url=../index.php");
?>