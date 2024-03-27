<?php

require "assets/database.php";
require "assets/ziak.php";

$connection = connectionDB();

if($_SERVER["REQUEST_METHOD"] === "POST") {
    deleteStudent($connection, $_GET["id"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Links -->
    <!-- Css links -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <!-- Query links -->
    <link rel="stylesheet" href="./query/header-query.css">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Zmazanie žiaka</title>
</head>
<body>
    <?php require "assets/header.php" ?>

    <h1>Potvrďte zmazanie žiaka</h1>
    <main>
        <section class="delete-form">
            <form method="POST">
                <button>Potvrdiť zmazanie</button>
                <a href="jeden-ziak.php?id=<?=$_GET['id']?>">Zrušiť</a>
            </form>
        </section>
    </main>

    <br>
    <a href="ziaci.php">Späť na zoznam žiakov</a>

    <?php require "assets/footer.php" ?>
    
    <script src="./js/header.js"></script> 
</body>
</html>