<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the MySQL database
    $mysqli = new mysqli("localhost", "root", "", "home_page");
    // mysqli_connect("localhost", "root", "", "Home_page");
    
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    // if (mysqli_connect_errno()){
    //     echo "connect failed". mysqli_connect_error();
    // }
    // echo "successful";


    // Get user choices from the form
    $destinedLocation = $_POST["destined-location"];
    $userStatus = $_POST["user-status"];

    // insert data into the table
    $stmt = $mysqli->prepare("INSERT INTO user_data (destined_location, user_status) VALUES (?, ?)");
    $stmt->bind_param("ss", $destinedLocation, $userStatus);
    $stmt->execute();

    // Close database
    $stmt->close();
    $mysqli->close();

    // move page
    if ($userStatus === "local") {
        header("Location: local.html");
        exit();
    } elseif ($userStatus === "tourist") {
        header("Location: tourist.html");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        /* CSS styles can be added here */
        body {
            font-family: 'Times New Roman', Times, serif, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #C3B1E1;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #CCCCFF;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
        }
        .question {
            margin-bottom: 20px;
        }
        .answer-box {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .button-group {
            text-align: center;
        }
        .button-group button {
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-group button.active {
            background-color: #4CAF50;
            color: white;
        }
        .next-button {
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome</h1>
        <div class="question">
            <label for="destined-location">What is your destined location?</label><br>
            <input type="text" id="destined-location" class="answer-box">
        </div>
        <div class="question">
            <label>Are you a local or tourist?</label><br>
            <div class="button-group">
                <button id="local-btn" onclick="selectLocal()">Local</button>
                <button id="tourist-btn" onclick="selectTourist()">Tourist</button>
            </div>
        </div>
        <button class="next-button" onclick="goToNext()">Next</button>
    </div>

    <script>
        let selectedStatus = "";

        function selectLocal() {
            selectedStatus = "local";
            document.getElementById("local-btn").classList.add("active");
            document.getElementById("tourist-btn").classList.remove("active");
        }

        function selectTourist() {
            selectedStatus = "tourist";
            document.getElementById("tourist-btn").classList.add("active");
            document.getElementById("local-btn").classList.remove("active");
        }

        function goToNext() {
            if (selectedStatus === "local") {
                window.location.href = "local.html";
            } else if (selectedStatus === "tourist") {
                window.location.href = "tourist.html";
            } else {
                alert("Please select your status!");
            }
        }
    </script>
</body>
</html>
