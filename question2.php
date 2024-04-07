<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q2</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
    <header>
        <div class="container">
            <h1>Question 2</h1>
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
        //$dbname = "cse442_2024_spring_team_f_db";
        $dbname = "interns_cse442";
        $conn = new mysqli("oceanus.cse.buffalo.edu:3306", "shengans", '50404824', "cse442_2024_spring_team_f_db");
        $current = "SELECT data_percent FROM interns_cse442";
        $value = $conn->query($current);
        $food = 0;
        $experience = 0;
        $shopping = 0;
        $study = 0;
        if ($value->num_rows > 0){
            while($row = $value->fetch_assoc()){
                $dict = json_decode($row["data_percent"],true);
                $food = $dict["food"];
                $experience = $dict["experience"];
                $shopping = $dict["shopping"];
                $study = $dict["study"];
            }
        }
        $sum = $food + $experience + $shopping + $study;
        if ($sum == 0){
            $html_food = "0%";
            $html_ex = "0%";
            $html_shop = "0%";
            $html_study = "0%";
        }else{
            $html_food = strval(round(($food/$sum)*100,2) . '%');
            $html_ex = strval(round(($experience/$sum)*100,2) . '%');
            $html_shop = strval(round(($shopping/$sum)*100,2) . '%');
            $html_study = strval(round(($study/$sum)*100 ,2). '%');
        }

    ?>
    <main>
        <div class="container">
            <form method="post" action="quizpage.php"> 
                <p class="question">
                    <label>What is the purpose of your travel?</label>
                </p>
                <ul class="choices">
                    <li><input name="purpose_choice" type="radio" onclick="recordClick('option1')" value="For Food" />For Food</li>
                    <?php echo "Selected percentage: $html_food<br>";?>
                    <li><input name="purpose_choice" type="radio" onclick="recordClick('option2')" value="For the experience" />For the experience</li>
                    <?php echo "Selected percentage: $html_ex<br>";?>
                    <li><input name="purpose_choice" type="radio" onclick="recordClick('option3')" value="For Shopping" />For Shopping</li>
                    <?php echo "Selected percentage: $html_shop<br>";?>
                    <li><input name="purpose_choice" type="radio" onclick="recordClick('option4')" value="For Academic Purpose" />For Academic Purpose</li>
                    <?php echo "Selected percentage: $html_study<br>";?>
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