<?php

/**
 * BeyondReality Journeys - Servizio Email tramite Brevo API
 * Sostituisce PHPMailer (SMTP) per compatibilità con InfinityFree.
 */
require_once __DIR__ . '/config.php';

// Se non sono già definite, le inizializziamo per sicurezza
$email = $email ?? '';
$nome = $nome ?? '';
$cognome = $cognome ?? '';
$subject = $subject ?? 'Comunicazione da BeyondReality Journeys';
$body = $body ?? '';

$url = 'https://api.brevo.com/v3/smtp/email';

$data = [
    'sender' => [
        'name' => BREVO_SENDER_NAME,
        'email' => BREVO_SENDER_EMAIL
    ],
    'to' => [
        [
            'email' => $email,
            'name' => $nome . ' ' . $cognome
        ]
    ],
    'subject' => $subject,
    'htmlContent' => $body
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'api-key: ' . BREVO_API_KEY,
    'Content-Type: application/json',
    'Accept: application/json'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    error_log('Errore cURL nell\'invio email: ' . curl_error($ch));
}

curl_close($ch);

if ($httpCode >= 200 && $httpCode < 300) {
    // Successo - Volendo si può loggare la risposta
    // error_log("Email inviata con successo a $email");
} else {
    // Errore nell'invio tramite API
    error_log("Errore invio email Brevo. Codice HTTP: $httpCode. Risposta: $response");
}

?>