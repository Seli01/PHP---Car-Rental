<?php
  
  // Connect to the database
  $host = "localhost";
  $user = "root";
  $password = "";
  $dbname = "wypozyczalnia";
  $conn = mysqli_connect($host, $user, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Numer zamówienia
  $sql = "SELECT id FROM rezerwacje ORDER BY id DESC LIMIT 1";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $id = $row['id'];
  //Nazwisko zamawiającego
  $sql1 = "SELECT nazwisko FROM klienci NATURAL JOIN rezerwacje ORDER BY id DESC LIMIT 1";
  $result1 = mysqli_query($conn, $sql1);
  $row1 = mysqli_fetch_assoc($result1);
  $osoba = $row1['nazwisko'];
  //Telefon zamawiającego
  $sql2 = "SELECT numer_telefonu FROM klienci NATURAL JOIN rezerwacje ORDER BY id DESC LIMIT 1";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_assoc($result2);
  $telefon = $row2['numer_telefonu'];
  //Wypozyczony kwota
  $sql3 = "SELECT koszt FROM rezerwacje ORDER BY id DESC LIMIT 1";
  $result3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_assoc($result3);
  $kwota = $row3['koszt'];

  $sql4 = "SELECT data_wypozyczenia FROM rezerwacje ORDER BY id DESC LIMIT 1";
  $result4 = mysqli_query($conn, $sql4);
  $row4 = mysqli_fetch_assoc($result4);
  $data = $row4['data_wypozyczenia'];
  // Close the connection
  mysqli_close($conn);
?>



<!DOCTYPE html>
<html>
<head>
    <title>Potwierdzenie Zamówienia</title>
  <style>
    /* Add some style to the rachunek */
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    td, th {
      border: 1px solid #dddddd;
      padding: 8px;
    }
    th {
      text-align: left;
    }
    tr:nth-child(even) {
      background-color: #dddddd;
    }
    .rachunek-header {
      background-color: #dddddd;
    }
    .rachunek-footer {
      text-align: right;
    }
  </style>
</head>
<body>
  <!-- rachunek header -->
  <table>
    <tr class="rachunek-header">
      <th colspan="2">Rachunek</th>
    </tr>
    <tr>
      <td>Nr zamówienia:</td>
      <td><?php echo $id; ?></td>
    </tr>
    <tr>
      <td>Rachunek z dnia:</td>
      <td><?php echo date("Y-m-d"); ?></td>
    </tr>
    <tr>
      <td>Nazwisko zamawiającego:</td>
      <td><?php echo $osoba; ?></td>
    </tr>
    <tr>
      <td>Telefon:</td>
      <td><?php echo $telefon; ?></td>
    </tr>
  </table>
  <!-- rachunek footer -->
  <br>
  <table>
    <tr>
      <td></td>
      <td class="rachunek-footer">Kwota do zapłaty: <?php echo $kwota; ?> zł</td>
      Proszę przyjechać pod odbiór samochodu dnia <?php echo $data; ?>
    </tr>
  </table>

  Jeśli zajdzie potrzeba może Pan/Pani anulować rezerwacje, w tym celu należy użyć nr zamówienia oraz nr telefonu podczas logowawnia
</body>
</html>


