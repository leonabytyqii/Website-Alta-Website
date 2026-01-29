<?php

$host = "localhost";
$dbname = "alta_travel";
$username = "root";
$password = "";

// krijimi i lidhjes
$conn = new mysqli($host, $username, $password, $dbname);

// kontrollo nese ka error
if ($conn->connect_error) {
    die("Lidhja me databazen deshtoi: " . $conn->connect_error);
}

// charset (shumë e rëndësishme për shkronja shqip)
$conn->set_charset("utf8mb4");
?>