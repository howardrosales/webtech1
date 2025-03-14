<?php

ob_start();
include "database.php";
ob_end_clean();

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $sql = "SELECT * FROM $table_name WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $file = mysqli_fetch_assoc($result);
        $file_path = $file["file_path"];
        $file_name = $file["file_name"];

        if (file_exists($file_path)) {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=".basename($file_name));
            header("Content-Type: ".mime_content_type($file_path));
            header("Content-Transfer-Encoding: binary");
            header("Expires: 0");
            
            readfile($file_path);
            exit;
        } else {
            echo "File not found";
        }
    } else {
        echo "Invalid file ID";
    }
} else {
    echo "No file ID specified";
}

mysqli_close($conn);

?>