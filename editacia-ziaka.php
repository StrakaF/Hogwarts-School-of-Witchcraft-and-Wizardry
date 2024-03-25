<?php

    //Súbory s funkciami na pripojenie k databáze a  získanie žiaka z DB podla ID 
    require "assets/database.php";
    require "assets/ziak.php";

    //Pripojenie do DB
    $connection = connectionDB();

    //Ak je id poslané pomocou "HTTP GET" a je numerické
    if ( isset($_GET["id"]) and is_numeric($_GET["id"]) ) {
        $one_student = getStudent($connection,$_GET["id"]);

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
        updateStudent($connection, $first_name, $second_name, $age, $life, $college, $id );

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editovanie žiaka</title>
</head>
<body>
    <?php require "assets/header.php"; ?>

    <?php require "assets/formular-ziak.php"; ?>

    <a href="ziaci.php">Zoznam žiakov</a><br>
    <a href="index.php">Uvodna strana </a><br>
    <a href="pridat-ziaka.php">Pridať žiaka</a><br>

    <?php require "assets/footer.php"; ?>

</body>
</html>