
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = new mysqli("oceanus.cse.buffalo.edu:3306", "shengans", '50404824', "cse442_2024_spring_team_f_db");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        echo "Connected successfully!";

    }
    
    // Get user choices from the form
    $destinedLocation = $_POST["destined-location"];
    $user_city = $_POST["user-city"];

    // insert data into the table
    $stmt = $mysqli->prepare("INSERT INTO user_data (destined_location, user_city) VALUES (?, ?)");
    $stmt->bind_param("ss", $destinedLocation, $user_city);
    $stmt->execute();

    // Close database
    $stmt->close();
    $mysqli->close();

    $data = [$destinedLocation,$user_city];

    // move page
    header("Location: catalogs.html");
    exit();
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
        .button-group button, .next-button, .compare-button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #C3B1E1;
            color: rgb(2, 2, 2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome</h1>
        <form method="post">
            <div class="question">
                <label for="destined-location">Enter a State:</label><br>
                <input type="text" name="destined-location" id="destined-location" class="answer-box">
            </div>
            <div class="question">
                <label for="user-city">Enter a City:</label><br>
                <input type="text" name="user-city" id="user-city" class="answer-box">
            </div>
            <input type="submit" value="Next to our quiz!" class="next-button" />
            <button class="next-button" onclick="goToCalendar()">Go To Calendar</button>
            <!-- Button to redirect to compare states -->
            
        </form>
        <button class="compare-button" onclick="window.location.href='comparecities.php'">Go To Compare Cites</button>
    </div>

    <script>
        function goToCalendar() {
            window.location.href = "calendar.php";
        }
    </script>
</body>
</html>