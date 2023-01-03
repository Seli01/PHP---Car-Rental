<?php
session_start();
require('../functions.php');
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] !== true){
  die("Dostęp zabroniony!");
}  //sprawdza, czy jest ustawiona sesja
?>

<?php
$nazwa = $_POST['nazwa'];
$typ = $_POST['typ'];
$cena = $_POST['cena'];
$zdjecie_url = $_FILES['zdjecie_url'] ['name'];
$dostepnosc = isset($_POST['dostepnosc']) ? 1 : 0;

// łączenie z bazą danych
$conn = mysqli_connect('localhost', 'root', '', 'wypozyczalnia');

// sprawdzenie połączenia
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO samochody (nazwa, typ, cena, zdjecie_url, dostepnosc)
VALUES ('$nazwa', '$typ', '$cena', '$zdjecie_url', '$dostepnosc')";

if (mysqli_query($conn, $sql)) {
  echo "Auto dodane do bazy danych";
} 
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

?>

<div>
<a href="dashboard.php" class="button"> Powrót </a>
</div>







