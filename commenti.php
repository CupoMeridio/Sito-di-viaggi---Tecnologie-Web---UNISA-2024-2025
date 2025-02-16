<?php
session_start();


$host='database-1.czikiq82wrwk.eu-west-2.rds.amazonaws.com';
$port = '5432';
$db= 'tw_prova';
$username= 'postgres';
$password= 'Farinotta01_';

$connection_string = "host=$host port=$port dbname=$db user=$username password=$password";
$db= pg_connect( $connection_string) or die('Impossibile connetersi al database:'.pg_last_error());


$testo =$_POST['experience'];
$stelle=$_POST['rating'];

/*$email =  $_SESSION['email'];
$mondo=  $_SESSION['mondo'];*/
$email="mattiasanzari2003@gmail.com";
$mondo="DragonBall";
//$stelle= 5;//vedi come prenderle 

$query= "INSERT INTO commento (email, testo, mondo, stelle ) VALUES ($1,$2,$3,$4)";
$stmt =  pg_prepare($db,"com",$query);
$result= pg_execute($db, "com",array($email,$testo,$mondo,$stelle));
if ($result) {
    echo "Commento caricato con successo!";
} else {
    echo "Errore durante il caricamento del commento.";
}

pg_close($db);

?>