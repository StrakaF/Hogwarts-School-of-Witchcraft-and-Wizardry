<?php

class Url {
    
/**
 * Presmerovanie na zadanú URL adresu
 * 
 * @param string $path - adresa na ktorú sa má presmerovať
 * 
 * @return void
 */

    public static function redirectUrl($path) {
        if(isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] != "off" ) {
            $url_protocol = "https";
        } else {
            $url_protocol = "http";
        }

        header("location: $url_protocol://" . $_SERVER["HTTP_HOST"] . $path);
    }
}   

