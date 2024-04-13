<?php

class Auth {
    
    /**
     * Overuje či je používateľ prihlásený alebo nie
     * 
     * @return boolean - True, pokiaľ je užívateľ prihlásený, inak False
     */

    public static function isLoggedIn() {
        //Vráti true pokiaľ je session nastavené a je true
        return isset($_SESSION["is_logged_in"]) and $_SESSION["is_logged_in"];
    }
}