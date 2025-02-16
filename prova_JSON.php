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

if ( isset($_POST['max']))
    $MAX = $_POST['max'];


$query= "SELECT email, testo, id_testo, mondo,stelle FROM commento where (id_testo > $MAX)";// ricordati di usare il prepere 

$result = pg_query($db, $query);

$row = pg_fetch_assoc($result);


$out = [];

while ($row = pg_fetch_assoc($result)) {
    $entry = [
        "email" => $row['email'],
        "testo" => $row['testo'],
        "id_testo" => $row['id_testo'],
        "stelle" => $row['stelle'],
        "mondo" => $row['mondo']
    ];
    $out[] = $entry;
}
$commenti = json_encode($out);
echo $commenti;
/*$json = json_decode($out);
if (json_last_error() === JSON_ERROR_NONE) {
    echo $out;
} else {
    echo 'Errore nella generazione del JSON: ' . json_last_error_msg();
}*/
pg_close($db);

?>