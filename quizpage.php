<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["choice"])) {
        echo "hello";
        if ($_POST["choice"] != NULL) {
            header('Location:map.html');
            exit;
        }
    }
}
?>