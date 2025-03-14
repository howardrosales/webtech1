<?php

$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "test";
$table_name = "filesharing";
$conn = "";

$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES["file"];
    $file_name = $file["name"];
    $file_tmp = $file["tmp_name"];
    $file_error = $file["error"];
    $file_path = "uploads/".basename($file_name);

    if (move_uploaded_file($file_tmp, $file_path)) {
        echo "true";
    } else {
        echo "Error file moving";
    }
    // print_r($file);
    // echo $file_path;
    exit;
}

echo "Database: ";
echo $conn ? "Connected" : "Not connected";
echo "<br />";

$os = PHP_OS;
echo "OS: $os<br />";

$ip = "";
if (strtoupper(substr(PHP_OS, 0, 3)) === "WIN") {
    $ip = shell_exec("ipconfig");
    print_r($ip);
} else {
    $ip = explode(" ", shell_exec("hostname -I"))[0];
    echo "IP: $ip<br />";
}

$file_path = str_replace($_SERVER["DOCUMENT_ROOT"], "", __FILE__);
echo "URL: http://$ip$file_path<br />";

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>filesharing</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style></style>
</head>
<body>
    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="file" required />
        <button type="submit" name="submit">Submit</button>
    </form>
    <script>
        const log = console.log;
        const uploadForm = document.getElementById("uploadForm");

        uploadForm.onsubmit = function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            log(formData);
            fetch("<?php echo $_SERVER['PHP_SELF']; ?>", {
                method: "POST",
                body: formData,
            })
            .then(response => response.text())
            .then(data => {
                log(data);
            })
        }
    </script>
</body>
</html>