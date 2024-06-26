<?php

require "../classes/Database.php";
require "../classes/Auth.php";
require "../classes/Url.php";
require "../classes/Image.php";

session_start();

// Overenie či je užívateľ prihlásený 
if( !Auth::isLoggedIn() ){  // Ak skončí false (nieje prihlásený), prepneme na true
    die("Nepovolený prístup"); // a vykoná sa die, inak sa pokračuje v programe
}

$user_id = $_SESSION["logged_in_user_id"]; // Uloźenie ID usera zo session po registrácií

if(isset($_POST["submit"]) && isset($_FILES["image"])) { // Overujeme či prišli nejaké dáta skrz formulár

    $db = new Database();
    $connection = $db->connectionDB();

    var_dump($_FILES["image"]);

    $image_name = $_FILES["image"]["name"];
    $image_size = $_FILES["image"]["size"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $error = $_FILES["image"]["error"];

    if($error === 0) {
        if($image_size > 9000000 ){ //9mb
            Url::redirectUrl("/Bradavice-projekt/errors/error-page.php?error_text=Váš súbor je příliš veľký.");
        } else {
            $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_extension_lower_case = strtolower($image_extension);

            $allowed_extensions = ["jpg", "jpeg", "png"];

            if(in_array($image_extension_lower_case, $allowed_extensions)) {
                // Zostavenie unikátneho názvu obrázku
                $new_image_name = uniqid("IMG-", true) . "." . $image_extension;

                if(!file_exists("../uploads/" . $user_id)){ // Ak zložka existuje, nevytvárame ju zas
                    mkdir("../uploads/" . $user_id, 0777, true); // Vytvorenie zložky podľa user ID
                }

                $image_upload_path = "../uploads/" . $user_id . "/" . $new_image_name;
                move_uploaded_file($image_tmp_name, $image_upload_path);

                // Vloženie obrázku do databázy
                if(Image::insertImage($connection, $user_id, $new_image_name)) {
                    Url::redirectUrl("/Bradavice-projekt/admin/photos.php");
                }
                
            } else {
                Url::redirectUrl("/Bradavice-projekt/errors/error-page.php?error_text=Koncovka vašeho súboru nieje povolená.");
            }
        }
            
    } else {
        Url::redirectUrl("/Bradavice-projekt/errors/error-page.php?error_text=Vložit obrázok sa bohužiaľ nepodarilo.");
    }
}
?>