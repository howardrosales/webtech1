<?php

session_start();

include "database.php";

$student_no = $_POST["student-no"];
$cookie_expiration = time() + 60*60*24*0 + 6;

$sql = "SELECT student_no FROM testtable WHERE student_no = $student_no AND status = 'pending'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $update_sql = "UPDATE testtable SET status = 'active' WHERE student_no = $student_no";
    mysqli_query($conn, $update_sql);
    
    setcookie("student_no", $student_no, $cookie_expiration, "/");

    $_SESSION["login_msg"] = "Login successful.";

    mysqli_close($conn);
    header("Location: welcome.php");
    exit;
} else {
    $_SESSION["login_msg"] = "Invalid student number or student number is already active.";
    
    mysqli_close($conn);
    header("Location: index.php");
    exit;
}

?>