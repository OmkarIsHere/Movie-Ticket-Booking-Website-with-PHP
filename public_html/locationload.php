<?php
if (isset($_POST["location"])) {
    if (isset($_SESSION["location"])) {
        session_unset();
        session_destroy();
    }
    $location = $_POST["location"];
    session_start();
    $_SESSION["location"] = $location;
    echo $_SESSION["location"];
}
