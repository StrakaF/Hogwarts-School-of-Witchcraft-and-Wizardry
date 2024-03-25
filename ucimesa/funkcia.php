<?php

/**
 * Popis študenta
 * @param string $first_name - krstné meno študenta
 * @param string $second_name - priezvisko študenta
 * @param integer $age - vek študenta
 * 
 * Vypíše popis študenta
 * 
 */

function studentDescription ($first_name, $second_name, $age ) {
    echo "Toto je študent $first_name  $second_name a má $age rokov";
    echo "<br>";
}

studentDescription("Filip", "Straka", 13);
studentDescription("Ema", "Weberová", 23);
