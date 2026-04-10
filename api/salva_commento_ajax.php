<?php
session_start();


include __DIR__ . '/connessione_db.php';
/** @var mysqli $db */

$testo =$_POST['experience'];
$stelle=$_POST['rating'];

$email =  $_SESSION['email'];
$mondo=  $_SESSION['mondo'];

$username=$_SESSION['username'];

 

$query= "INSERT INTO commento (email, username, testo, mondo, stelle ) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "ssssi", $email, $username, $testo, $mondo, $stelle);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo "Commento caricato con successo!";
} else {
    echo "Errore durante il caricamento del commento: " . mysqli_error($db);
}

mysqli_close($db);

?>