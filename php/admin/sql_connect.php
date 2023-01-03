<?php

$host = '127.0.0.1';
$user = 'root';
$password = '';
$dbName = 'wypozyczalnia';

$mysqli = new mysqli($host,$user,$password,$dbName);


if($error = $mysqli->connect_errno){
    die("Wystąpił bąd połączenia z bazą nr ".$error); //jeśli jest błąd połączenia z bazą to wyświetla jego numer
}
?>