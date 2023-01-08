<?php
require('functions.php');
?>
<!doctype html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WypozyczalniaAut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <!--header-->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item p-2">
                            <a class="nav-link" href="#">STRONA GŁÓWNA</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link" onclick="smoothScroll('#dostepne')">DOSTĘPNE SAMOCHODY</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link" onclick="smoothScroll('#niedostepne')">ZAREZERWOWANE SAMOCHODY</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link" onclick="smoothScroll('#rezerwacja')">ZAREZERWUJ</a>
                        </li>
                        <li class="nav-item p-2">
                            <a href = "../php/customer/login.html" class="nav-link" >SPRAWDŹ ZAMÓWIENIE</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container h-75 d-flex align-items-center">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-white font-weight-bold">WYPOŻYCZANIA SAMOCHODÓW</h1>
                </div>
                <div class="col-12">
                    <div class="row mt-5 d-flex">
                        <button class="col-lg-3 col-md-6 col-sm-12 m-3 font-weight-bold" onclick="smoothScroll('#dostepne')">NASZA OFERTA</button>
                        <button class="col-lg-3 col-md-6 col-sm-12 m-3 font-weight-bold" onclick="smoothScroll('#rezerwacja')">ZAREZERWUJ</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--header-->
    <!--dostępne-->
    <section id="dostepne"></section>
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center p-5">DOSTĘPNE SAMOCHODY</h1>
            </div>
        </div>
        <div class="row">

            <?php
            $rows = get_cars('dostepne');
            foreach($rows as $r) {
                echo '<div class=col-lg-4 col-md-6 col-sm-12 mt-3>';
                echo '<div class="card">';
                echo '<img src="assets/'.$r['zdjecie_url'].' "class="card-img-top" alt="samochod_audi">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title text-center">'.$r['nazwa'].'</h5>';
                echo '<p class="text-center">'.$r['typ'].'</p>';
                echo '<p class="text-center font-weight-bold">'.$r['cena'].' zł / h</p>';
                echo '<button class="btn btn-primary col-12" onclick="reserve('.$r['id'].')">REZERWUJ</button>'; //pobranie id z db
                echo '</div>';
                echo '</div>';
                echo '</div>';

            }
            ?>

 

    <!--dostępne-->

    <!--niedostępne-->
    <section id="niedostepne"></section>
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center p-5">OBECNIE ZAREZERWOWANE</h1>
            </div>
        </div>
        <div class="row">

            <?php
            $rows = get_cars('niedostepne');
            foreach($rows as $r) {
                echo '<div class=col-lg-4 col-md-6 col-sm-12 mt-3>';
                echo '<div class="card">';
                echo '<img src="assets/'.$r['zdjecie_url'].' "class="card-img-top" alt="samochod_audi">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title text-center">'.$r['nazwa'].'</h5>';
                echo '<p class="text-center">'.$r['typ'].'</p>';
                echo '<p class="text-center font-weight-bold">'.$r['cena'].' zł / h</p>';
                echo '<button class="btn btn-danger col-12" disabled>Dostępny od '.$r['data_zwrotu'].'</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

            }
            ?>
 
    <!--niedostępne-->
    <!--Formularz rezerwacji-->
    <section id="rezerwacja">
        <div class="cointainer-fluid">
            <h1 class="text-center p-5 font-weight-bold">ZAREZERWUJ</h1>
            <div class="row">
                <div class="col-12 d-flex justify-content-center p-4 text-white">
                    <!--Wszystko jest wyśrodkowane-->
                    <form action="rezerwacja.php" method="POST">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="imie">Imię</label>
                                    <input type="text" class="form-control" name="imie" id="imie"
                                        placeholder="Podaj swoje imię" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nazwisko">Nazwisko</label>
                                    <input type="text" class="form-control" name="nazwisko" id="nazwisko"
                                        placeholder="Podaj nazwisko" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telefon">Telefon</label>
                            <input type="tel" name="telefon" class="form-control" name="telefon" id="telefon"
                                placeholder="Podaj numer telefonu" required>
                        </div>
                        <div class="form-group">
                            <label for="samochod">Samochód</label>
                            <select name="samochod" class="form-control" id="samochod">
                            <?php

                            $rows = get_cars("select");
                            foreach($rows as $r) {
                                echo '<option value="'.$r['id'].'">'.$r['nazwa'].'</option>';
                            }
                            ?>

                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="data">Termin</label>
                                    <input type="datetime-local" class="form-control" name="data" id="data" required>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="dni">Dni</label>
                                            <input type="number" class="form-control" name="dni" id="dni" min="0" max="13">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="godzin">Godzin</label>
                                            <input type="number" class="form-control" name="godzin" id="godzin" min="0" max="23">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4" >
                            <input type="submit" value="Rezerwuj" class="btn btn-danger col-12">
                        </div>
                       

                    </form>
                </div>
            </div>
        </div>
    </section>
        <!--Powrót do góry-->
    <button onclick="smoothScroll('header')" id="up-button"></button>
        <!--Powrót do góry-->
    <!--Formularz rezerwacji-->
    <footer>
        <div class="col-12">
            <h6 class="text-center font-weight-bold p-1">Realizacja: Mateusz Ciołek | Jan Seeliger | Mateusz Wojciechowski | Adam Drewing</h6>
        </div>
    </footer>
        <script src="js/Mojeskrypty.js"></script>    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>