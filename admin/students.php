<?php 

require "../classes/Database.php";
require "../classes/Student.php";
require "../classes/Auth.php";

session_start();

if( !Auth::isLoggedIn() ) {
    die("Nepovolený prístup");
}

// $connection = connectionDB();
$database = new Database();
$connection = $database->connectionDB();

$students = Student::getAllStudents($connection,"id, first_name, second_name");

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
    <link rel="stylesheet" href="../css/admin-students.css">
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

        <section class="filter">
            <input type="text" class="filter-input">
        </section>

        <section class="students-list">
            <?php if(empty($students)): ?>
                <p>Žiaci sa nenašli.</p>
            <?php else: ?>  
                <div class="all-students">
                    <?php foreach($students as $one_student): ?>
                        <div class="one-student">
                            <h2>
                                <?php echo htmlspecialchars($one_student["first_name"]). " " .htmlspecialchars($one_student["second_name"]); ?>
                            </h2>
                            <a href="one-student.php?id=<?= $one_student['id'] ?>">Viac informácií</a>
                        </div>
                    <?php endforeach; ?>
                </div>  
            <?php endif; ?>
        </section>
    </main>

    <?php require "../assets/footer.php" ?>

    <script src="../js/header.js"></script>
    <script src="../js/filter.js"></script>
</body>
</html>