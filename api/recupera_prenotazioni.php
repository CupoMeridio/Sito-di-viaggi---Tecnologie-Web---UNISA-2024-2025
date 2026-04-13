<?php
session_start();
include __DIR__ . '/connessione_db.php';
/** @var mysqli $db */


if(!isset($_SESSION['email'])){
    http_response_code(401);
    echo json_encode(["error" => "Utente non autenticato"]);
    exit();
}

$id_ultima_prenotazione=0;

if ( isset($_POST['ultima_prenotazione']))
    $id_ultima_prenotazione = intval($_POST['ultima_prenotazione']);

$email= $_SESSION['email'];

$query_no_injection= " SELECT * FROM  prenotazione where email=?  and (id_prenotazione > ?) ";
$stmt = mysqli_prepare($db, $query_no_injection);
mysqli_stmt_bind_param($stmt, "si", $email, $id_ultima_prenotazione);

if ($stmt) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Errore nel recupero delle prenotazioni"]);
    exit;
}

$output_p = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dateArrayString = $row['data'];
    // Rimuovi le parentesi graffe
    $dateArrayString = trim($dateArrayString, '{}');
    // Converte la stringa in un array
    $dateArray = explode(',', $dateArrayString);

    $input_p = [
        "id_prenotazione" => $row['id_prenotazione'],
        "nome" => htmlspecialchars($row['nome'], ENT_QUOTES, 'UTF-8'),
        "cognome" => htmlspecialchars($row['cognome'], ENT_QUOTES, 'UTF-8'),
        "destinazione" => htmlspecialchars($row['destinazione'], ENT_QUOTES, 'UTF-8'),
        "data_p" => $dateArray[0] ?? '',
        "data_r" => $dateArray[1] ?? ''
    ];
    $output_p[] = $input_p;
}
echo json_encode($output_p);

mysqli_close($db);
?>