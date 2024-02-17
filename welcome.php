<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data and redirect accordingly
    if (isset($_POST["destination"])) {
        $destination = $_POST["destination"];
        if ($destination === "local" || $destination === "tourist") {
            // Redirect to quiz.html
            header("Location: quiz.html");
            exit;
        }
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
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
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
        <form method="post">
            <div class="question">
                <label for="destined-location">What is your destined location?</label><br>
                <input type="text" name="destined-location" id="destined-location" class="answer-box">
            </div>
            <div class="question">
                <label>Are you a local or tourist?</label><br>
                <div class="button-group">
                    <button type="submit" name="destination" value="local">Local</button>
                    <button type="submit" name="destination" value="tourist">Tourist</button>
                </div>
            </div>
        </form>
        <form action="quiz.html">
            <button class="next-button" type="submit">Next</button>
        </form>
    </div>
</body>
</html>
