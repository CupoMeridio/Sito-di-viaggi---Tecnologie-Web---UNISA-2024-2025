<?php
$host = 'localhost';
$port = '3306';
$dbname = 'sito_viaggi_fantasia';
$user = 'root';
$pass = '';

/** @var mysqli|false $db */
$db = mysqli_connect($host, $user, $pass, $dbname) or die('Impossibile connettersi al database: ' . mysqli_connect_error());



mysqli_set_charset($db, 'utf8mb4');
?>