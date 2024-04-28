<?php

require "../classes/Database.php";
require "../classes/Auth.php";
require "../classes/Image.php";
require "../classes/Url.php";

session_start();

// Overenie či je user prihlásený
if( !Auth::isLoggedIn() ){  // Ak skončí false (nieje prihlásený), prepneme na true
    die("Nepovolený prístup"); // a vykoná sa die, inak sa pokračuje v programe
}

$db = new Database();
$connection = $db->connectionDB();

$user_id = $_GET["id"];
$image_name = $_GET["image_name"];

$image_path = "../uploads/" . $user_id . "/" . $image_name;

if(Image::deletePhotoFromDirectory($image_path)) {
    // Zmazať obrázok aj z databázy
    Image::deletePhotoFromDatabase($connection, $image_name);
    Url::redirectUrl("/Bradavice-projekt/admin/photos.php");
}
?>