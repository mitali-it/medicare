<?php

session_start();

unset($_SESSION["admin"]);
unset($_SESSION["admin_username"]);

session_destroy();

header("Location: admin-login.php");
exit();

?>