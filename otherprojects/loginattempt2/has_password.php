<?php

ob_start(); // Turn on output buffering
include "database.php";
ob_end_clean(); // Clean the buffer

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_no = $_POST["student_no"];
    
    $sql = "SELECT password FROM $table_name WHERE student_no = $student_no AND password IS NOT NULL";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "true";
    } else {
        echo "false";
    }
}

mysqli_close($conn);

?>