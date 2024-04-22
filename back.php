<?php
// Check if the form is submitted and the button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["back1"])) {
        header("Location: catalogs.html");
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["back2"])) {
        header("Location: question1.php");
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["back3"])) {
        header("Location: question2.php");
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["back3"])) {
        header("Location: question2.php");
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["back3"])) {
        header("Location: question2.php");
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["back3"])) {
        header("Location: question2.php");
        exit();
    }
}
?>