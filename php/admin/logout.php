<?php
session_start();
$_SESSION = []; //zeruje wszystkie sesje
session_destroy();

header("Location: ../index.php");
?>