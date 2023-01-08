<?php
session_start();
require('../functions.php');
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] !== true){
  die("Dostęp zabroniony!");
}  //sprawdza, czy jest ustawiona sesja
?>

<table>
  <tr>
    <th>ID</th>
    <th>Nazwa</th>
    <th>Akcja</th>
  </tr>
  <?php
  // Łączenie z bazą danych
  $db = mysqli_connect('localhost', 'root', '', 'wypozyczalnia');

  // Zczytywanie listy aut z bazy danych
  $query = "SELECT * FROM samochody";
  $result = mysqli_query($db, $query);

  // Tworzenie tabeli HTML dla listy
  while ($row = mysqli_fetch_array($result)) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['nazwa'] . '</td>';
    echo '<td>';
    echo '<form action="delete_script.php" method="post">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo '<input type="submit" class=delete-button value="Usuń">';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
  }
  ?>
</table>


<style>
table {
  width: 80%;
  margin: 0 auto;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
  color: #444;
}

th {
  background-color: #0074D9;
  color: #fff;
  font-weight: bold;
  padding: 10px;
}

td {
  border: 1px solid #ddd;
  padding: 10px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

.delete-button {
  font-size: 18px;
  padding: 10px 20px;
  background-color: #3498db;
  border: none;
  color: #fff;
  cursor: pointer;
  display: block;
  margin: 0 auto;
}
</style>