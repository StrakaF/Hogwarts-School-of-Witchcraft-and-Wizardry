<?php
/**
 * Pridá užívateľa do DB
 * 
 * @param object $connection - pripojenie do DB
 * @param string $first_name - krstné meno uživateľa
 * @param string $second_name - priezvisko uživateľa
 * @param string $email - email uživateľa
 * @param string $password - heslo uživateľa
 * 
 * @return integer $id - id uživateľa
 */

function createUser ($connection, $first_name, $second_name, $email, $password ) {
    
    $sql = "INSERT INTO user (first_name, second_name, email, password )
    VALUES (?, ?, ?, ? )";

    $statement = mysqli_prepare($connection,$sql);

    if($statement === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($statement, "ssss", $first_name,
        $second_name, $email, $password);

        mysqli_stmt_execute($statement);

        $id = mysqli_insert_id($connection);

        return $id;
    }
}   

   