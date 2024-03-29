<?php

require "../assets/url.php";
require "../assets/database.php";
require "../assets/user.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $connection = connectionDB();

    $first_name = $_POST["first-name"];
    $second_name = $_POST["second-name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $id = createUser($connection, $first_name, $second_name, $email, $password);

    if(!empty($id)) {
        /*Zabraňuje tzv. fixation attack, viac tu:
        https://owasp.org/www-community/attacks/Session_fixation*/
        session_regenerate_id(true);

        redirectUrl("/Bradavice-projekt/admin/ziaci.php");
    } else {
        echo "Užívateľa sa nepodarilo pridať.";
    }
}
