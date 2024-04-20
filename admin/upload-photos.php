<?php

require "../classes/Database.php";
require "../classes/Auth.php";
require "../classes/Url.php";

session_start();

// Overenie či je užívateľ prihlásený 
if( !Auth::isLoggedIn() ){  // Ak skončí false (nieje prihlásený), prepneme na true
    die("Nepovolený prístup"); // a vykoná sa die, inak sa pokračuje v programe
}

$user_id = $_SESSION["logged_in_user_id"]; // Uloźenie ID usera zo session po registrácií

if(isset($_POST["submit"]) and isset($_FILES["image"])) {

    $db = new Database();
    $connection = $db->connectionDB();

    $image_name = $_FILES["image"]["name"];
    $image_size = $_FILES["image"]["size"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $error = $_FILES["image"]["error"];
}

?>