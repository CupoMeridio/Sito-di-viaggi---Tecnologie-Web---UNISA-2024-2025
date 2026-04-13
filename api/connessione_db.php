<?php
require_once __DIR__ . '/config.php';

/** @var mysqli|false $db */
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('Impossibile connettersi al database: ' . mysqli_connect_error());

mysqli_set_charset($db, 'utf8mb4');
?>