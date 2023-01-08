
<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  // Uzytkownik jest zalogowany, przenies do panelu
  header('location: dashboard_cust.php');
} else {
  // Uzytkownik nie jest zalogowany
  $id = $_POST['id'];
  $numer = $_POST['numer'];

  $db = mysqli_connect('localhost', 'root', '', 'wypozyczalnia');

  // Sprawdzanie czy istnieje klient ktory posiada taki samo id zamowienia i numer telefonu
  $query = "SELECT * FROM klienci WHERE id='$id' AND numer_telefonu='$numer'";
  $result = mysqli_query($db, $query);

  if (mysqli_num_rows($result) == 1) {
    // Jesli tak, zaloguj uzytkownika i przenies do panelu
    $_SESSION['logged_in'] = true;
    $_SESSION['id'] = $id; 
    header('location: dashboard_cust.php');
  } else {
    // Jesli dane sie nie zgadzaja wyrzuc error 
    echo "Wprowadzony numer zamowienia badz telefonu jest nieprawidlowy";
  }
}
