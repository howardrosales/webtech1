<?php

include "database.php";

if (isset($_POST["submit"])) {
    $file = $_FILES["file"];
    $total_files = count($file["name"]);
    $is_uploaded = false;

    for ($i = 0; $i < $total_files; $i++) {
        $file_name = $file["name"][$i];
        $file_tmp_name = $file["tmp_name"][$i];
        $file_size = $file["size"][$i];
        $file_error = $file["error"][$i];
        $file_type = $file["type"][$i];
        
        $file_ext = explode(".", $file_name);
        $file_actual_ext = strtolower(end($file_ext));

        $allowed = ["jpg", "jpeg", "png", "gif", "pdf", "mp4", "php"];
        if (in_array($file_actual_ext, $allowed)) {
            if ($file_error === 0) {
                $file_new_name = uniqid("", true).".$file_actual_ext";
                $file_destination = "uploads/$file_new_name";
                if (move_uploaded_file($file_tmp_name, $file_destination)) {
                    $sql = "INSERT INTO $table_name (file_name, file_path, file_ext, upload_time) VALUES ('$file_name', '$file_destination', '$file_actual_ext', NOW())";
                    $result = mysqli_query($conn, $sql);
                    $is_uploaded = true;
                    
                } else {
                    echo "File cannot be moved";
                }
            } else {
                echo "File upload error";
            }
        } else {
            echo "You cannot upload files of this type: $file_actual_ext";
        }
    }
    if ($is_uploaded) {
        header("Location: home.php?upload=success");
        exit();
    }
}

mysqli_close($conn);
echo "<br />";
echo "<a href='home.php'>Back</home>";

?>