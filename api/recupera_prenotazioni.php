<?php
session_start();
include __DIR__ . '/connessione_db.php';
/** @var mysqli $db */


$id_ultima_prenotazione=0;

if ( isset($_POST['ultima_prenotazione']))
$id_ultima_prenotazione = $_POST['ultima_prenotazione'];

if(isset($_SESSION['email'])){

    $email= $_SESSION['email'];
    
    $query_no_injection= " SELECT * FROM  prenotazione where email=?  and (id_prenotazione > ?) ";
    $stmt = mysqli_prepare($db, $query_no_injection);
    mysqli_stmt_bind_param($stmt, "si", $email, $id_ultima_prenotazione);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

$output_p = [];
while ($row = mysqli_fetch_assoc($result)) {
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
        "data_p" => $dateArray[0] ?? '',
        "data_r" => $dateArray[1] ?? ''
    ];
    $output_p[] = $input_p;
}
$prenotazioni = json_encode($output_p);
echo $prenotazioni;
}

mysqli_close($db);
?>