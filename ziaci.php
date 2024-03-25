<?php 

require "assets/database.php";
require "assets/ziak.php";

$connection = connectionDB();

$students = getAllStudents($connection,"id, first_name, second_name");

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
            <h1>Zoznam žiakov školy</h1>
        </section>

        <section class="students-list">
            <?php if(empty($students)): ?>
                <p>Žiaci sa nenašli.</p>
            <?php else: ?>    
                <ul>
                    <?php foreach($students as $one_student): ?>
                        <li>
                            <?php echo htmlspecialchars($one_student["first_name"]). " " .htmlspecialchars($one_student["second_name"]); ?>
                        </li>
                        <a href="jeden-ziak.php?id=<?= $one_student['id'] ?>">Viac informácií</a>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    </main>

        <a href="jeden-ziak.php">Jeden žiak</a><br>
        <a href="index.php">Späť na úvodnú stranu.</a><br>
        <a href="pridat-ziaka.php">Pridať žiaka</a><br>
    
        <?php require "assets/footer.php" ?>
</body>
</html>