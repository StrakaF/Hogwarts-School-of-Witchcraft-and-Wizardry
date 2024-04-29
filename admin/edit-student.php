<?php

    require "../classes/Database.php";
    require "../classes/Url.php";
    require "../classes/Student.php";
    require "../classes/Auth.php";

    session_start();

    if( !Auth::isLoggedIn() ) {
        die("Nepovolený prístup");
    }

    //Pripojenie do DB
    // $connection = connectionDB();
    $database = new Database();
    $connection = $database->connectionDB();

    //Ak je id poslané pomocou "HTTP GET" a je numerické
    if ( isset($_GET["id"]) and is_numeric($_GET["id"]) ) {
        $one_student = Student::getStudent($connection,$_GET["id"]);

        //Načíta informácie o študentovi z databázy na základe tohto id
        if ($one_student) {
            $first_name = $one_student["first_name"];
            $second_name = $one_student["second_name"];
            $age = $one_student["age"];
            $life = $one_student["life"];
            $college = $one_student["college"];
            $id = $one_student["id"];
        } else {
            die("Študent nebol nájdený."); //Nesprávne ID
        }
       
    } else {
        die("ID nieje zadané, študent nebol nájdený."); //Žiadne ID
    };

    //Ak bola požiadavka odoslaná pomocou "HTTP POST" metódy (zvyčanie formulár)
    if($_SERVER["REQUEST_METHOD"] == "POST" ) {

        //Odoslané údaje ukladáme do premenných
        $first_name = $_POST["first_name"];
        $second_name = $_POST["second_name"];
        $age = $_POST["age"];
        $life = $_POST["life"];
        $college = $_POST["college"];

        //Funkcia ktorá updatuje info o žiakovi v DB
        if(Student::updateStudent($connection, $first_name, $second_name, $age, $life, $college, $id )) {
            Url::redirectUrl("/Bradavice-projekt/admin/one-student.php?id=$id");
        }

    }
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
    <title>Editovanie žiaka</title>
</head>
<body>
    <?php require "../assets/admin-header.php" ?>

    <?php require "../assets/student-form.php"; ?>

    <?php require "../assets/footer.php"; ?>

    <script src="../js/header.js"></script>
</body>
</html>