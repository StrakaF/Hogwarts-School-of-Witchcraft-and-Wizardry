<?php

/**
 * Presmerovanie na zadanú URL adresu
 * 
 * @param string $path - adresa na ktorú sa má presmerovať
 * 
 * @return void
 */

 if (!function_exists('redirectUrl')) {
    function redirectUrl($path) {
        if(isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] != "off" ) {
            $url_protocol = "https";
        } else {
            $url_protocol = "http";
        }

        header("location: $url_protocol://" . $_SERVER["HTTP_HOST"] . $path);
    }
 };

//Sám som sa pokúsil to vyriešiť, skoncil som vid c. 128 na konci