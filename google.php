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




    $sql3 = "SELECT * FROM comments_db";

    $result = mysqli_query($mysqli, $sql3);

    $chat_messages = ""; 

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["Name"];
        $message = $row["message"];
        $chat_messages .= "$id: $message<br>";
    }







    $mysqli->close();



    //
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
    $sql2 = "SELECT * FROM `comments_db` ";
    $result = mysqli_query($conn, $sql2); 
    
    $msg = "";
    while ($row = mysqli_fetch_array($result)) {
        $name =$row["Name"];
        $message = $row["message"];
        $msg = $msg ."<br>" . $name . ": " . $message ;
    }
    $conn->close();
?>



<!DOCTYPE html>
<html>
    <head>
        <style>
        </style>
        <link rel="stylesheet" type="text/css" href="./Mapstyle.css">
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
            <a id = "rate" href="rating.php">
                <button type="submit">&#11088;Rate US!&#11088;</button>
            </a>
            <a id = "loc"><?php echo $loc?></a>
        </div>
        <div id = "container">
            <div id = "map">
            </div>
            <div id="sidebar">
                <h2>Recommendations base on quiz:</h2>
                <p>If no item is listed, choose another category by clicking on 'Return to recommendation page' as there is no location near you.</p>
                <ul id="places"></ul>
            </div>
        </div> 
        <form class = "chat" method="post" >
            <div class="chat-input">
                <p style = "margin-left:25px;font-family:'Times New Roman',Times, serif;font-size:25px;">Share your next locations and talk to others!</p>
                <input type="text" id="chatbox" name="chatbox" placeholder="Type your message...">
                <button onclick="addchat()">Post</button>
                <hr style="height:2px;border-width:0;color:black;background-color:black">
            </div>
            <p><?php echo $msg?></p>
        </form>
        <hr>
        <div class="footer">
            <h2>Intern Limited, 2024 </h2>
            <a href ="https://cloud.google.com/maps-platform/terms/"> Term of Service</a>
            <a href ="https://policies.google.com/privacy"> Privacy Policy</a>
        </div>
        <!-- <script src = "./function.js">-->
        <script>
            (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
                key: "AIzaSyAAHRBLIWS8NJ-XUY3eEU2jZkMcnjF7g2I",
                v: "weekly",
                // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
                        // Add other bootstrap parameters as needed, using camel case.
            });

            let currentmap;
            let rlocation;
            // initMap is now async
            async function initMap() {
                //Location for testing, UB North
                const location = { lat: 43.0018, lng: -78.788173 };
                //const location = { lat: 23, lng: -78.788173 }
                // Request libraries when needed, not in the script tag.
                const { Map } = await google.maps.importLibrary("maps");
                const {Place} = await google.maps.importLibrary("places");
                const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
                
                //Create New Map
                const currentmap = new Map(document.getElementById("map"), {
                    center: { lat: 43.0018, lng: -78.788173 },
                    zoom: 15,
                    mapId: "TeamInternsMap",
                });
                var php_var = "<?php echo $loc; ?>";
                //Create marker on location;
                const request = {
                    //query: 'University At Buffalo',
                    query: php_var,
                    fields: ['name', 'geometry'],
                };
                var service = new google.maps.places.PlacesService(currentmap);

                service.findPlaceFromQuery(request, function (results, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        getl = results[0]
                        //location = results[0].geometry.location
                        marker = new AdvancedMarkerElement({
                            map: currentmap,
                            position:  results[0].geometry.location,
                        });
                        console.log(sessionStorage.getItem("key"))
                        var key = sessionStorage.getItem("key")
                        currentmap.setCenter(results[0].geometry.location);
                        var service = new google.maps.places.PlacesService(currentmap);
                        service.nearbySearch(
                            { location: results[0].geometry.location, radius: 10000, /*type: ["restaurant"]*/ keyword: [key]},
                            (results, status, pagination) => {
                                if (status !== "OK" || !results) return;
                                addPlaces(results, currentmap);
                            },
                        );
                    }
                });
            }

            async function addPlaces(places, map) {
                const placesList = document.getElementById("places");

                for (const place of places) {
                    if (place.geometry && place.geometry.location) {
                        const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
                        marker = new AdvancedMarkerElement({
                            map: map,
                            position: place.geometry.location,
                        });

                        const li = document.createElement("li");

                        li.textContent = place.name;
                        placesList.appendChild(li);
                        li.addEventListener("click", () => {
                            map.setCenter(place.geometry.location);
                            map.setZoom(20)
                        });
                    }
                }
            }
            initMap();
        </script>
        
    </body>
</html>