<?php 

    /**
     * Pripojenie do databázy
     * 
     * @return object - Úspešnosť pripojenia
     * 
     * Úspešné pripojenie do DB alebo error
     */

    function connectionDB() {

        $db_host = "localhost";
        $db_user = "FilipStraka";
        $db_password = "admin123";
        $db_name = "skola";
    
        $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    
        if (mysqli_connect_error()) {
            echo mysqli_connect_error();
            exit;
        } 

        return $connection;
    }

