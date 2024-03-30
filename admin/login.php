<?php

require "../assets/database.php";
require "../assets/url.php";
require "../assets/user.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST" ) {

    $conn = connectionDB();
}