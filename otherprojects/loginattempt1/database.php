<?php

$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "test";
$conn = "";

$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

echo $conn ? "Connected" : "Not connected";
echo "<br>";

?>