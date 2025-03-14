<?php

include "database.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style></style>
</head>
<body>
    <h1>Home</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file[]" required multiple />
        <button type="submit" name="submit">Upload</button>
    </form>
    <h1>Files</h1>
    <table>
        <thead>
            <tr>
                <th>FILE PREVIEW</th>
                <th>FILE NAME</th>
                <th>FILE PATH</th>
                <th>UPLOAD TIME</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "SELECT * FROM $table_name ORDER BY upload_time DESC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

                foreach ($row as $data) {
                    echo "<tr>";
                    if (in_array($data["file_ext"], ["jpg", "jpeg", "png", "gif"])) {
                        echo "<td><img src='".$data["file_path"]."' width='200' height='200' /></td>";
                    } else if (in_array($data["file_ext"], ["mp4", "webm", "ogg"])) {
                        echo "<td><video width='200' height='200' controls><source src='".$data["file_path"]."' type='video/".$data["file_ext"]."'></video></td>";
                    } else {
                        echo "<td><a href='".$data["file_path"]."'>View</a></td>";
                    }
                    echo "<td>".$data["file_name"]."</td>";
                    echo "<td>".$data["file_path"]."</td>";
                    echo "<td>".$data["upload_time"]."</td>";
                    echo "<td><a href='download.php?id=".$data["id"]."'>Download</a></td>";
                    echo "</tr>";
                }
            }

            ?>
        </tbody>
    </table>
</body>
</html>