<?php

$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "test";
$table_name = "filesharing";
$conn = "";

$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "display_table") {
    echo display_table();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $id = intval($_POST["delete"]);
    $sql = "SELECT * FROM $table_name WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $file = mysqli_fetch_assoc($result);
        $file_path = $file["file_path"];

        if (file_exists($file_path)) {
            if (!unlink($file_path)) {
                echo "can't delete PHP";
                exit;
            }
        }
    }

    $sql = "DELETE FROM $table_name WHERE id = $id";
    if (!mysqli_query($conn, $sql)) {
        echo "can't delete MYSQL";
        exit;
    }

    echo display_table();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["download"])) {
    $id = intval($_POST["download"]);
    $sql = "SELECT * FROM $table_name WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $file = mysqli_fetch_assoc($result);
        $file_name = $file["file_name"];
        $file_path = $file["file_path"];
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (file_exists($file_path)) {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=".basename($file_name));
            if ($ext === "apk") {
                header("Content-Type: application/vnd.android.package-archive");
            } else {
                header("Content-Type: ".mime_content_type($file_path));
            }
            header("Content-Transfer-Encoding: binary");
            header("Expires: 0");
            
            readfile($file_path);
        }
    }
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];
    $is_uploaded = "true";

    for ($i = 0; $i < count($file["name"]); $i++) {
        $file_name = $file["name"][$i];
        $file_tmp = $file["tmp_name"][$i];
        $file_error = $file["error"][$i];
        $file_path = "uploads/".basename($file_name);
        
        if (move_uploaded_file($file_tmp, $file_path)) {
            $sql = "SELECT file_name FROM $table_name WHERE file_name = '$file_name'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $sql = "DELETE FROM $table_name WHERE file_name = '$file_name'";
                mysqli_query($conn, $sql);
            }
            $sql = "INSERT INTO $table_name (file_name, file_path) VALUES ('$file_name', '$file_path')";
            mysqli_query($conn, $sql);
        } else {
            echo "File can't be moved";
            $is_uploaded = "false";
            exit;
        }
    }
    echo $is_uploaded;
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

function display_table() {
    global $conn, $table_name;

    $sql = "SELECT * FROM $table_name ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $table = "";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            $name = $row["file_name"];
            $table .= "<tr>";
            $table .= "<td>$name</td>";
            $table .= "<td>";
            $table .= "<iframe name='actionFrame$id' hidden></iframe>";
            $table .= "<form action='filesharing.php' method='POST' target='actionFrame$id'>";
            $table .= "<button type='submit' name='download' value=$id>Download</button>";
            $table .= "<button type='button' onclick='handleDelete($id)'>Delete</button>";
            $table .= "</form>";
            $table .= "</td>";
            $table .= "</tr>";
        }
    }
    return $table;
}

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
        <input type="file" id="fileInput" name="file[]" required multiple />
        <button type="submit" id="submitBtn" name="submit">Submit</button>
        <p id="msg"></p>
    </form>
    <h4>Uploaded file:</h4>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableBody"></tbody>
    </table>
    <script>
        const log = console.log;
        const uploadForm = document.getElementById("uploadForm");
        const fileInput = document.getElementById("fileInput");
        const submitBtn = document.getElementById("submitBtn");
        const msg = document.getElementById("msg");
        const tableBody = document.getElementById("tableBody");
        
        displayTable();

        uploadForm.onsubmit = function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fileInput.disabled = true;
            submitBtn.disabled = true;
            msg.innerText = "Uploading, please wait...";
            fetch("filesharing.php", {
                method: "POST",
                body: formData,

            })
            .then(response => response.text())
            .then(data => {
                if (data == "true") {
                    uploadForm.reset();
                    displayTable();
                }
            })
            .finally(() => {
                fileInput.disabled = false;
                submitBtn.disabled = false;
                msg.innerText = "File uploaded successfully";
            });
        }
        
        function handleDelete(id) {
            fetch("filesharing.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "delete=" + id,
            })
            .then(response => response.text())
            .then(data => {
                tableBody.innerHTML = data;
            })
        }
        
        function displayTable() {
            fetch("filesharing.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "action=display_table",
            })
            .then(response => response.text())
            .then(data => {
                tableBody.innerHTML = data;
            })
        }

    </script>
</body>
</html>