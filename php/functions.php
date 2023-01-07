<?php
    require('admin/sql_connect.php'); //dodanie pliku łączącego z db

    function get_cars($type){
        //oznaczenie funkcji łączenia z db jako globalnej, aby móc z niej korzystać

    global $mysqli;

    switch($type){
    case 'dostepne':
    $sql = "SELECT id,nazwa,typ,zdjecie_url,cena,dostepnosc FROM samochody WHERE dostepnosc = 1";
    break;
    case 'niedostepne':
    $sql = "SELECT samochody.id,samochody.nazwa,samochody.zdjecie_url,samochody.typ,samochody.cena,rezerwacje.data_zwrotu FROM samochody INNER JOIN rezerwacje ON samochody.id = rezerwacje.samochod_id WHERE samochody.dostepnosc = 0";
    break;
    case 'select':
    $sql = "SELECT id,nazwa FROM samochody WHERE dostepnosc = 1"; //pobiera do formularza tylko dostepne samochody
    break;
    }

     $result = $mysqli->query($sql);

     $rows = $result->fetch_all(MYSQLI_ASSOC);//zwraca wszystko w postaci tablicy asocjacyjnej

     return $rows;

    }

    function generate_dashboard() {
        global $mysqli;
        $sql = "SELECT rezerwacje.id, samochody.nazwa, klienci.nazwisko, rezerwacje.koszt, rezerwacje.data_zwrotu FROM rezerwacje INNER JOIN samochody ON rezerwacje.samochod_id = samochody.id INNER JOIN klienci ON klienci.id = rezerwacje.klient_id";


    $result = $mysqli->query($sql);
    
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    
    return $rows;
}

function reserve($name, $surname, $phone_number, $car_id, $termin, $days, $hours){
    global $mysqli;




$from_date = $termin;

$to_date = date('Y-m-d H:i',strtotime($from_date.'+ '.$days.' days + '.$hours.' hours'));


//wyciągnięcie ceny z db
$sql = "SELECT cena FROM samochody WHERE id =$car_id";

$result = $mysqli->query($sql);
$row = $result->fetch_row();

$price = $row[0]; 
//obliczenie kosztu 
$cost = ($days * 24 + $hours) * $price; 


//wstawienie nowego klienta oraz nowej rezerwacji do db
$sql_2 = "INSERT INTO klienci(`imie`, `nazwisko`, `numer_telefonu`) VALUES (?,?,?)";

if($statement = $mysqli->prepare($sql_2)){
    if($statement->bind_param('sss',$name, $surname, $phone_number)){
        $statement->execute();
        $client_id = $mysqli->insert_id;
        $sql_3 = "INSERT INTO rezerwacje (`klient_id`,`samochod_id`,`data_wypozyczenia`,`data_zwrotu`,`koszt`) VALUES (?,?,?,?,?)";
        
        if($statement_2 = $mysqli->prepare($sql_3)){
            if($statement_2->bind_param('iissi',$client_id,$car_id,$from_date,$to_date,$cost)){
                $statement_2->execute();
                $mysqli->query("UPDATE samochody SET dostepnosc = 0 WHERE id = $car_id" );
                header("Location: index.php");
            }
        }
    } else {
        die ('Niepoprawne zapytanie!');
    }
}

}

?>
