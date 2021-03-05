<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'contact_application');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
// connect to databese
try {
  $con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}
