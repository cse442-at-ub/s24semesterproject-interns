<?php
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
// question1
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a=($_POST['alcohol_choice']);
    if (isset($_POST["alcohol_choice"])) {
        //echo "hello";
        $current = "SELECT data_percent FROM mydb";
        $value = $conn->query($current);
        $yes = 0;
        $no = 0;
        $sum = 0;
        $per_yes = "";
        $per_no = "";
        $dict = array();
        $html_yes = "";
        $html_no = "";
        $html = file_get_contents("question1.html");
        if ($value->num_rows > 0){
            while($row = $value->fetch_assoc()){
                $dict = json_decode($row["data_percent"],true);
                $yes = $dict["yes"];
                $no = $dict["no"];
            }
            $sum = $yes + $no;
            if ($a == "Yes"){
                if ($sum == 0){
                    $per_yes = "per1";
                }
                else{
                    $per_yes = strval(($yes/$sum)*100 . '%');
                }
                $yes = $yes +1;
            }
            else{
                if ($sum == 0){
                    $per_no = "per2";
                }
                else{
                    $per_no = strval(($no/$sum)*100 . '%');
                }
                $no = $no + 1;
            }
            $sum = $yes + $no; 
            $html_yes = strval(($yes/$sum)*100 . '%');
            $newhtml = str_replace($per_yes, $html_yes, $html);

            $html_no = strval(($no/$sum)*100 . '%');
            $newhtml = str_replace($per_no, $html_no, $html);
            $dict["yes"]=$yes;
            $dict["no"]=$no;
            $json_en = json_encode($dict);
            $sql = "UPDATE mydb SET data_percent = '$json_en' WHERE id='1'";
            //$html = str_replace('<span id="percentage1">precentage1</span>', '<span id="percentage1">'.$html_yes.'</span>', $html);

            file_put_contents("question1.html", $newhtml);
            /*
            $data = array(
                'percentage1' => $html_yes,
                'percentage2' => $html_no,
            );
            // Output the data as JSON
            echo json_encode($data);
            */

            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
    }
    
    if ($_POST["alcohol_choice"] != NULL) {
        header('Location:question2.html');
        exit;
    }
    
  }
}
    // question2
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a=($_POST['purpose_choice']);
    if (isset($_POST["purpose_choice"])) {
        echo "hello";
        $current = "SELECT data_percent FROM mydb";
        $value = $conn->query($current);
        $food = 0;
        $experience = 0;
        $shopping = 0;
        $study = 0;
        $sum = 0;
        $dict = array();
        $html_food = "";
        $html_ex = "";
        $html_shop = "";
        $html_study = "";
        $html = file_get_contents("question2.html");
        if ($value->num_rows > 0){
            while($row = $value->fetch_assoc()){
                $dict = json_decode($row["data_percent"],true);
                $food = $dict["food"];
                $experience = $dict["experience"];
                $shopping = $dict["shopping"];
                $study = $dict["study"];
            }
            if ($a == "For Food"){
                $food = $food +1;
            }
            elseif($a == "For the experience"){
                $experience = $experience +1;
            }
            elseif($a == "For Shopping"){
                $shopping = $shopping +1;
            }
            else{
                $study = $study + 1;
            }
            $sum = $food + $experience + $shopping + $study;
            $html_food = strval(($food/$sum)*100 . '%');
            $html_ex = strval(($experience/$sum)*100 . '%');
            $html_shop = strval(($shopping/$sum)*100 . '%');
            $html_study = strval(($study/$sum)*100 . '%');
            $dict["food"]=$food;
            $dict["experience"]= $experience;
            $dict["shopping"] = $shopping;
            $dict["study"] = $study;
            $json_en = json_encode($dict);
            $sql = "UPDATE mydb SET data_percent = '$json_en' WHERE id ='1'";
            $html = str_replace('<span id="percentage">{0%}</span>', '<span id="percentage">'.$html_food.'</span>', $html);
            $html =str_replace('<span id="percentage">[0%]</span>', '<span id="percentage">'.$html_ex.'</span>', $html);
            $html =str_replace('<span id="percentage">(0%)</span>', '<span id="percentage">'.$html_shop.'</span>', $html);
            $html =str_replace('<span id="percentage">{{0%}}</span>', '<span id="percentage">'.$html_study.'</span>', $html);
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
        /*
        if ($conn->query($sql) === TRUE) {
            echo "Data inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        */
    if ($a == "For Food") {
        header('Location:question3.1.html');
        exit;
    }
    elseif($a == "For the experience"){
        header('Location:question3.2.html');
        exit;
    }
    elseif($a == "For Shopping"){
        header('Location:question3.3.html');
        exit;
    }
    elseif($a == "For Academic Purpose"){
        header('Location:question3.4.html');
        exit;
    }
    }

    // question3.1
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a=($_POST['cuisine_choice']);
        if (isset($_POST["cuisine_choice"])) {
            echo "hello";
            $current = "SELECT data_percent FROM mydb";
            $value = $conn->query($current);
            $european = 0;
            $asian = 0;
            $middle = 0;
            $usa = 0;
            $sum = 0;
            $dict = array();
            $html_european = "";
            $html_asian = "";
            $html_middle = "";
            $html_usa = "";
            $html = file_get_contents("question3.1.html");
            if ($value->num_rows > 0){
                while($row = $value->fetch_assoc()){
                    $dict = json_decode($row["data_percent"],true);
                    $european = $dict["european"];
                    $asian = $dict["asian"];
                    $middle = $dict["middle"];
                    $usa = $dict["usa"];
                }
                if ($a == "European"){
                    $european = $european +1;
                }
                elseif ($a == "Asian"){
                    $asian = $asian +1;
                }
                elseif ($a == "Middle East"){
                    $middle = $middle +1;
                }
                else{
                    $usa = $usa +1;
                }
                $sum = $european + $asian + $middle + $usa;
                $html_european = strval(($european/$sum)*100 . '%');
                $html_asian = strval(($asian/$sum)*100 . '%');
                $html_middle = strval(($middle/$sum)*100 . '%');
                $html_usa = strval(($usa/$sum)*100 . '%');
                $dict["european"] = $european;
                $dict["asian"] = $asian;
                $dict["middle"] = $middle;
                $dict["usa"] = $usa;
                $json_en = json_encode($dict);
                $sql = "UPDATE mydb SET data_percent = '$json_en' WHERE id ='1'";
                $html = str_replace('<span id="percentage">{0%}</span>', '<span id="percentage">'.$html_european.'</span>', $html);
                $html =str_replace('<span id="percentage">[0%]</span>', '<span id="percentage">'.$html_asian.'</span>', $html);
                $html =str_replace('<span id="percentage">(0%)</span>', '<span id="percentage">'.$html_middle.'</span>', $html);
                $html =str_replace('<span id="percentage">{{0%}}</span>', '<span id="percentage">'.$html_usa.'</span>', $html);
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
            /*
            if ($conn->query($sql) === TRUE) {
                echo "Data inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            */
        }
        if ($_POST["cuisine_choice"] != NULL) {
            header('Location:google.html');
            exit;
        }
    }
    
    // question3.2 "history"=>0, "recreate"=>0, "sport"=>0, "relax"=>0
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a=($_POST['site_choice']);
        if (isset($_POST["site_choice"])) {
            echo "hello";
            $current = "SELECT data_percent FROM mydb";
            $value = $conn->query($current);
            $history = 0;
            $recreate = 0;
            $sport = 0;
            $relax = 0;
            $sum = 0;
            $dict = array();
            $html_his = "";
            $html_recre = "";
            $html_sport = "";
            $html_relax = "";
            $html = file_get_contents("question3.2.html");
            if ($value->num_rows > 0){
                while($row = $value->fetch_assoc()){
                    $dict = json_decode($row["data_percent"],true);
                    $history = $dict["history"];
                    $recreate = $dict["recreate"];
                    $sport = $dict["sport"];
                    $relax = $dict["relax"];
                }
                if ($a == "History"){
                    $history = $history +1;
                }
                elseif ($a == "Recreational"){
                    $recreate = $recreate +1;
                }
                elseif ($a == "Extrme Sport"){
                    $sport = $sport +1;
                }
                else{
                    $relax = $relax +1;
                }
                $sum = $history + $recreate + $sport + $relax;
                $html_his = strval(($history/$sum)*100 . '%');
                $html_recre = strval(($recreate/$sum)*100 . '%');
                $html_sport = strval(($sport/$sum)*100 . '%');
                $html_relax = strval(($relax/$sum)*100 . '%');
                $dict["history"] = $history;
                $dict["recreate"] = $recreate;
                $dict["sport"] = $sport;
                $dict["relax"] = $relax;
                $json_en = json_encode($dict);
                $sql = "UPDATE mydb SET data_percent = '$json_en' WHERE id ='1'";
                if ($conn->query($sql) === TRUE) {
                    echo "Data inserted successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $html = str_replace('<span id="percentage">{0%}</span>', '<span id="percentage">'.$html_his.'</span>', $html);
                $html =str_replace('<span id="percentage">[0%]</span>', '<span id="percentage">'.$html_recre.'</span>', $html);
                $html =str_replace('<span id="percentage">(0%)</span>', '<span id="percentage">'.$html_sport.'</span>', $html);
                $html =str_replace('<span id="percentage">{{0%}}</span>', '<span id="percentage">'.$html_relax.'</span>', $html);
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
            /*
            if ($conn->query($sql) === TRUE) {
                echo "Data inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            */
        }
        if ($_POST["site_choice"] != NULL) {
            header('Location:google.html');
            exit;
        }
    }

    // question3.3 "wear"=>0, "elect"=>0, "grocery"=>0, "necess"=>0
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a=($_POST['shopping_choice']);
        if (isset($_POST["shopping_choice"])) {
            echo "hello";
            $current = "SELECT data_percent FROM mydb";
            $value = $conn->query($current);
            $wear = 0;
            $elect = 0;
            $grocery = 0;
            $necess = 0;
            $sum = 0;
            $dict = array();
            $html_wear = "";
            $html_elect = "";
            $html_gro = "";
            $html_necess = "";
            $html = file_get_contents("question3.3.html");
            if ($value->num_rows > 0){
                while($row = $value->fetch_assoc()){
                    $dict = json_decode($row["data_percent"],true);
                    $wear = $dict["wear"];
                    $elect = $dict["elect"];
                    $grocery = $dict["grocery"];
                    $necess = $dict["necess"];
                }
                if ($a == "Wearable items"){
                    $wear = $wear +1;
                }
                elseif ($a == "Electronics"){
                    $elect = $elect +1;
                }
                elseif ($a == "Grocery"){
                    $grocery = $grocery +1;
                }
                else{
                    $necess = $necsee +1;
                }
                $sum = $wear + $elect + $grocery + $necess;
                $html_wear = strval(($wear/$sum)*100 . '%');
                $html_elect = strval(($elect/$sum)*100 . '%');
                $html_gro = strval(($grocery/$sum)*100 . '%');
                $html_necess = strval(($necess/$sum)*100 . '%');
                $dict["wear"] = $wear;
                $dict["elect"] = $elect;
                $dict["grocery"] = $grocery;
                $dict["necess"] = $necess;
                $json_en = json_encode($dict);
                $sql = "UPDATE mydb SET data_percent = '$json_en' WHERE id ='1'";
                $html = str_replace('<span id="percentage">{0%}</span>', '<span id="percentage">'.$html_wear.'</span>', $html);
                $html =str_replace('<span id="percentage">[0%]</span>', '<span id="percentage">'.$html_elect.'</span>', $html);
                $html =str_replace('<span id="percentage">(0%)</span>', '<span id="percentage">'.$html_gro.'</span>', $html);
                $html =str_replace('<span id="percentage">{{0%}}</span>', '<span id="percentage">'.$html_necess.'</span>', $html);
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
            /*
            if ($conn->query($sql) === TRUE) {
                echo "Data inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            */
        }
        if ($_POST["shopping_choice"] != NULL) {
            header('Location:google.html');
            exit;
        }
    }

    // question3.4 "museum"=>0, "book"=>0, "site"=>0, "nature"=>0
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a=($_POST['choice']);
        if (isset($_POST["choice"])) {
            echo "hello";
            $current = "SELECT data_percent FROM mydb";
            $value = $conn->query($current);
            $museum = 0;
            $book = 0;
            $site = 0;
            $nature = 0;
            $sum = 0;
            $dict = array();
            $html_museum = "";
            $html_book = "";
            $html_site = "";
            $html_nature = "";
            $html = file_get_contents("question3.4.html");
            if ($value->num_rows > 0){
                while($row = $value->fetch_assoc()){
                    $dict = json_decode($row["data_percent"],true);
                    $museum = $dict["museum"];
                    $book = $dict["book"];
                    $site = $dict["site"];
                    $nature = $dict["nature"];
                }
                if ($a == "Visit Museums to learn about history"){
                    $museum = $museum +1;
                }
                elseif ($a == "Visit Religious insitute to learn religion history"){
                    $book = $book +1;
                }
                elseif ($a == "Visit historical sites to live the moment"){
                    $site = $site +1;
                }
                else{
                    $nature = $nature +1;
                }
                $sum = $museum + $book + $site + $nature;
                $html_museum = strval(($museum/$sum)*100 . '%');
                $html_book = strval(($book/$sum)*100 . '%');
                $html_site = strval(($site/$sum)*100 . '%');
                $html_nature = strval(($nature/$sum)*100 . '%');
                $dict["museum"] = $museum;
                $dict["book"] = $book;
                $dict["site"] = $site;
                $dict["nature"] = $nature;
                $json_en = json_encode($dict);
                $sql = "UPDATE mydb SET data_percent = '$json_en' WHERE id ='1'";
                $html = str_replace('<span id="percentage">{0%}</span>', '<span id="percentage">'.$html_museum.'</span>', $html);
                $html =str_replace('<span id="percentage">[0%]</span>', '<span id="percentage">'.$html_book.'</span>', $html);
                $html =str_replace('<span id="percentage">(0%)</span>', '<span id="percentage">'.$html_site.'</span>', $html);
                $html =str_replace('<span id="percentage">{{0%}}</span>', '<span id="percentage">'.$html_nature.'</span>', $html);
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
            /*
            if ($conn->query($sql) === TRUE) {
                echo "Data inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            */
        }
        if ($_POST["choice"] != NULL) {
            header('Location:google.html');
            exit;
        }
    }

$conn->close();
?>