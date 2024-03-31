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
        // Získanie ID uživateľa
        $id = getUserId($conn, $log_email);

        /*Zabraňuje tzv. fixation attack, viac tu:
        https://owasp.org/www-community/attacks/Session_fixation*/
        session_regenerate_id(true);

        //Nastavenie že je užívateľ prihlásený
        $_SESSION["is_logged_in"] = true;
        //Nastavenie ID užívateľa
        $_SESSION["logged_in_user_id"] = $id;

        redirectUrl("/Bradavice-projekt/admin/ziaci.php");

    } else {
        $error = "Chyba pri prihlasení";
    }

   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Ak error nieje prázdny, tak ho vypíš -->
    <?php if(!empty($error)): ?>
        <p><?= $error ?></p>
        <a href="../signin.php">Späť na prihlásenie.</a>
    <?php endif; ?>
</body>
</html>