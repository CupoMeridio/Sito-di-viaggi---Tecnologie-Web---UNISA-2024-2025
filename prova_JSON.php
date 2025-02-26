<?php
session_start();


include 'connection.php';

$MAX=0;

if ( isset($_POST['max']))
    $MAX = $_POST['max'];


if(!isset($_SESSION['mondo'])){
    //Sesione commenti nella homepage (non utilizzato più)
    $query_no_injection= "SELECT email, username, testo, id_testo, mondo,stelle FROM commento where (id_testo > $1)";// ricordati di usare il prepere 
    //inserimento dei dati nel database
    $result=pg_prepare($db, "insert_commenti", $query_no_injection); 
    $values=array($MAX);

    //adesso eseguo la query con i valori escapati
    $result=pg_execute($db, "insert_commenti", $values);
 
}else{
    $query_no_injection = "SELECT email,username, testo, id_testo, mondo, stelle FROM commento WHERE (id_testo > $1) AND (mondo = $2)";// ricordati di usare il prepere 

    $result=pg_prepare($db, "insert_commenti_mondo", $query_no_injection); 
    $values=array($MAX , $_SESSION['mondo']);

    //adesso eseguo la query con i valori escapati
    $result=pg_execute($db, "insert_commenti_mondo", $values);
}




$out = [];

//Creazione del JSON
while ($row = pg_fetch_assoc($result)) {
    $entry = [
        "email" => $row['email'],
        "username" =>$row['username'],
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