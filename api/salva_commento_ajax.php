<?php
session_start();


if (!isset($_SESSION['email'])) {
    http_response_code(401);
    echo "Errore: Devi essere loggato per commentare.";
    exit;
}

include __DIR__ . '/connessione_db.php';
/** @var mysqli $db */

// Sanitizzazione input per prevenire XSS
$testo = htmlspecialchars($_POST['experience'], ENT_QUOTES, 'UTF-8');
$stelle = intval($_POST['rating']);

$email = $_SESSION['email'];
$mondo = $_SESSION['mondo'];
$username = $_SESSION['username'];

$query = "INSERT INTO commento (email, username, testo, mondo, stelle ) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "ssssi", $email, $username, $testo, $mondo, $stelle);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo "Commento caricato con successo!";
} else {
    // Messaggio generico per la sicurezza
    echo "Errore durante il caricamento del commento. Riprova più tardi.";
}

mysqli_close($db);

?>