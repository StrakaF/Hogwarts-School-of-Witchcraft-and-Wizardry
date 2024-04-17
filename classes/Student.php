<?php

class Student {

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

    public static function getStudent($connection, $id, $columns = "*") { 
        $sql = "SELECT $columns
                FROM student
                WHERE id = :id"; //Vytvorí SQL dotaz"

        $stmt = $connection->prepare($sql); //Pripravenie pripojenia
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT); // Priradí reálnu hodnotu $id ku parametru ":id" a definuje, že ide o celé číslo (PARAM_INT), ktoré používa PDO.

        try {
            if ($stmt->execute()) { //Vykonaj statement, a ak je všetko OK
                return $stmt->fetch(); // Vráti jeden riadok dát z výsledku dotazu
            } else {
                throw new Exception("Získanie dát o jednom študentovi nebolo úspešné.");
            }
        } catch (Exception $e) {
            error_log("Chyba pri funkcií getStudent, získanie dát zlyhalo.", 3, "../errors/error.log");
            echo $e->getMessage();
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
     * @return boolean true, ak je updatovanie žiaka úspešné
     */

     public static function updateStudent($connection, $first_name, $second_name, $age, $life, $college, $id ) {

        //SQL príkaz na aktualizáciu údajov v databáze pre konkrétneho študenta
        $sql = "UPDATE student
        SET first_name = :first_name,
            second_name = :second_name,
            age = :age,
            life = :life,
            college = :college
        WHERE id = :id";

        $stmt = $connection->prepare($sql);

        //Tu sa vložia hodnoty do prípraveného príkazu namiesto "?"
        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":age", $age, PDO::PARAM_INT);
        $stmt->bindValue(":life", $life, PDO::PARAM_STR);
        $stmt->bindValue(":college", $college, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        //Spustenie príkazu a bool true ak je spustený 
        try {
            if($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Update študenta nebol vykonaný.");
            }
        } catch (Exception $e) {
            error_log("Chyba pri funkcií updateStudent, update nebol vykonaný.", 3, "../errors/error.log");
            echo $e->getMessage();
        }
        
 
    }

    /**
     * Vymaže študenta z DB na základe daného ID
     * 
     * @param object $connection - prepojenie z DB
     * @param integer $id - id daného žiaka
     * 
     * @return boolean true - ak dojde ku úspešnému vymazaniu žiaka
     */

     public static function deleteStudent($connection, $id) {
        
        $sql = "DELETE 
                FROM student
                WHERE id = :id";

        $stmt = $connection->prepare($sql);

        if($stmt) {
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            if($stmt->execute()) {
                return true;
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
    public static function getAllStudents($connection, $columns = "*") {

        $sql = "SELECT $columns
                FROM student";

        $stmt = $connection->prepare($sql);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
     * @return integer $id - id pridaného žiaka
     */

     public static function createStudent ($connection, $first_name, $second_name, $age, $life, $college ) {
        $sql = "INSERT INTO student (first_name, second_name, age, life, college)
        VALUES (:first_name, :second_name, :age, :life, :college )";

        $stmt = $connection->prepare($sql);

        if($stmt === false) {
            echo mysqli_error($connection);
        } else {
            $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
            $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
            $stmt->bindValue(":age", $age, PDO::PARAM_INT);
            $stmt->bindValue(":life", $life, PDO::PARAM_STR);
            $stmt->bindValue(":college", $college, PDO::PARAM_STR);
        }

        if($stmt->execute()) {
            $id = $connection->lastInsertId(); // Vrátenie ID posledného pridaného žiaka do DB
            return $id;
        } 
    }
}