<?php

include "database.php";

session_start();

$_SESSION["login_msg"] = "Logout successful";
setcookie("student_no", "", time() - 1, "/");
header("Location: login.php");
exit();

?>