<?php

class Image {

    /**
     * Vkladá záznam o obrázku do databázy.
     *
     * Táto funkcia vkladá záznam o obrázku do tabuľky 'image' v databáze.
     * Príjme ID používateľa a názov obrázku ako parametre, prichystá SQL príkaz,
     * prepojí parametre a vykoná dotaz.
     *
     * @param PDO $conn Objekt pripojenia k databáze.
     * @param int $user_id ID používateľa, ktorému patrí obrázok.
     * @param string $image_name Názov súboru obrázka.
     * @return bool Vráti true, ak sa záznam obrázka úspešne vloží, inak false.
     */

    public static function insertImage($conn, $user_id, $image_name){
        $sql = "INSERT INTO image (user_id, image_name)
                VALUES (:user_id, :image_name)";
        
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":image_name", $image_name, PDO::PARAM_STR);

        if($stmt->execute()) {
            return true;
        }
    }

    public static function getImagesByUserId($conn, $user_id){
        $sql = "SELECT image_name
                FROM image
                WHERE user_id = :user_id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);

        $stmt->execute();

        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $images;
    }

    public static function deletePhotoFromDirectory($path) {
        try {
            // Kontrola existencie súboru
            if(!file_exists($path)){
                throw new Exception("Súbor sa nepodarilo zmazať nakoľko neexistuje.");
            }
            // Zmazanie súboru
            if(unlink($path)){
                return true;
            } else {
                throw new Exception("Pri mazaní súboru došlo k chybe.");
            }
        } catch(Exception $e) {
            echo "Chyba: " . $e->getMessage();
        }
    }

    public static function deletePhotoFromDatabase($conn, $image_name){
        $sql ="DELETE FROM image
               WHERE image_name = :image_name";
        
        $stmt = $conn->prepare($sql);

        try {
            $stmt->bindValue(":image_name", $image_name, PDO::PARAM_STR);

            if(!$stmt->execute()) {
                throw new Exception("Obrázok sa nepodarilo zmazať z databázy.");
            }
        } catch( Exception $e ) {
            echo $e->getMessage();
        }
    }
}