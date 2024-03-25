<?php

require "url.php";

/**
 * Získa jedného žiaka z DB podla ID
 * 
 * @param object $connection - napojenie do DB
 * @param integer $id - id jedneho konkretneho ziaka
 * 
 * @return mixed asociativne pole, ktore obsahuje informacie
 *               o jednom konkrétnom žiakovi alebo vrati null
 *               ak ziak nebol najdeny
 */

function getStudent($connection, $id, $columns = "*") { //Napojenie do DB, konretne ID
    $sql = "SELECT $columns
            FROM student
            WHERE id = ?"; //Vytvori SQL dotaz, id je "?"

    $stmt = mysqli_prepare($connection, $sql); //Pripravenie pripojenia
    
    if ($stmt === false) { // Ak priprava false
        echo mysqli_error($connection); //Vypis chybu
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id); // Doplnenie "?" konkretnou hodnotou id

        if(mysqli_stmt_execute($stmt)) { //Vykonaj to a ak je vsetko ok
            $result = mysqli_stmt_get_result($stmt); //Vytiahni tie info do $result
            return mysqli_fetch_array($result, MYSQLI_ASSOC); //Vrat to ako asociativne pole
        }
    }
}

/**
 * Updatuje info o žiakovi v DB
 * 
 * @param object $connection - napojenie do DB
 * @param string $first_name - krstne meno ziaka
 * @param string $second_name - priezvisko ziaka
 * @param integer $age - vek ziaka
 * @param string $life - informacie o ziakovi
 * @param string $college - nazov internatu ziaka
 * @param integer $id - ID konkretneho ziaka
 * 
 * @return void 
 */

function updateStudent($connection, $first_name, $second_name, $age, $life, $college, $id ) {

    //SQL príkaz na aktualizáciu údajov v databáze pre konkrétneho študenta
    $sql = "UPDATE student
    SET first_name = ?,
        second_name =?,
        age = ?,
        life = ?,
        college = ?
    WHERE id = ?";

    $statement = mysqli_prepare($connection, $sql);

    //Tu sa vložia hodnoty do prípraveného príkazu namiesto "?"
    if ($statement) {
        mysqli_stmt_bind_param($statement, "ssissi",
        $first_name,$second_name,$age,$life,$college,$id);

        //Spustenie príkazu a následné presmerovanie na konkrétneho žiaka 
        if(mysqli_stmt_execute($statement)) {
          redirectUrl("/www2databaza/jeden-ziak.php?id=$id");
        //Oznámenie o chybe
        } else {
            echo mysqli_error($connection);
        };
    }
}

/**
 * Vymaže študenta z DB na základe daného ID
 * 
 * @param object $connection - prepojenie z DB
 * @param integer $id - id daného žiaka
 * 
 * @return void
 */

function deleteStudent($connection, $id) {
    
    $sql = "DELETE 
            FROM student
            WHERE id = ?";

    $stmt = mysqli_prepare($connection,$sql);

    if($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if(mysqli_stmt_execute($stmt)) {
            redirectUrl("/www2databaza/ziaci.php");
        }
    } else {
        echo mysqli_error($connection);
    }
}

/**
 * Vráti všetkých žiakov z DB
 * 
 * @param object $connection - pripojenie do DB
 * 
 * @return array - pole objektov, kde každý objekt je jeden žiak
 */
function getAllStudents($connection, $columns = "*") {

    $sql = "SELECT $columns

            FROM student";

    $result = mysqli_query($connection,$sql);

    if($result === false) {
        echo mysqli_error($connection);
    } else {
        $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $students;
    }
}

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

        redirectUrl("/www2databaza/jeden-ziak.php?id=$id");
    } else {
        echo mysqli_stmt_error($statement);
    }
}

