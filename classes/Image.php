<?php

class Image {

    public static function insertImage($conn, $user_id, $image_name){
        $sql = "INSERT INTO image (user_id, image_name)
                VALUES (:user_id, :image_name)";
        
        $stmt = $conn->prepare($sql);
    }
}