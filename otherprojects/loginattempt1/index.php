<?php

session_start();

include "database.php";

if (isset($_COOKIE["student_no"])) {
    header("Location: welcome.php");
    exit;
}

if (isset($_SESSION["login_msg"])) {
    echo $_SESSION["login_msg"];
    unset($_SESSION["login_msg"]);
}

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>

    </style>
</head>
<body>
    <h1>Login</h1>
    <form action="process.php" method="POST">
        <input type="number" id="studentNo" name="student-no" placeholder="Student no: " required />
        <input type="submit" value="login" />
        <ul id="suggestions">
            <!-- Suggestions will be displayed here -->
        </ul>
    </form>
    <script>
        const log = console.log;

        document.getElementById("studentNo").oninput = function () {
            const query = this.value;
            const suggestions = document.getElementById("suggestions");

            if (query.length > 0) {
                fetch("fetch_students_no.php?query=" + query)
                    .then(response => response.json())
                    .then(data => {
                        suggestions.innerHTML = data.map(value => `<li onclick="applySuggestion(this)">${value}</li>`).join("\n");
                    });
            } else {
                suggestions.innerHTML = "";
            }
        }

        function applySuggestion(suggestion) {
            document.getElementById("studentNo").value = suggestion.innerText;
            document.getElementById("suggestions").innerHTML = "";
        }

    </script>
</body>
</html>