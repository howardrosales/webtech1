<?php

ob_start(); // Turn on output buffering
include "database.php";
ob_end_clean(); // Clean the buffer

if (isset($_GET["query"])) {
    $query = $_GET["query"];
    $sql = "SELECT student_no FROM testtable WHERE student_no LIKE '$query%' ORDER BY student_no";
    $result = mysqli_query($conn, $sql);

    $suggestions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $suggestions[] = $row["student_no"];
    }
    echo json_encode($suggestions);
}

mysqli_close($conn);

?>