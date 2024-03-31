<?php 

require "../assets/database.php";
require "../assets/ziak.php";
require "../assets/auth.php";
require "../assets/user.php";

session_start();

if( !isLoggedIn() ) {
    die("Nepovolený prístup");
}

$connection = connectionDB();

$students = getAllStudents($connection,"id, first_name, second_name");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Css links -->
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <!-- Query links -->
    <link rel="stylesheet" href="../query/header-query.css">
    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>

    <?php require "../assets/admin-header.php" ?>

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

    <?php require "../assets/footer.php" ?>

    <script src="../js/header.js"></script>
</body>
</html>