<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q3.4</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
    <header>
        <div class="container">
            <h1>Question 3.4</h1>
        </div>
    </header>
    <style>
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
    <?php
            $dbname = "interns_cse442";
            $conn = new mysqli("oceanus.cse.buffalo.edu:3306", "shengans", '50404824', "cse442_2024_spring_team_f_db");
            $current = "SELECT data_percent FROM interns_cse442";
            $value = $conn->query($current);
            $museum = 0;
            $book = 0;
            $site = 0;
            $nature = 0;
            if ($value->num_rows > 0){
                while($row = $value->fetch_assoc()){
                    $dict = json_decode($row["data_percent"],true);
                    $museum = $dict["museum"];
                    $book = $dict["book"];
                    $site = $dict["site"];
                    $nature = $dict["nature"];
                }
            }
            $sum = $museum + $book + $site + $nature;
            if ($sum == 0){
                $html_museum = "0%";
                $html_book = "0%";
                $html_site = "0%";
                $html_nature ="0%";
            }
            else{
                $html_museum = strval(round(($museum/$sum)*100, 2) . '%');
                $html_book = strval(round(($book/$sum)*100, 2) . '%');
                $html_site = strval(round(($site/$sum)*100, 2) . '%');
                $html_nature = strval(round(($nature/$sum)*100, 2) . '%');
            }
    ?>
    <main>
        <div class="container">
            <p>
                <label>What type of study do you like to do?</label>
            </p>
            <form method="post" action="quizpage.php">
                <ul class="choices">
                    <li><input name="choice" type="radio" onclick="recordClick('option1')" value="Visit museums to learn about history" />Visit Museums to learn about history</li>
                    <?php echo "Selected percentage: $html_museum<br>";?>
                    <li><input name="choice" type="radio" onclick="recordClick('option2')" value="Visit the nature to see the history of our planet" />Visit the nature to see the history of our planet</li>
                    <?php echo "Selected percentage: $html_book<br>";?>
                    <li><input name="choice" type="radio" onclick="recordClick('option3')" value="Visit historical sites to live the moment" />Visit historical sites to live the moment</li>
                    <?php echo "Selected percentage: $html_site<br>";?>
                    <li><input name="choice" type="radio" onclick="recordClick('option4')" value="Visit public institution" />Visit public institution</li>
                    <?php echo "Selected percentage: $html_nature<br>";?>
                </ul>
                <input type="submit" value="Submit" />
            </form>
        </div>
        
    </main>

    <footer>
        <div class="container">
            Interns &copy;2024, Quiz
        </div>
    </footer>
</body>
</html>