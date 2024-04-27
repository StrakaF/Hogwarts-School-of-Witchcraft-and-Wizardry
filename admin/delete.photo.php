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



?>