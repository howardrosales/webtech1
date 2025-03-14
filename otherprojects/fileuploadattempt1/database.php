<?php

$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "test";
$table_name = "filetable";
$conn = "";

$conn = mysqli_connect($server_name, $db_username, $db_password, $db_name);

echo $conn ? "Connected to database" : "Failed to connect to database";
echo "<br>";

?>