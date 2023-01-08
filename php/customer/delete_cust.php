

<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && isset($_SESSION['id'])) {

$id = $_SESSION['id']; 

// łączenie z bazą danych
$db = mysqli_connect('localhost', 'root', '', 'wypozyczalnia');



//pobieranie id samochodu ktory ma zostac zaktualizowany i zapisanie do zmiennej typu string
$samochod_id = mysqli_query($db, "SELECT samochod_id FROM rezerwacje WHERE id = $id");
$data = mysqli_fetch_assoc($samochod_id);
$string = implode(',', $data);

// aktualizacja dostepnosci auta w bazie danych
$update = mysqli_query($db, "UPDATE samochody SET dostepnosc = 1 WHERE id IN (SELECT samochod_id FROM rezerwacje WHERE samochod_id = $string)");


// usuwanie auta z bazy danych
$query = "DELETE FROM rezerwacje WHERE id=$id";
mysqli_query($db, $query);

// przekierowywanie do strony dashboard
header('location: dashboard_cust.php');
// zamkniecie sesji mysql
$mysqli->close();

}
?>
