<?php
require_once __DIR__ . '/../config.php';
require __DIR__ . '/../../vendor/autoload.php'; // Carica la libreria Stripe tramite Composer centralizzato

// Chiavi API Stripe
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY); // Sostituisci con la tua Secret Key
?>
