<?php

require "../assets/database.php";
require "../assets/url.php";
require "../assets/user.php";

session_start();

// Kontrola, či bola požiadavka odoslaná metódou POST
if($_SERVER["REQUEST_METHOD"] === "POST" ) {
    // Kód ktorý sa vykoná len v prípade, že bola odoslaná požiadavka POST

    // Pripojenie do DB
    $conn = connectionDB();
    // Vytiahnutie dát z signin formulára
    $log_email = $_POST["login-email"];
    $log_password = $_POST["login-password"];

    if(authentication($conn, $log_email, $log_password)) {
        // Úspešné prihlásenie
    } else {
        // Neúspešné prihlásenie
    }

   
}