<?php
/**
 * Pridá žiaka do DB a presmeruje nás na profil žiaka
 * 
 * @param object $connection - pripojenie do DB
 * @param string $first_name - krstne meno ziaka
 * @param string $second_name - priezvisko ziaka
 * @param integer $age - vek ziaka
 * @param string $life - informacie o ziakovi
 * @param string $college - nazov internatu ziaka
 * 
 * @return void
 */

function createStudent ($connection, $first_name, $second_name, $age, $life, $college ) {
    $sql = "INSERT INTO student (first_name, second_name, age, life, college)
    VALUES (?, ?, ?, ?, ? )";

    

    $statement = mysqli_prepare($connection,$sql);

    if($statement === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($statement, "ssiss", $first_name,
        $second_name, $age, $life, $college);
    }

    if(mysqli_stmt_execute($statement)) {
        $id = mysqli_insert_id($connection);

        redirectUrl("/Bradavice-projekt/admin/jeden-ziak.php?id=$id");
    } else {
        echo mysqli_stmt_error($statement);
    }
}