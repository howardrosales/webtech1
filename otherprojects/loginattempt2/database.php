<?php

$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "test";
$table_name = "testtable2";
$conn = "";

$conn = mysqli_connect($db_server, $db_name, $db_password, $db_name);
echo $conn ? "Connected" : "Not connected";
echo "<br>";

?>