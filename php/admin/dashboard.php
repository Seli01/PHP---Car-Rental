<?php
session_start();
require('../functions.php');
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] !== true){
  die("Dostęp zabroniony!");
}  //sprawdza, czy jest ustawiona sesja
?>
<!doctype html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <div class="col-12">
        <h1 class="text-center font-weight-bold p-5">REZERWACJE</h1>
        <div class="text-center">
            <a href="../index.php" class="m-2">POWRÓT</a> | <a href="../admin/add.html"class="m-2">DODAJ AUTO</a> | <a href="../admin/delete.php"class="m-2">USUN AUTO</a>  |  <a href="logout.php" class="m-2">WYLOGUJ</a>
        </div>
       
    </div>

    <div class="container mt-4">
        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Samochód</th>
                    <th scope="col">Wypożyczający</th>
                    <th scope="col">Koszt</th>
                    <th scope="col">Termin zwrotu</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">

                  <?php

                    $rows = generate_dashboard(); 
                    //count - zwraca liczbę komórek danej tablicy
                    for($i=0;$i<count($rows);$i++){ 
                      echo '<tr>';
                      echo '<th scope="row">'.($i+1).'</th>';
                      echo '<td>'.$rows[$i]['nazwa'].'</td>';
                      echo '<td>'.$rows[$i]['nazwisko'].'</td>';
                      echo '<td>'.$rows[$i]['koszt'].'</td>';
                      echo '<td>'.$rows[$i]['data_zwrotu'].'</td>';
                      echo '</tr>';
                    } 

                  ?>
                     

                </tbody>
              </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>
