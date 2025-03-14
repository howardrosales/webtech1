<?php

include "database.php";

if (!isset($_COOKIE["student_no"])) {
    header("Location: login.php");
    exit();
}

session_start();

if (isset($_SESSION["login_msg"])) {
    echo $_SESSION["login_msg"];
    unset($_SESSION["login_msg"]);
}

$student_no = $_COOKIE["student_no"];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        #msg {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Home</h1>
    <form id="changePassword">
        <input type="password" id="password" name="password" placeholder="Password" />
        <input type="submit" value="Change Password" />
        <p id="msg"></p>
    </form>
    <button onclick="location.href='logout.php'">Logout</button>
    <script>
        const log = console.log;

        const changePassword = document.getElementById("changePassword");

        changePassword.onsubmit = function (e) {
            e.preventDefault();
            
            const password = document.getElementById("password").value;
            fetch("change_password.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: "student_no=<?php echo $student_no; ?>&password=" + encodeURIComponent(password),
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("msg").textContent = data;
            });
        }
    </script>
</body>
</html>