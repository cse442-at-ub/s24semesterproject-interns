<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>State Comparison</title>
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
        <form method="post">
            <div class="question">
                <label for="state1">Enter State 1:</label><br>
                <input type="text" name="state1" id="state1" class="answer-box">
            </div>
            <div class="question">
                <label for="state2">Enter State 2:</label><br>
                <input type="text" name="state2" id="state2" class="answer-box">
            </div>
            <div class="button-group">
                <button type="submit">Compare States</button>
            </div>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $state1 = $_POST["state1"];
            $state2 = $_POST["state2"];

            $csvFile = file("states_data.csv");
            $data = [];
            foreach ($csvFile as $line) {
                $data[] = str_getcsv($line);
            }

            $state1Data = null;
            $state2Data = null;

            foreach ($data as $row) {
                if ($row[0] === $state1) {
                    $state1Data = $row;
                }
                if ($row[0] === $state2) {
                    $state2Data = $row;
                }
            }

            if ($state1Data && $state2Data) {
                echo "<h2>Comparison Results</h2>";
                echo "<p>{$state1Data[0]}:</p>";
                echo "<ul>";
                echo "<li>Most Popular Ranking: {$state1Data[1]}</li>";
                echo "<li>Population Growth (07/2021 to 07/2022): {$state1Data[2]} ({$state1Data[3]}%)</li>";
                echo "</ul>";
                echo "<p>{$state2Data[0]}:</p>";
                echo "<ul>";
                echo "<li>Most Popular Ranking: {$state2Data[1]}</li>";
                echo "<li>Population Growth (07/2021 to 07/2022): {$state2Data[2]} ({$state2Data[3]}%)</li>";
                echo "</ul>";
            } else {
                echo "<p>Invalid state names entered. Please try again.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
