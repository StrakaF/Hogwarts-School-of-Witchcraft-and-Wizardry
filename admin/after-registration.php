<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/User.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $database = new Database();
    $connection = $database->connectionDB();

    $first_name = $_POST["first-name"];
    $second_name = $_POST["second-name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $id = User::createUser($connection, $first_name, $second_name, $email, $password);

    if(!empty($id)) {
        /*Zabraňuje tzv. fixation attack, viac tu:
        https://owasp.org/www-community/attacks/Session_fixation*/
        session_regenerate_id(true);

        //Nastavenie že je užívateľ prihlásený
        $_SESSION["is_logged_in"] = true;
        //Nastavenie ID užívateľa
        $_SESSION["logged_in_user_id"] = $id;

        Url::redirectUrl("/Bradavice-projekt/admin/students.php");

    } else {
        echo "Užívateľa sa nepodarilo pridať.";
    }
} else {
    echo "Nepovolený prístup!";
}


