<?php
session_start();
require('../functions.php');
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] !== true){
  die("Dostęp zabroniony!");
}  //sprawdza, czy jest ustawiona sesja
?>


<?php

// Łączenie z bazą danych
$db = mysqli_connect('localhost', 'root', '', 'wypozyczalnia');

// Sprawdzanie czy doszło do wysłania zapytania
if (isset($_POST['id'])) {
  // Zczytywanie ID samochodu do usunięcia
  $id = mysqli_real_escape_string($db, $_POST['id']);

  // Sprawdzanie czy samochód jest dostępny
  $query = "SELECT * FROM samochody WHERE id = '$id' AND dostepnosc = '1'";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    // Samochód jest dostępny więc zostaje usunięty z bazy danych
    $query = "DELETE FROM samochody WHERE id = '$id'";
    mysqli_query($db, $query);
    echo '<p>Samochód został usunięty z bazy</p>';
  } else {
    // Samochód nie jest dostępny więc nie dochodzi do usunięcia
    echo '<p>Nie można usunąć samochodu, ponieważ jest on obecnie wypożyczony.</p>';
  }
}
?>
<a href="../admin/dashboard.php" role="button">OK</a>



