
<!DOCTYPE html>
<html>
    <head>
        <style>
        </style>
        <link rel="stylesheet" type="text/css" href="./style.css">
    </head>
    <body>
        <div class="navbar">
            <a href="welcome.php">
                <button type="submit">Return to welcome page</button>
            </a>  
            <a href="local.html">
                <button type="submit">Retake quiz</button>
            </a>
            <a id = "loc">Buffalo, NY</a>
        </div>
        <div id = "container">
            <div id = "map">
            </div>
            <div id="sidebar">
                <h2>Recommendations base on your quiz:</h2>
                <ul id="places"></ul>
            </div>
        </div>
        <script src = "./function.js">
        </script> 
        <div class="footer">
            <h2>Intern Limited, 2024 </h2>
            <a href ="https://cloud.google.com/maps-platform/terms/"> Term of Service</a>
            <a href ="https://policies.google.com/privacy"> Privacy Policy</a>
        </div>

        
    </body>
</html>