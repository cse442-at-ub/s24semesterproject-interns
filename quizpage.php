<?php
$answer = '';
$keyword = [];
$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "cse442_2024_spring_team_f_db";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
    echo "Connected successfully";
}
/*
// Create database
$sql = "CREATE DATABASE my442DB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answer == $_POST["Nope"];
    echo "the result will be $answer<br>";
    /*
    if (isset($_POST["history_choice"])) {
        echo "hello";
        $mysql = "INSERT INTO myDB (q1)VALUES ($answer)";
        if ($_POST["history_choice"] != NULL) {
            header('Location:question2.html');
            exit;
        }
    }
    */
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answer == $_POST["alcohol_choice"];
    if (isset($_POST["alcohol_choice"])) {
        echo "hello";
        
        $mysql = "INSERT INTO inters_cse442 (q2)VALUES ($answer)";
        if ($_POST["alcohol_choice"] != NULL) {
            header('Location:question3.html');
            exit;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answer == $_POST["purpose_choice"];
    if (isset($_POST["purpose_choice"])) {
        echo "hello";
        
        $mysql = "INSERT INTO inters_cse442 (q3)VALUES ($answer)";
        if ($_POST["purpose_choice"] != NULL) {
            header('Location:question4.html');
            exit;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answer == $_POST["sport_choice"];
    if (isset($_POST["sport_choice"])) {
        echo "hello";
        $mysql = "INSERT INTO inters_cse442 (q4)VALUES ($answer)";
        if ($_POST["sport_choice"] != NULL) {
            header('Location:question5.html');
            exit;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answer == $_POST["extreme_choice"];
    if (isset($_POST["extreme_choice"])) {
        echo "hello";
        $mysql = "INSERT INTO inters_cse442 (q5)VALUES ($answer)";
        if ($_POST["extreme_choice"] != NULL) {
            header('Location:question6.html');
            exit;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["choice"])) {
        echo "hello";
        $mysql = "INSERT INTO inters_cse442 (q6)VALUES ($answer)";
        if ($_POST["choice"] != NULL) {
            header('Location:question7.html');
            exit;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["food_choice"])) {
        echo "hello";
        $mysql = "INSERT INTO inters_cse442 (q7)VALUES ($answer)";
    }

    if ($_POST["food_choice"] != NULL) {
        header('Location:google.html');
        exit;
    }
}
$conn->close();
?>