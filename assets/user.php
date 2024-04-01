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

/**
 * Overenie užívateľa pomocou emailu a hesla
 * 
 * @param object $connection - pripojenie do DB
 * @param string $log_email - email z formulára pre prihlásenie
 * @param string $log_password - heslo z formulára pre prihlásenie
 * 
 * @return boolean true - pokiaľ je prihlásenie úspešné, false ak nie
 * 
 */
function authentication($connection, $log_email, $log_password) {
    $sql = "SELECT password
            FROM user
            WHERE email = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $log_email);

        // Postup vyťahovania hesla
        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt); // Zo stmt vyberieme výsledok a ukladáme do result
            // Vyťahujeme z objektu result, num_rows
            if($result->num_rows !=0) {
                $password_database = mysqli_fetch_row($result); // Tu je v premennej pole
                $user_password_database = $password_database[0]; // Tu z neho vyberáme nultý prvok

                // Ak tu niečo je, tak je to true
                if($user_password_database) {
                    return password_verify($log_password, $user_password_database); // Porovnáva zadané a reálne heslo užívateľa
                }
            } else {
                echo "Chyba pri zadávaní emailu.";
            }
            

            
        }

    } else { 
        echo mysqli_error($connection);
    }
}

/**
 * Získanie ID užívateľa
 * 
 * @param object $connection - pripojenie do DB
 * @param string $email - email užívateľa
 * 
 * @return int - ID uźivateľa
 */

function getUserId($connection, $email) {
    $sql = "SELECT id 
            FROM user
            WHERE email = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);

        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $id_database = mysqli_fetch_row($result); // Array
            $user_id = $id_database[0];

            return $user_id;
        }
    } else {
        echo mysqli_error($connection);
    }


}
   