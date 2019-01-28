<?php

$servername = "localhost";
$dBgebruikersnaam = "root";
$dBwachtwoord = "";
$dbName = "loginsysteem";

$conn = mysqli_connect($servername, $dBgebruikersnaam, $dBwachtwoord, $dbName);

if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}