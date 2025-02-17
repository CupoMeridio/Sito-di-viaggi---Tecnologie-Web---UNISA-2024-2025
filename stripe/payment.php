<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Imposta l'intestazione per JSON
header('Content-Type: application/json');
require 'config.php';

$email="mattiasanzari2003@gmail.com";

$importo = $_POST["importo"];

try {
    // Crea un Payment Intent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $importo,
        'currency' => 'eur',
        'payment_method_types' => ['card'],
        'description' => 'Biglietto di viaggio ',
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
