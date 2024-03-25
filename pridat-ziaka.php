<?php

require "assets/database.php";
require "assets/url.php";
require "assets/ziak.php";


$first_name = null;
$second_name = null;
$age = null;
$life = null;
$college = null;

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $first_name = $_POST["first_name"];
    $second_name = $_POST["second_name"];
    $age = $_POST["age"];
    $life = $_POST["life"];
    $college = $_POST["college"];

    $connection = connectionDB();

    createStudent($connection, $first_name, $second_name, $age, $life, $college);
};

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Links -->
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./query/header-query.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    
<?php require "assets/header.php"?>

<main>
    <section class="add-form">
        <?php require "assets/formular-ziak.php"; ?>
    </section>
</main>

<?php require "assets/footer.php"?>

<script src="./js/header.js"></script>
</body>
</html>