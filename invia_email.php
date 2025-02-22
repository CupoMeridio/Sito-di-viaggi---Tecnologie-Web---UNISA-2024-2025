<?php

include '.\PHPMailer\PHPMailer-master\src\Exception.php';
include '.\PHPMailer\PHPMailer-master\src\PHPMailer.php';
include '.\PHPMailer\PHPMailer-master\src\SMTP.php';



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//require 'vendor/autoload.php';

//session_start() ;

/*$email= "mattiasanzari2003@gmail.com";
$nome= "Mattia";
$cognome= "Sanzari";*/

$mail= new PHPMailer();

    // Impostazioni del server
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tecnologiewebgruppo11@gmail.com';
        $mail->Password = 'bvkd rcbo cghv spez';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
    // Destinatari
    $mail->setFrom('tecnologiewebgruppo11@gmail.com', 'Il Team');
    $mail->addAddress($email, $nome.' '.$cognome);           // Aggiungi un destinatario

    // Contenuto
    $mail->isHTML(true);                                        // Imposta il formato dell'email su HTML
    $mail->Subject =  $subject;
    $mail->Body    = $body;
   // $mail->AltBody = 'ATTACCO per il giorno 8/02 a Guardia Sanframondi ';

    
    if($mail->send()){
        echo 'Email inviata';
    }else{
        echo 'Email non inviata';
        echo $mail->ErrorInfo;
    } 

?>