<?php
/*
$servername = "oceanus.cse.buffalo.edu:3306";
$username = "weitianw";
$password = "50430232";
$dbname = "cse442_2024_spring_team_f_db.inters_cse442";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$conn->close();

// Create database
$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

$conn->close();
*/
$keyword = [];
$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "cse442_2024_spring_team_f_db";
$dbname = "my442db";

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
$data = array("yes"=>0, "no"=>0, "food"=>0, "experience"=>0, "shopping"=>0, "study"=>0,
         "european"=>0, "asian"=>0, "middle"=>0, "usa"=>0, "history"=>0, "recreate"=>0, "sport"=>0, "relax"=>0,
        "wear"=>0, "elect"=>0, "grocery"=>0, "necess"=>0, "museum"=>0, "book"=>0, "site"=>0, "nature"=>0);


$json_en = json_encode($data);

$sql = "INSERT INTO mydb (id, data_percent) VALUES ('1','$json_en')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>


