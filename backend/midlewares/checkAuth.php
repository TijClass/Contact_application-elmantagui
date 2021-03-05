<?php
session_start();
// echo "cookie : ";
// print_r($_COOKIE);
// echo "<br>";
// echo "session : ";
// print_r($_SESSION);
// echo "<br>";
// die();
if(!(isset($_COOKIE["id"]) || isset($_SESSION["id"]))){
    header("location: /login");
}