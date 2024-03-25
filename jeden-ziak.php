<?php 

require "assets/database.php"; 
require "assets/ziak.php";

$connection = connectionDB();

if( isset($_GET["id"]) and is_numeric($_GET["id"]) ) {
    $students = getStudent($connection, $_GET["id"]);
} else {
    $students = null;
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

    <?php require "assets/header.php" ?>
    
    <main>
        <section class="main-heading">
            <h1>Informácie o žiakovi</h1>
        </section>

        <section>
            <?php if($students === null): ?>
                <p>Žiak nebol nájdený.</p>
            <?php else: ?>
                <h2> <?= htmlspecialchars($students["first_name"]). " ".htmlspecialchars($students["second_name"]); ?></h2>
                <p>Vek: <?= htmlspecialchars($students["age"]); ?></p>
                <p>Informácie: <?= htmlspecialchars($students["life"]); ?></p>
                <p>Koľaj: <?= htmlspecialchars($students["college"]); ?></p>
            <?php endif; ?>
        </section>

        <section class="buttons">
                <a href="editacia-ziaka.php?id=<?= $students['id'] ?>">Editovať žiaka</a>               
                <a href="delete-ziak.php?id=<?= $students['id'] ?>">Vymazať žiaka</a>               
        </section>
    </main>

    <br>

    <a href="ziaci.php">Zoznam žiakov</a><br>
    <a href="index.php">Uvodna strana </a><br>
    <a href="pridat-ziaka.php">Pridať žiaka</a><br>

    <?php require "assets/footer.php" ?>
</body>
</html>