<?php

if (!empty($_POST)){
    $name = trim($_POST['imie']);
    $surname = trim($_POST['nazwisko']);
    $phone_number = trim($_POST['telefon']);
    $car = $_POST['samochod'];
    $termin = $_POST['data'];
    $days = $_POST['dni'];
    $hours = $_POST['godzin'];
    foreach($_POST as $p) {
        if($p == ''){
        die('Uzupełnij pole!');
    }  
  }

  //zabezpieczenie daty/dni/godzin wstecz i powyżej 14 dni/23 godzin
  $today = date ('Y-m-d');
  $end_date = date('Y-m-d', strtotime($today.'+13 days'));
  if($termin < $today || $termin > $end_date) {
        die('Niepoprawna data!');
  }
  if($days <1 || $days > 13) {
    die('Niepoprawna liczba dni!');
  }
  if($hours <0 || $hours >23) {
    die('Niepoprawny zakres godzin!');
  }

    require('functions.php');
    reserve($name,$surname,$phone_number,$car,$termin,$days,$hours); 

}

?> 