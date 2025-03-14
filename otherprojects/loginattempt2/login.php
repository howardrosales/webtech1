<?php

include "database.php";

if (isset($_COOKIE["student_no"])) {
    header("Location: home.php");
    exit;
}

session_start();

if (isset($_SESSION["login_msg"])) {
    echo $_SESSION["login_msg"];
    unset($_SESSION["login_msg"]);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        #suggestions {
            list-style-type: none;
            padding: 0;
            margin: 0;
            border: 1px solid #ccc;
            border-top: none;
        }

        #suggestions li {
            padding: 10px;
            border-top: 1px solid #ccc;
            cursor: pointer;
        }

        #suggestions li:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="process_login.php">
        <input type="number" id="studentNo" name="student_no" placeholder="Student No" required />
        <button type="submit">Login</button>
        <br />
        <input type="password" id="password" name="password" placeholder="Password" style="display: none" />
        <ul id="suggestions">
            <!-- Suggestions will be displayed here -->
        </ul>
    </form>
    <script>
        const log = console.log;
        
        const studentNo = document.getElementById("studentNo");
        const password = document.getElementById("password");
        const suggestions = document.getElementById("suggestions");

        studentNo.oninput = function () {
            if (studentNo.value.length > 0) {
                fetch("fetch_students_no.php?query=" + studentNo.value)
                .then(response => response.json())
                .then(data => {
                    suggestions.innerHTML = data.map(value => `<li onclick="applySuggestion(this)">${value}</li>`).join("");
                });

                checkPassword(studentNo.value).then(data => {
                    if (data === "true") {
                        password.style.display = "block";
                        password.required = true;
                    } else {
                        password.style.display = "none";
                        password.required = false;
                    }
                });
            } else {
                suggestions.innerHTML = "";
                password.style.display = "none";
            }
        }

        function checkPassword(studentNo) {
            return fetch("has_password.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: "student_no=" + studentNo,
            })
            .then(response => response.text())
            .then(data => {
                return data;
            });
        }

        function applySuggestion(suggestion) {
            studentNo.value = suggestion.innerText;
            suggestions.innerHTML = "";
            checkPassword(studentNo.value).then(data => {
                if (data === "true") {
                    password.style.display = "block";
                    password.required = true;
                    password.focus();
                } else {
                    password.style.display = "none";
                    password.required = false;
                    studentNo.focus();
                }
            });
        }
    </script>
</body>
</html>