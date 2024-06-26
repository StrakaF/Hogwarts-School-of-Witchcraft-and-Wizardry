<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/Student.php";
require "../classes/Auth.php";

session_start();

if( !Auth::isLoggedIn() ) {
    die("Nepovolený prístup");
}

$role = $_SESSION["role"];

$database = new Database();
$connection = $database->connectionDB();

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(Student::deleteStudent($connection, $_GET["id"])) {
        Url::redirectUrl("/Bradavice-projekt/admin/students.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Links -->
    <!-- Css links -->
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/admin-delete-student.css">
    <!-- Query links -->
    <link rel="stylesheet" href="../query/header-query.css">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Zmazanie žiaka</title>
</head>
<body>
    <?php require "../assets/admin-header.php" ?>

    
    <main>
        <?php if($role === "admin" ): ?>
            
            <section class="delete-form">
            <h1>Naozaj chcete vymazať žiaka?</h1>
                <form method="POST">
                    <button >Potvrdiť zmazanie</button>
                    <a href="one-student.php?id=<?=$_GET['id']?>">Zrušiť</a>
                </form>
            </section>
        <?php else: ?>
            <section>
                <h1>Obsah tejto stránky je k dispozícií iba administrátorom.</h1>
            </section>
        <?php endif; ?>   
    </main>
    
    <?php require "../assets/footer.php" ?>
    
    <script src="../js/header.js"></script> 
</body>
</html>