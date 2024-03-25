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
    
    
</body>
</html>