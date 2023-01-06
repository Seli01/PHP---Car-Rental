
<?php

// Connect to the MySQL database
$link = mysqli_connect("localhost", "root", "", "wypozyczalnia");

// Check the connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the variables from the database
$query = "SELECT id FROM rezerwacje ORDER BY id DESC LIMIT 1;";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'];
$id++;

// Close the connection
mysqli_close($link);

?>


