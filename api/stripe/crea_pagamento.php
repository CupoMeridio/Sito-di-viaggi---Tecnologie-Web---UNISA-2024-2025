<?php
// Imposta l'intestazione per JSON
header('Content-Type: application/json');
session_start();
require 'configurazione_stripe.php';

$email = $_SESSION['email'] ?? "ospite@example.com";

// Recupero parametri per il calcolo del prezzo lato server
$num_biglietti = isset($_POST["num_biglietti"]) ? intval($_POST["num_biglietti"]) : 1;
$data_p = isset($_POST["data_p"]) ? strtotime($_POST["data_p"]) : time();
$data_r = isset($_POST["data_r"]) ? strtotime($_POST["data_r"]) : time();

// Calcolo giorni (minimo 1)
$diff_seconds = abs($data_r - $data_p);
$diff_days = ceil($diff_seconds / (60 * 60 * 24));
if ($diff_days < 1) $diff_days = 1;

// Calcolo prezzo (50€ al giorno per biglietto + 5€ base)
$prezzo_euro = ($diff_days * $num_biglietti * 50) + 5;
$importo_centesimi = $prezzo_euro * 100;

try {
    // Crea un Payment Intent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $importo_centesimi,
        'currency' => 'eur',
        'payment_method_types' => ['card'],
        'description' => 'Biglietto di viaggio BeyondReality',
        'receipt_email' => $email
    ]);

    // Restituisci la client_secret in JSON
    echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
} catch (Exception $e) {
    // In caso di errore, restituisci il messaggio in JSON
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
