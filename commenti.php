<?php
session_start();


include 'connection.php';
$testo =$_POST['experience'];
$stelle=$_POST['rating'];

$email =  $_SESSION['email'];
$mondo=  $_SESSION['mondo'];

$username=$_SESSION['username'];

 

$query= "INSERT INTO commento (email, username, testo, mondo, stelle ) VALUES ($1,$2,$3,$4, $5)";
$stmt =  pg_prepare($db,"com",$query);
$result= pg_execute($db, "com",array($email,$username,$testo,$mondo,$stelle));
if ($result) {
    echo "Commento caricato con successo!";
} else {
    echo "Errore durante il caricamento del commento.";
}

pg_close($db);

?>