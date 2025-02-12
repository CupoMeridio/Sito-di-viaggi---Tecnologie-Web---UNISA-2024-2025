<?php
session_start();


$host='database-1.czikiq82wrwk.eu-west-2.rds.amazonaws.com';
$port = '5432';
$db= 'tw_prova';
$username= 'postgres';
$password= 'Farinotta01_';

$connection_string = "host=$host port=$port dbname=$db user=$username password=$password";
$db= pg_connect( $connection_string) or die('Impossibile connetersi al database:'.pg_last_error());

$MAX=0;

if ( isset($_GET['max']))
    $MAX = $_GET['max'];


$query= "SELECT email, testo, id_testo, mondo,stelle FROM commento where (id_testo > $MAX)";// ricordati di usare il prepere 

$result = pg_query($db, $query);

$row = pg_fetch_assoc($result);


$out= '[';

while( $row != false){

    
    if($out != '[' ){ $out=$out.','; }
    $out= $out.'{ "email": "'.$row['email'].'",';
    $out= $out.' "testo": "'.$row['testo'].'",';
    $out= $out.' "id_testo": "'.$row['id_testo'].'",';
    $out= $out.' "stelle": "'.$row['stelle'].'",';
    $out= $out.' "mondo": "'.$row['mondo'].'"}';
    $row = pg_fetch_assoc($result);
}
$out=$out.']';
echo $out;
/*$json = json_decode($out);
if (json_last_error() === JSON_ERROR_NONE) {
    echo $out;
} else {
    echo 'Errore nella generazione del JSON: ' . json_last_error_msg();
}*/
pg_close($db);

?>