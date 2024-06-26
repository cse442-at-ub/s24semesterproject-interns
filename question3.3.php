<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q3.3</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
    <header>
        <div class="container">
            <h1>Question 3.3</h1>
        </div>
    </header>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 20px;
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
            background-color: #C3B1E1;
            color: white;
        }
    </style>
    <?php
            $dbname = "my442db";
            //$dbname = "interns_cse442";
            $conn = new mysqli("", "root", "", $dbname);
            $current = "SELECT data_percent FROM mydb";
            $value = $conn->query($current);
            $wear = 0;
            $elect = 0;
            $grocery = 0;
            $necess = 0;
            if ($value->num_rows > 0){
                while($row = $value->fetch_assoc()){
                    $dict = json_decode($row["data_percent"],true);
                    $wear = $dict["wear"];
                    $elect = $dict["elect"];
                    $grocery = $dict["grocery"];
                    $necess = $dict["necess"];
                }
            }
            $sum = $wear + $elect + $grocery + $necess;
            if ($sum == 0){
                $html_wear = "0%";
                $html_elect = "0%";
                $html_gro = "0%";
                $html_necess = "0%";
            }else{
                $html_wear = strval(round(($wear/$sum)*100, 2) . '%');
                $html_elect = strval(round(($elect/$sum)*100, 2) . '%');
                $html_gro = strval(round(($grocery/$sum)*100 ,2). '%');
                $html_necess = strval(round(($necess/$sum)*100,2) . '%');
            }
    ?>
    <main>
        <div class="container">
        <form method="post" action="back.php">
            <input class="next-button" type="submit" name="back3" value="BACK">
        </form>
            <form method="post" action="quizpage.php"> 
                <p class="question">
                    <label>What are you shopping for?</label>
                </p>
                <ul class="choices">
                    <li><input name="shopping_choice" type="radio" onclick="recordClick('option1')" value="Wearable items" />Wearable items</li>
                    <?php echo "Selected percentage: $html_wear<br>";?>
                    <li><input name="shopping_choice" type="radio" onclick="recordClick('option2')" value="Electronics" />Electronics</li>
                    <?php echo "Selected percentage: $html_elect<br>";?>
                    <li><input name="shopping_choice" type="radio" onclick="recordClick('option3')" value="Grocery" />Grocery</li>
                    <?php echo "Selected percentage: $html_gro<br>";?>
                    <li><input name="shopping_choice" type="radio" onclick="recordClick('option4')" value="Necessities" />Necessities</li>
                    <?php echo "Selected percentage: $html_necess<br>";?>
                </ul>
                <button class="next-button" id="next">NEXT</button>
                <script>
                    // Get the button element
                    var button = document.getElementById("next");
                    // Add a click event listener to the button
                    button.addEventListener("click", function() {
                        var shopping_choice = document.querySelector('input[name="shopping_choice"]:checked');
                        if (!shopping_choice) {
                            //window.location.replace("question1.php");
                            alert("You have not selected any options yet!");
                            
                            <?php session_start();$_SESSION['question3.3'] = False;?>
                        }
                        });
                </script>  
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