<?php
$keyword = [];
$tableName = "interns_cse442";

$conn = new mysqli("oceanus.cse.buffalo.edu:3306", "shengans", '50404824', "cse442_2024_spring_team_f_db");
if ($mysqli->connect_error) {
die("Connection failed: " .  $mysqli->connect_error);
} else {
}


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if there is any data in the table
$query = "SELECT id FROM $tableName";
$result = $conn->query($query);

if ($result && $result->num_rows == 0) {
    $row = $result->fetch_assoc();
    $totalRows = $row['total_rows'];
    
    if ($totalRows > 0) {
        echo "There is data in the table '$tableName'.";
    } else {
        echo "There is no data in the table '$tableName'.";
        $data = array("yes"=>0, "no"=>0, "food"=>0, "experience"=>0, "shopping"=>0, "study"=>0,
         "european"=>0, "asian"=>0, "middle"=>0, "usa"=>0, "history"=>0, "recreate"=>0, "sport"=>0, "relax"=>0,
         "wear"=>0, "elect"=>0, "grocery"=>0, "necess"=>0, "museum"=>0, "book"=>0, "site"=>0, "nature"=>0,);

        $json_en = json_encode($data);

        $sql = "INSERT INTO $tableName (id, data_percent) VALUES ('1','$json_en')";
        if ($conn->query($sql) === TRUE) {
            echo "Data inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "Error executing query: " . $conn->error;
}

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
    echo "Connected successfully";
}
// question1
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a=($_POST['alcohol_choice']);
    if (isset($_POST["alcohol_choice"])) {
        //echo "hello";
        $current = "SELECT data_percent FROM $tableName";
        $value = $conn->query($current);
        $yes = 0;
        $no = 0;
        $dict = array();
        if ($value->num_rows > 0){
            while($row = $value->fetch_assoc()){
                $dict = json_decode($row["data_percent"],true);
                $yes = $dict["yes"];
                $no = $dict["no"];
            }
        }
        $recommend = [];
        array_push($recommend, $a);
        if ($a == "Yes"){
            //array_push($recommend, "Yes");
            $yes = $yes +1;
        }
        else{
            //array_push($recommend, "No");
            $no = $no + 1;
        }
        $sum = $yes + $no; 
        $dict["yes"]=$yes;
        $dict["no"]=$no;
        $json_en = json_encode($dict);
        #$sql = "UPDATE interns_cse442 SET data_percent = '$json_en' WHERE id='1'";
        $sql = "UPDATE $tableName SET data_percent = '$json_en' WHERE id='1'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    if ($_POST["alcohol_choice"] != NULL) {
        session_start();
        $_SESSION['recommend'] = $recommend;

        header('Location:question2.php');
        exit;
    }
    
  }
}
    // question2
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a=($_POST['purpose_choice']);
    if (isset($_POST["purpose_choice"])) {
        //echo "hello";
        $current = "SELECT data_percent FROM $tableName";
        $value = $conn->query($current);
        $food = 0;
        $experience = 0;
        $shopping = 0;
        $study = 0;
        $dict = array();
        if ($value->num_rows > 0){
            while($row = $value->fetch_assoc()){
                $dict = json_decode($row["data_percent"],true);
                $food = $dict["food"];
                $experience = $dict["experience"];
                $shopping = $dict["shopping"];
                $study = $dict["study"];
            }
            //session_start();
            //$recommend=$_SESSION['recommend'];
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
            $dict["food"]=$food;
            $dict["experience"]= $experience;
            $dict["shopping"] = $shopping;
            $dict["study"] = $study;
            $json_en = json_encode($dict);
            #$sql = "UPDATE interns_cse442 SET data_percent = '$json_en' WHERE id ='1'";
            $sql = "UPDATE $tableName SET data_percent = '$json_en' WHERE id='1'";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
    
    if ($a == "For Food") {
        header('Location:question3.1.php');
        exit;
    }
    elseif($a == "For the experience"){
        header('Location:question3.2.php');
        exit;
    }
    elseif($a == "For Shopping"){
        header('Location:question3.3.php');
        exit;
    }
    elseif($a == "For Academic Purpose"){
        header('Location:question3.4.php');
        exit;
    }
    }

    // question3.1
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["cuisine_choice"])) {
            $a=($_POST['cuisine_choice']);
            echo "hello";
            $current = "SELECT data_percent FROM $tableName";
            $value = $conn->query($current);
            $european = 0;
            $asian = 0;
            $middle = 0;
            $usa = 0;
            $dict = array();
            if ($value->num_rows > 0){
                while($row = $value->fetch_assoc()){
                    $dict = json_decode($row["data_percent"],true);
                    $european = $dict["european"];
                    $asian = $dict["asian"];
                    $middle = $dict["middle"];
                    $usa = $dict["usa"];
                }
            }
            session_start();
            //$recommend = $_SESSION['recommend'];
            array_push($_SESSION['recommend'], $a);
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
            $dict["european"] = $european;
            $dict["asian"] = $asian;
            $dict["middle"] = $middle;
            $dict["usa"] = $usa;
            $json_en = json_encode($dict);
            #$sql = "UPDATE interns_cse442 SET data_percent = '$json_en' WHERE id ='1'";
            $sql = "UPDATE $tableName SET data_percent = '$json_en' WHERE id='1'";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
        if ($_POST["cuisine_choice"] != NULL) {
            //session_start();
            //$recommend=$_SESSION['recommend'];
            header("Location: recommendation.php");
            exit;
        }
    }
    
    // question3.2 "history"=>0, "recreate"=>0, "sport"=>0, "relax"=>0
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a=($_POST['site_choice']);
        if (isset($_POST["site_choice"])) {
            //echo "hello";
            $recommend[] = $a;
            $current = "SELECT data_percent FROM $tableName";
            $value = $conn->query($current);
            $history = 0;
            $recreate = 0;
            $sport = 0;
            $relax = 0;
            $dict = array();
            if ($value->num_rows > 0){
                while($row = $value->fetch_assoc()){
                    $dict = json_decode($row["data_percent"],true);
                    $history = $dict["history"];
                    $recreate = $dict["recreate"];
                    $sport = $dict["sport"];
                    $relax = $dict["relax"];
                }
                session_start();
                array_push($_SESSION['recommend'], $a);
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
                $dict["history"] = $history;
                $dict["recreate"] = $recreate;
                $dict["sport"] = $sport;
                $dict["relax"] = $relax;
                $json_en = json_encode($dict);
                #$sql = "UPDATE interns_cse442 SET data_percent = '$json_en' WHERE id ='1'";
                $sql = "UPDATE $tableName SET data_percent = '$json_en' WHERE id='1'";
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        }
        if ($_POST["site_choice"] != NULL) {
            header("Location: recommendation.php");
            exit;
        }
    }

    // question3.3 "wear"=>0, "elect"=>0, "grocery"=>0, "necess"=>0
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a=($_POST['shopping_choice']);
        if (isset($_POST["shopping_choice"])) {
            //echo "hello";
            $recommend[] = $a;
            $current = "SELECT data_percent FROM $tableName";
            $value = $conn->query($current);
            $wear = 0;
            $elect = 0;
            $grocery = 0;
            $necess = 0;
            $dict = array();
            if ($value->num_rows > 0){
                while($row = $value->fetch_assoc()){
                    $dict = json_decode($row["data_percent"],true);
                    $wear = $dict["wear"];
                    $elect = $dict["elect"];
                    $grocery = $dict["grocery"];
                    $necess = $dict["necess"];
                }
                session_start();
                array_push($_SESSION['recommend'], $a);
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
                $dict["wear"] = $wear;
                $dict["elect"] = $elect;
                $dict["grocery"] = $grocery;
                $dict["necess"] = $necess;
                $json_en = json_encode($dict);
                #$sql = "UPDATE interns_cse442 SET data_percent = '$json_en' WHERE id ='1'";
                $sql = "UPDATE $tableName SET data_percent = '$json_en' WHERE id='1'";
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        }
        if ($_POST["shopping_choice"] != NULL) {
            header("Location: recommendation.php");
            exit;
        }
    }

    // question3.4 "museum"=>0, "book"=>0, "site"=>0, "nature"=>0
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a=($_POST['choice']);
        if (isset($_POST["choice"])) {
            echo "hello";
            $recommend[] = $a;
            $current = "SELECT data_percent FROM $tableName";
            $value = $conn->query($current);
            $museum = 0;
            $book = 0;
            $site = 0;
            $nature = 0;
            $dict = array();
            if ($value->num_rows > 0){
                while($row = $value->fetch_assoc()){
                    $dict = json_decode($row["data_percent"],true);
                    $museum = $dict["museum"];
                    $book = $dict["book"];
                    $site = $dict["site"];
                    $nature = $dict["nature"];
                }
                session_start();
                array_push($_SESSION['recommend'], $a);
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
            
                $dict["museum"] = $museum;
                $dict["book"] = $book;
                $dict["site"] = $site;
                $dict["nature"] = $nature;
                $json_en = json_encode($dict);
                #$sql = "UPDATE interns_cse442 SET data_percent = '$json_en' WHERE id ='1'";
                $sql = "UPDATE $tableName SET data_percent = '$json_en' WHERE id ='1'";
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        }
        if ($_POST["choice"] != NULL) {
            //$list_encoded = urlencode(json_encode($recommend));
            header("Location: recommendation.php");
            exit;
        }
    }
$conn->close();
?>