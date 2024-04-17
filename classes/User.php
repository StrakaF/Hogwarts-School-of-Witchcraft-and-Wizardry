<?php

class User {

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

    public static function createUser ($connection, $first_name, $second_name, $email, $password ) {
        
        $sql = "INSERT INTO user (first_name, second_name, email, password )
        VALUES (:first_name, :second_name, :email, :password )";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);

        try {
            if($stmt->execute()) {
                $id = $connection->lastInsertId();
                return $id;
            } else {
                throw new Exception("Vytvorenie usera v databáze nebolo úspešné.");
            }
        } catch (Exception $e) {
            error_log("Chyba pri funkcií createUser \n", 3, "../errors/error.log");
            echo $e->getMessage();
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
    public static function authentication($connection, $log_email, $log_password) {
        $sql = "SELECT password
                FROM user
                WHERE email = :email";

        $stmt = $connection->prepare($sql);

        if($stmt) {
            $stmt->bindValue(":email", $log_email, PDO::PARAM_STR);

            $stmt->execute();

            if($user = $stmt->fetch()){
                // var_dump($user);
                return password_verify($log_password, $user['password']);
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

     public static function getUserId($connection, $email) {
        $sql = "SELECT id 
                FROM user
                WHERE email = :email";

        $stmt = $connection->prepare($sql);

        if ($stmt) {
            $stmt->bindValue(":email", $email, PDO::PARAM_STR);

            if($stmt->execute()) {
                $result = $stmt->fetch();
                $user_id = $result[0];

                return $user_id;
            }
        } else {
            echo mysqli_error($connection);
        }
    }
}