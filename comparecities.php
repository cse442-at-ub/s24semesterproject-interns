

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Comparison</title>
    <style>
        /* CSS styles can be added here */
        body {
            font-family: 'Times New Roman', Times, serif, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #C3B1E1;
            display: flex;
            justify-content: center;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #CCCCFF;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        h1, h2 {
            width: 100%;
            text-align: center;
        }
        .question, .results {
            width: 100%;
            margin-bottom: 25px;
            text-decoration: underline;
        }
        label {
            font-weight: bold; /* Makes all labels bold */
            display: block;
            margin-bottom: 5px;
            font-size: 20px; 
        }
        .answer-box, .result-box {
            width: 100%;
            padding: 10px;
            font-size: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .state-info {
            width: 45%; /* Each state info takes up about half the container width */
            padding: 15px;
        }
        .result-section {
            width: 100%; /* Full width to separate the form and results visually */
            display: flex;
            justify-content: space-between;
        }
        .button-group {
            text-align: center;
            width: 100%;
        }
        .button-group button, .back-button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #C3B1E1;
        }
        .button-group button.active, .back-button {
            background-color: #4CAF50;
            color: rgb(2, 2, 2);
        }
        .next-button {
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
        }
        .result-box {
            border: 6px solid #C3B1E1; /* Increased border thickness */
            background-color: #E6E0F8; /* Lighter shade of purple for background */
        }
        .state-info h2 {
            font-size: 35px; /* Increased font size for state information titles */
        }
    </style>
</head>
<!-- <script>
    function goToHomepage() {
        window.location.href = 'welcome.php';
    }
</script> -->

<body>
    <div class="container">
        <h1>Compare Cities</h1>
        <form method="post">
            <div class="question">
                <label for="city1">Enter City 1:</label><br>
                <input type="text" name="city1" id="city1" class="answer-box" value="<?php echo isset($_POST['city1']) ? $_POST['city1'] : ''; ?>">
            </div>
            <div class="question">
                <label for="city2">Enter City 2:</label><br>
                <input type="text" name="city2" id="city2" class="answer-box" value="<?php echo isset($_POST['city2']) ? $_POST['city2'] : ''; ?>">
            </div>
            <div class="button-group">
                <button type="submit">Compare Cities</button>
                <!-- <button class="back-button" onclick="goToHomepage()">Go Back to Homepage</button> -->
            </div>
        </form>

        <div class="button-group">
            <button class="back-button" onclick="window.location.href='welcome.php';">Go Back to Homepage</button>
        </div>

        
        <?php
        // Check if the form is submitted
        if(isset($_POST['city1']) && isset($_POST['city2'])) {
            // Read CSV file and get city data
            $file = fopen("cities.csv", "r");
            $cities = [];
            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                $cities[] = $data;
            }
            fclose($file);

            // Get user input
            $city1Name = $_POST['city1'];
            $city2Name = $_POST['city2'];

            // Find city data by name
            $city1 = null;
            $city2 = null;
            foreach ($cities as $city) {
                if (strcasecmp($city[1], $city1Name) === 0) {
                    $city1 = $city;
                }
                if (strcasecmp($city[1], $city2Name) === 0) {
                    $city2 = $city;
                }
                if ($city1 && $city2) {
                    break;
                }
            }

            // Display comparison results
            echo "<div class='result-section'>";
            echo "<div class='state-info'>";
            echo "<h2>City 1 Information:</h2>";
            if ($city1) {
                echo "<p>City: {$city1[1]}</p>";
                echo "<p>State: {$city1[2]}</p>";
                echo "<p>Population: {$city1[8]}</p>";
                echo "<p>Density: {$city1[9]}</p>";
            } else {
                echo "<p class='result-box'>City 1 not found.</p>";
            }
            echo "</div>";
            echo "<div class='state-info'>";
            echo "<h2>City 2 Information:</h2>";
            if ($city2) {
                echo "<p>City: {$city2[1]}</p>";
                echo "<p>State: {$city2[2]}</p>";
                echo "<p>Population: {$city2[8]}</p>";
                echo "<p>Density: {$city2[9]}</p>";
            } else {
                echo "<p class='result-box'>City 2 not found.</p>";
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
