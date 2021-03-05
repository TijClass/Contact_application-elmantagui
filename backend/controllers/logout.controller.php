<?php
session_start();
session_destroy();
setcookie("id","", time() - (86400 * 30), "/");
header("location: /login");