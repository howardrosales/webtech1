<?php

session_start();

include "database.php";

if (!isset($_COOKIE["student_no"])) {
    header("Location: index.php");
    exit;
}

echo $_SESSION["login_msg"]."<br>";
unset($_SESSION["login_msg"]);

$sql = "SELECT * FROM testtable WHERE id LIKE '%'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    print_r($row);
    echo "<br>";
}

?>