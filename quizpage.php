<?php
$keyword = [];
$servername = "";
$username = "root";
$password = "";
//$dbname = "cse442_2024_spring_team_f_db";
$dbname = "my442db";

#$conn = new mysqli($servername, $username, $password, $dbname);
$conn = new mysqli("oceanus.cse.buffalo.edu:3306", "weitianw", '50430232', "cse442_2024_spring_team_f_db");
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
        $current = "SELECT data_percent FROM interns_cse442";
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
            //yes
            if ($sum == 0 & $yes ==0){
                $per_yes = 'percentage1';
            }
            elseif ($sum != 0 & $yes ==0){
                $per_yes = strval(($yes/$sum)*100 . '%') . "!!!";
            }
            else{
                $per_yes = strval(($yes/$sum)*100 . '%') . "!!!";
            }
            // no
            if ($sum == 0 & $no == 0){
                $per_no = 'percentage2';
            }
            elseif ($sum != 0 &$no ==0){
                $per_no = strval(($no/$sum)*100 . '%') . "...";
            }
            else{
                $per_no = strval(($no/$sum)*100 . '%') . "...";
            }

            //current
            if ($a == "Yes"){
                $yes = $yes +1;
            }
            else{
                $no = $no + 1;
            }
            $sum = $yes + $no; 
            $html_yes = strval(($yes/$sum)*100 . '%') . "!!!";
            $html_no = strval(($no/$sum)*100 . '%') . "...";
            $newhtml = str_replace($per_yes, $html_yes, $html);
            $newhtml = str_replace($per_no, $html_no, $newhtml);
            file_put_contents("question1.html", $newhtml);
            $dict["yes"]=$yes;
            $dict["no"]=$no;
            $json_en = json_encode($dict);
            $sql = "UPDATE interns_cse442 SET data_percent = '$json_en' WHERE id='1'";
            //$html = str_replace('<span id="percentage1">precentage1</span>', '<span id="percentage1">'.$html_yes.'</span>', $html);

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
        $current = "SELECT data_percent FROM interns_cse442";
        $value = $conn->query($current);
        $food = 0;
        $experience = 0;
        $shopping = 0;
        $study = 0;
        $sum = 0;
        $b = "";
        $c = "";
        $d = "";
        $e = "";
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
            $sum = $food + $experience + $shopping + $study;
            //b
            if ($sum == 0 & $food ==0){
                $b = 'percentage1';
            }
            else{
                $b = strval(($food/$sum)*100 . '%') . "!!!";
            }
            // c
            if ($sum == 0 & $experience == 0){
                $c = 'percentage2';
            }
            else{
                $c = strval(($experience/$sum)*100 . '%') . "...";
            }
            //d
            if ($sum == 0 & $shopping == 0){
                $d = 'percentage3';
            }
            else{
                $d = strval(($shopping/$sum)*100 . '%') . "~~~";
            }
            //e
            if ($sum == 0 & $study == 0){
                $e = 'percentage4';
            }
            else{
                $e = strval(($study/$sum)*100 . '%') . "***";
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
            $html_food = strval(($food/$sum)*100 . '%') . "!!!";
            $html_ex = strval(($experience/$sum)*100 . '%') . "...";
            $html_shop = strval(($shopping/$sum)*100 . '%') . "~~~";
            $html_study = strval(($study/$sum)*100 . '%') . "***";
            $dict["food"]=$food;
            $dict["experience"]= $experience;
            $dict["shopping"] = $shopping;
            $dict["study"] = $study;
            $json_en = json_encode($dict);
            $sql = "UPDATE interns_cse442 SET data_percent = '$json_en' WHERE id ='1'";
            $newhtml = str_replace($b, $html_food, $html);
            $newhtml = str_replace($c, $html_ex, $newhtml);
            $newhtml = str_replace($d, $html_shop, $newhtml);
            $newhtml = str_replace($e, $html_study, $newhtml);
            file_put_contents("question2.html", $newhtml);
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
            $current = "SELECT data_percent FROM interns_cse442";
            $value = $conn->query($current);
            $european = 0;
            $asian = 0;
            $middle = 0;
            $usa = 0;
            $sum = 0;
            $b = "";
            $c = "";
            $d = "";
            $e = "";
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
                $sum = $european + $asian + $middle + $usa;
                //b
                if ($sum == 0 & $european ==0){
                    $b = 'percentage1';
                }
                else{
                    $b = strval(($european/$sum)*100 . '%') . "!!!";
                }
                // c
                if ($sum == 0 & $asian == 0){
                    $c = 'percentage2';
                }
                else{
                    $c = strval(($asian/$sum)*100 . '%') . "...";
                }
                //d
                if ($sum == 0 & $middle == 0){
                    $d = 'percentage3';
                }
                else{
                    $d = strval(($middle/$sum)*100 . '%') . "~~~";
                }
                //e
                if ($sum == 0 & $usa == 0){
                    $e = 'percentage4';
                }
                else{
                    $e = strval(($usa/$sum)*100 . '%') . "***";
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
                $html_european = strval(($european/$sum)*100 . '%') . "!!!";
                $html_asian = strval(($asian/$sum)*100 . '%') . "...";
                $html_middle = strval(($middle/$sum)*100 . '%') . "~~~";
                $html_usa = strval(($usa/$sum)*100 . '%') . "***";
                $dict["european"] = $european;
                $dict["asian"] = $asian;
                $dict["middle"] = $middle;
                $dict["usa"] = $usa;
                $json_en = json_encode($dict);
                $sql = "UPDATE interns_cse442 SET data_percent = '$json_en' WHERE id ='1'";
                $newhtml = str_replace($b, $html_european, $html);
                $newhtml = str_replace($c, $html_asian, $newhtml);
                $newhtml = str_replace($d, $html_middle, $newhtml);
                $newhtml = str_replace($e, $html_usa, $newhtml);
                file_put_contents("question3.1.html", $newhtml);
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
            header('Location:recommendation.php');
            exit;
        }
    }
    
    // question3.2 "history"=>0, "recreate"=>0, "sport"=>0, "relax"=>0
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a=($_POST['site_choice']);
        if (isset($_POST["site_choice"])) {
            echo "hello";
            $current = "SELECT data_percent FROM interns_cse442";
            $value = $conn->query($current);
            $history = 0;
            $recreate = 0;
            $sport = 0;
            $relax = 0;
            $sum = 0;
            $b = "";
            $c = "";
            $d = "";
            $e = "";
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
                $sum = $history + $recreate + $sport + $relax;
                //b
                if ($sum == 0 & $history ==0){
                    $b = 'percentage1';
                }
                else{
                    $b = strval(($history/$sum)*100 . '%') . "!!!";
                }
                // c
                if ($sum == 0 & $recreate == 0){
                    $c = 'percentage2';
                }
                else{
                    $c = strval(($recreate/$sum)*100 . '%') . "...";
                }
                //d
                if ($sum == 0 & $sport == 0){
                    $d = 'percentage3';
                }
                else{
                    $d = strval(($sport/$sum)*100 . '%') . "~~~";
                }
                //e
                if ($sum == 0 & $relax == 0){
                    $e = 'percentage4';
                }
                else{
                    $e = strval(($relax/$sum)*100 . '%') . "***";
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
                $html_his = strval(($history/$sum)*100 . '%') . "!!!";
                $html_recre = strval(($recreate/$sum)*100 . '%') . "...";
                $html_sport = strval(($sport/$sum)*100 . '%') . "~~~";
                $html_relax = strval(($relax/$sum)*100 . '%') . "***";
                $dict["history"] = $history;
                $dict["recreate"] = $recreate;
                $dict["sport"] = $sport;
                $dict["relax"] = $relax;
                $json_en = json_encode($dict);
                $sql = "UPDATE interns_cse442 SET data_percent = '$json_en' WHERE id ='1'";
                if ($conn->query($sql) === TRUE) {
                    echo "Data inserted successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $newhtml = str_replace($b, $html_his, $html);
                $newhtml = str_replace($c, $html_rece, $newhtml);
                $newhtml = str_replace($d, $html_sport, $newhtml);
                $newhtml = str_replace($e, $html_relax, $newhtml);
                file_put_contents("question3.2.html", $newhtml);
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
            header('Location:recommendation.php');
            exit;
        }
    }

    // question3.3 "wear"=>0, "elect"=>0, "grocery"=>0, "necess"=>0
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a=($_POST['shopping_choice']);
        if (isset($_POST["shopping_choice"])) {
            echo "hello";
            $current = "SELECT data_percent FROM interns_cse442";
            $value = $conn->query($current);
            $wear = 0;
            $elect = 0;
            $grocery = 0;
            $necess = 0;
            $sum = 0;
            $b = "";
            $c = "";
            $d = "";
            $e = "";
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
                $sum = $wear + $elect + $grocery + $necess;
                //b
                if ($sum == 0 & $wear ==0){
                    $b = 'percentage1';
                }
                else{
                    $b = strval(($wear/$sum)*100 . '%') . "!!!";
                }
                // c
                if ($sum == 0 & $elect == 0){
                    $c = 'percentage2';
                }
                else{
                    $c = strval(($elect/$sum)*100 . '%') . "...";
                }
                //d
                if ($sum == 0 & $grocery == 0){
                    $d = 'percentage3';
                }
                else{
                    $d = strval(($grocery/$sum)*100 . '%') . "~~~";
                }
                //e
                if ($sum == 0 & $necess== 0){
                    $e = 'percentage4';
                }
                else{
                    $e = strval(($necess/$sum)*100 . '%') . "***";
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
                $html_wear = strval(($wear/$sum)*100 . '%') . "!!!";
                $html_elect = strval(($elect/$sum)*100 . '%') . "...";
                $html_gro = strval(($grocery/$sum)*100 . '%') . "~~~";
                $html_necess = strval(($necess/$sum)*100 . '%') . "***";
                $dict["wear"] = $wear;
                $dict["elect"] = $elect;
                $dict["grocery"] = $grocery;
                $dict["necess"] = $necess;
                $json_en = json_encode($dict);
                $sql = "UPDATE interns_cse442 SET data_percent = '$json_en' WHERE id ='1'";
                $newhtml = str_replace($b, $html_wear, $html);
                $newhtml = str_replace($c, $html_elect, $newhtml);
                $newhtml = str_replace($d, $html_gro, $newhtml);
                $newhtml = str_replace($e, $html_necess, $newhtml);
                file_put_contents("question3.3.html", $newhtml);
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
            header('Location:recommendation.php');
            exit;
        }
    }

    // question3.4 "museum"=>0, "book"=>0, "site"=>0, "nature"=>0
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a=($_POST['choice']);
        if (isset($_POST["choice"])) {
            echo "hello";
            $current = "SELECT data_percent FROM interns_cse442";
            $value = $conn->query($current);
            $museum = 0;
            $book = 0;
            $site = 0;
            $nature = 0;
            $sum = 0;
            $b = "";
            $c = "";
            $d = "";
            $e = "";
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
                    $sum = $museum + $book + $site + $nature;
                }
                //b
                if ($sum == 0 & $museum ==0){
                    $b = 'percentage1';
                }
                else{
                    $b = strval(($museum/$sum)*100 . '%') . "!!!";
                }
                // c
                if ($sum == 0 & $book == 0){
                    $c = 'percentage2';
                }
                else{
                    $c = strval(($book/$sum)*100 . '%') . "...";
                }
                //d
                if ($sum == 0 & $site == 0){
                    $d = 'percentage3';
                }
                else{
                    $d = strval(($site/$sum)*100 . '%') . "~~~";
                }
                //e
                if ($sum == 0 & $nature== 0){
                    $e = 'percentage4';
                }
                else{
                    $e = strval(($nature/$sum)*100 . '%') . "***";
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
                $html_museum = strval(($museum/$sum)*100 . '%') . "!!!";
                $html_book = strval(($book/$sum)*100 . '%') . "...";
                $html_site = strval(($site/$sum)*100 . '%') . "~~~";
                $html_nature = strval(($nature/$sum)*100 . '%') . "***";
                $dict["museum"] = $museum;
                $dict["book"] = $book;
                $dict["site"] = $site;
                $dict["nature"] = $nature;
                $json_en = json_encode($dict);
                $sql = "UPDATE interns_cse442 SET data_percent = '$json_en' WHERE id ='1'";
                $newhtml = str_replace($b, $html_museum, $html);
                $newhtml = str_replace($c, $html_book, $newhtml);
                $newhtml = str_replace($d, $html_site, $newhtml);
                $newhtml = str_replace($e, $html_nature, $newhtml);
                file_put_contents("question3.4.html", $newhtml);
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
            header('Location:recommendation.php');
            exit;
        }
    }

$conn->close();
?>