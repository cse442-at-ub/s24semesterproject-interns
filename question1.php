<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q1</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <h1>Question 1</h1>
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
            width: 101075%;
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
        //$dbname = "interns_cse442";
        $dbname = "my442db";
        $conn = new mysqli("", "root", "", $dbname);
        $current = "SELECT data_percent FROM mydb";
        $value = $conn->query($current);
        $yes = 0;
        $no = 0;
        $sum = 0;
        if ($value->num_rows > 0){
            while($row = $value->fetch_assoc()){
                $dict = json_decode($row["data_percent"],true);
                $yes = $dict["yes"];
                $no = $dict["no"];
            }
        }
        $sum = $yes + $no;
        if ($sum == 0){
            $html_yes = "0%";
            $html_no = "0%";
        }else{
            $html_yes = strval(round(($yes/$sum)*100, 2) . '%');
            $html_no = strval(round(($no/$sum)*100, 2) . '%');
        }
        //session_start();$_SESSION['back_1'] = False;$_SESSION['question1'] = False;
    ?>
     
   
    <main>
        <div class="container">
        <form method="post" action="back.php">
            <input type="submit" name="back1"value="BACK">
        </form>
        <form method="post" action="quizpage.php"> 
                <p class="question">
                    <label>Do you like alcohol?</label>
                </p>
                <div class="choices">
                    <input name="alcohol_choice" type="radio" value="Yes">
                    <label for="Yes">Yes<br><?php echo "Selected percentage: $html_yes<br>";?></label>
                    <input name="alcohol_choice" type="radio" value="No">
                    <label for="No">No<br><?php echo "Selected percentage: $html_no<br>";?></label>
                </div>
                <button id="next">NEXT</button>
                <script> 
                    // Get the button element
                    var button = document.getElementById("next");
                    // Add a click event listener to the button
                    button.addEventListener("click", function() {
                        var alcoholChoice = document.querySelector('input[name="alcohol_choice"]:checked');
                        if (!alcoholChoice) {
                            //window.location.replace("question1.php");
                            alert("You have not selected any options yet!");
                            
                            <?php session_start();$_SESSION['question1'] = False;?>
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

