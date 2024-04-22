<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q3.1</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>


    <header>
        <div class="container">
            <h1>Question 3.1</h1>
        </div>
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
            //$dbname = "cse442_2024_spring_team_f_db";
            $dbname = "interns_cse442";
            $conn = new mysqli("oceanus.cse.buffalo.edu:3306", "shengans", '50404824', "cse442_2024_spring_team_f_db");
            $current = "SELECT data_percent FROM interns_cse442";
            $value = $conn->query($current);
            $european = 0;
            $asian = 0;
            $middle = 0;
            $usa = 0;
            if ($value->num_rows > 0){
                while($row = $value->fetch_assoc()){
                    $dict = json_decode($row["data_percent"],true);
                    $european = $dict["european"];
                    $asian = $dict["asian"];
                    $middle = $dict["middle"];
                    $usa = $dict["usa"];
                }
            }
            $sum = $european + $asian + $middle + $usa;
            if ($sum == 0){
                $html_european = "0%";
                $html_asian = "0%";
                $html_middle ="0%";
                $html_usa = "0%";
            }else{
                $html_european = strval(round(($european/$sum)*100,2) . '%');
                $html_asian = strval(round(($asian/$sum)*100,2) . '%');
                $html_middle = strval(round(($middle/$sum)*100, 2) . '%');
                $html_usa = strval(round(($usa/$sum)*100, 2) . '%');
            }
        ?>
        
    </header>
    <main>
        <div class="container">
            <form method="post" action="quizpage.php"> <!-- Modified form tag -->
                <p class="question">
                    <label>What kind of cuisine are you intertested in?</label>
                </p>
                <ul class="choices">
                    <li><input name="cuisine_choice" type="radio" onclick="recordClick('option1')" value="European" />European</li>
                    <?php echo "Selected percentage: $html_european<br>";?>
                    <li><input name="cuisine_choice" type="radio" onclick="recordClick('option2')" value="Asian" />Asian</li>
                    <?php echo "Selected percentage: $html_asian<br>";?>
                    <li><input name="cuisine_choice" type="radio" onclick="recordClick('option3')" value="Middle East" />Middle East</li>
                    <?php echo "Selected percentage: $html_middle<br>";?>
                    <li><input name="cuisine_choice" type="radio" onclick="recordClick('option4')" value="American" />American</li>
                    <?php echo "Selected percentage: $html_usa<br>";?>
                </ul>
                <input type="submit" value="NEXT" />
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