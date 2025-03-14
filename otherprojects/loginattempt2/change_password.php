<?php

ob_start(); // Turn on output buffering
include "database.php";
ob_end_clean(); // Clean the buffer

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_no = $_POST["student_no"];
    $password = $_POST["password"];

    $result = "";

    if (empty($password)) {
        $sql = "UPDATE $table_name SET password = NULL WHERE student_no = $student_no";
        $result = mysqli_query($conn, $sql);
    } else {
        $sql = "UPDATE $table_name SET password = '$password' WHERE student_no = $student_no";
        $result = mysqli_query($conn, $sql);
    }
    
    if ($result) {
        echo "Password changed successfully";
    } else {
        echo "Password change failed";
    }
}

mysqli_close($conn);

?>