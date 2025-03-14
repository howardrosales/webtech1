<?php

include "database.php";

session_start();

$student_no = $_POST["student_no"];
$password = $_POST["password"];

$sql = "SELECT student_no, password FROM $table_name WHERE student_no = $student_no";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);

if (mysqli_num_rows($result) > 0 && $password == mysqli_fetch_assoc($result)["password"]) {
    setcookie("student_no", $student_no, time() + 60*60*1, "/");

    $_SESSION["login_msg"] = "Login successful";
    header("Location: home.php");
    exit();
} else {
    $_SESSION["login_msg"] = "Login failed";

    if (!empty($password)) {
        $_SESSION["login_msg"] .= ": Incorrect password";
    } else {
        $_SESSION["login_msg"] .= ": Student number not found";
    }

    header("Location: login.php");
    exit();
}

?>