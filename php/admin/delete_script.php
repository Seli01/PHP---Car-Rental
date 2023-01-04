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

  // Przygotowywanie zapytania
  $stmt = mysqli_prepare($db, "DELETE FROM samochody WHERE id = ? AND dostepnosc = '1'");
  // Podpinanie parametrów do zapytania
  mysqli_stmt_bind_param($stmt, "s", $id);
  // Wykonywanie zapytania
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    // Samochód został usunięty z bazy danych
    echo '<p>Samochód został usunięty z bazy</p>';
  } else {
    // Samochód nie jest dostępny więc nie dochodzi do usunięcia
    echo '<p>Nie można usunąć samochodu, ponieważ jest on obecnie wypożyczony.</p>';
  }
}
?>

<a href="../admin/dashboard.php" role="button">OK</a>




