<?php
session_start();
include 'connection.php';

$id_ultima_prenotazione=0;

if ( isset($_POST['ultima_prenotazione']))
$id_ultima_prenotazione = $_POST['ultima_prenotazione'];

if(isset($_SESSION['email'])){

    $email= $_SESSION['email'];
    
    $query_no_injection= " SELECT * FROM  prenotazione where email=$1  and (id_prenotazione > $2) ";
    $result=pg_prepare($db, "select_prenotazione", $query_no_injection); 
    $values=array($email, $id_ultima_prenotazione);
    $result=pg_execute($db, "select_prenotazione", $values);

$output_p = [];
while ($row = pg_fetch_assoc($result)) {
    $dateArrayString = $row['data'];
// Rimuovi le parentesi graffe
    $dateArrayString = trim($dateArrayString, '{}');
// Converte la stringa in un array
    $dateArray = explode(',', $dateArrayString);

    $input_p = [
        "id_prenotazione" => $row['id_prenotazione'],
        "nome" =>$row['nome'],
        "cognome" => $row['cognome'],
        "destinazione" => $row['destinazione'],
        "data_p" => $dateArray[0],
        "data_r" => $dateArray[1]
    ];
    $output_p[] = $input_p;
}
$prenotazioni = json_encode($output_p);
echo $prenotazioni;
    /*if(isset($nome))
    $_SESSION['nome_prenotazione']= $nome;
    if(isset($cognome))
    $_SESSION['cognome_prenotazione']= $cognome;
    if(isset($data))
    $_SESSION['data_prenotazione']= $data;
    if(isset($destinazione))
    $_SESSION['destinazione_prenotazione']= $destinazione;
    if(isset( $id_prenotazione))
    $_SESSION['id_prenotazione']= $id_prenotazione;*/
}

pg_close($db);
?>