<title>Status Zamówienia</title>
<button onclick = "location.href='../admin/logout.php'" class=logout-button >WYLOGUJ</button>
<div class="header">Witaj w panelu zamówienia</div>


<table style = "table">
  <tr>
    <th>ID Zamówienia</th>
    <th>Samochod</th>
    <th>Data Wypozyczenia</th>
    <th>Data Zwrotu</th>
    <th>Koszt (Zł)</th>
    <th>Anulowanie</th>
  </tr>


  <?php
  //Przekazanie globalnej zmiennej id 
  session_start();
   if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && isset($_SESSION['id'])) {
   $id = $_SESSION['id'];  
   
   $db = mysqli_connect('localhost', 'root', '', 'wypozyczalnia');
  // Zbieranie informacji z bazy danych 
  $query = "SELECT r.*, s.nazwa FROM rezerwacje AS r JOIN samochody AS s ON r.samochod_id = s.id WHERE r.id = $id";
  $result = mysqli_query($db, $query);
    // Wyswietlenie zapytania w tabeli
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nazwa'] . "</td>";
        echo "<td>" . $row['data_wypozyczenia'] . "</td>";
        echo "<td>" . $row['data_zwrotu'] . "</td>";
        echo "<td>" . $row['koszt'] . "</td>";
        echo "<td>
                <form action='delete_cust.php'  method='POST'>
                  <input type='hidden' name='id' value='" . $row['id'] . "'>
                  <input type='submit' class='delete-button' value='Anuluj'>
                </form>
              </td>";
        echo "</tr>";
      }
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
    background-color: #3498db;
    color: #fff;
    font-weight: bold;
  }
  
  td, th {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
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

  .logout-button {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 18px;
  padding: 10px 20px;
  background-color: #e74c3c;
  border: none;
  color: #fff;
  cursor: pointer;
  text-decoration: none;

}


.header {
  font-size: 32px;
  font-weight: bold;
  text-align: center;
  margin-bottom: 50px;
  color: #fff;
  background-color: #3498db;
  padding: 20px;
}




  </style>