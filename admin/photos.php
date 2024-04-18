<?php

require "../classes/Auth.php";

session_start();

// Overenie či je užívateľ prihlásený 
if( !Auth::isLoggedIn() ){  // Ak skončí false (nieje prihlásený), prepneme na true
    die("Nepovolený prístup"); // a vykoná sa die, inak sa pokračuje v programe
}

$user_id = $_SESSION["logged_in_user_id"]; // Uloźenie ID usera zo session po registrácií

?>

