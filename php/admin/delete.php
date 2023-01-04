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
  // Connect to the database
  $db = mysqli_connect('localhost', 'root', '', 'wypozyczalnia');

  // Retrieve the list of cars from the database
  $query = "SELECT * FROM samochody";
  $result = mysqli_query($db, $query);

  // Generate the HTML for the table rows
  while ($row = mysqli_fetch_array($result)) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['nazwa'] . '</td>';
    echo '<td>';
    echo '<form action="delete_script.php" method="post">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo '<input type="submit" value="Usuń">';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
  }
  ?>
</table>
