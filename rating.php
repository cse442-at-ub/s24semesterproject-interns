<?php
     $mysqli = new mysqli("oceanus.cse.buffalo.edu:3306", "shengans", '50404824', "cse442_2024_spring_team_f_db");
     if ($mysqli->connect_error) {
         die("Connection failed: " . $mysqli->connect_error);
     } else {
     }

    //$sql = "SELECT id, destined_location, user_city FROM user_data";

    $sql2 = "SELECT * FROM user_data";
    $result = mysqli_query($mysqli, $sql2); 
    
    $row = mysqli_fetch_array($result);
    while($row = mysqli_fetch_assoc($result)) {
        $id =$row["id"];
        $state = $row["destined_location"];
        $city = $row["user_city"];
    }
    $loc = $city . ", " . $state;
    $mysqli->close();

?>
<?php
    $conn =  new mysqli("oceanus.cse.buffalo.edu:3306", "shengans", '50404824', "cse442_2024_spring_team_f_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['chatbox'])) {
            $message = $_POST['chatbox'];
            $name = "Guest"; 
            $sql_insert_message = "INSERT INTO comments_db (Name, message) VALUES ('$name', '$message')";
            if ($conn->query($sql_insert_message) === TRUE) {
                
            } else {
                echo "Error adding message: " . $conn->error . "<br>";
            }
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
        </style>
        <link rel="stylesheet" type="text/css" href="./rating.css">
    </head>
    <body>
        <div class="navbar">
            <a href="welcome.php">
                <button type="submit">Return to welcome page</button>
            </a>  
            <a href="local.html">
                <button type="submit">Retake quiz</button>
            </a>
            <a href="recommendation.php">
                <button type="submit">Return to recommendation page</button>
            </a>
            <a href="google.php">
                <button type="submit">Return to map page</button>
            </a>
            <a id = "loc"><?php echo $loc?></a>
        </div>
        <div id = "container">
        </div> 
        <div class="chat">
            <div id="chat-messages">   
            </div>
            <div class="chat-input">
                <input type="text" id="chatbox" placeholder="Type your Suggestion...">
                &#11088;Rating:<input type = "number" placeholder="5" min="1" max="5">
                <button onclick="addchat()">Post</button>
                <hr style="height:2px;border-width:0;color:black;background-color:black">
            </div>
        </div>
        <hr>
        <div class="footer">
            <h2>Intern Limited, 2024 </h2>
            <a href ="https://cloud.google.com/maps-platform/terms/"> Term of Service</a>
            <a href ="https://policies.google.com/privacy"> Privacy Policy</a>
        </div>
        <!-- <script src = "./function.js">-->
        
    </body>
</html>