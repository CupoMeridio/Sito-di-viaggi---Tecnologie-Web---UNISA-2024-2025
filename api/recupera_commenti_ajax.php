<?php
session_start();


include __DIR__ . '/connessione_db.php';
/** @var mysqli $db */

$MAX=0;
if ( isset($_POST['max']))
    $MAX = intval($_POST['max']);


if(!isset($_SESSION['mondo'])){
    $query_no_injection= "SELECT email, username, testo, id_testo, mondo, stelle FROM commento WHERE id_testo > ? ORDER BY id_testo ASC";
    $stmt = mysqli_prepare($db, $query_no_injection);
    mysqli_stmt_bind_param($stmt, "i", $MAX);
}else{
    $query_no_injection = "SELECT email, username, testo, id_testo, mondo, stelle FROM commento WHERE (id_testo > ?) AND (mondo = ?) ORDER BY id_testo ASC";
    $stmt = mysqli_prepare($db, $query_no_injection);
    mysqli_stmt_bind_param($stmt, "is", $MAX, $_SESSION['mondo']);
}

if ($stmt) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Errore nel recupero dei commenti"]);
    exit;
}

$out = [];
while ($row = mysqli_fetch_assoc($result)) {
    $entry = [
        "email" => $row['email'],
        "username" =>$row['username'],
        "testo" => $row['testo'], // Già sanitizzato in fase di salvataggio, ma il frontend lo sanitizza di nuovo per sicurezza
        "id_testo" => $row['id_testo'],
        "stelle" => intval($row['stelle']),
        "mondo" => $row['mondo']
    ];
    $out[] = $entry;
}
echo json_encode($out);

mysqli_close($db);

?>