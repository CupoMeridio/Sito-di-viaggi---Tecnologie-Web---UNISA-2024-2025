<?php

require 'connection.php';
require 'controlloGenerale.php';
session_start();
if (!isset($_POST["action"])) {
    exit;
}

$form = $_POST["action"];
$_SESSION['errore'] = "";
if ($form == "reg") {
    if (isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password_pre_hash = $_POST["password"];




        $bytea = "";
        $type = "";
        //di sicuro prendo le variabili da un form    
        if (($_FILES["fotoProfilo"]['tmp_name']) != null || $_FILES["fotoProfilo"]['tmp_name'] != "") {
            $img = $_FILES["fotoProfilo"]['tmp_name'];
            $type = $_FILES["fotoProfilo"]['type'];
            $bin = file_get_contents($img);
            $bytea = pg_escape_bytea($bin);
        }
        if (controlloPatternEmail($email) && controlloPatternPassword($password_pre_hash) && controlloPatternNome($nome) && controlloPatternCognome($cognome)) {
            $hash = password_hash($password_pre_hash, PASSWORD_DEFAULT);
            $query_no_injection = "INSERT INTO utente (nome, cognome, username, email, password, img,type) VALUES ($1, $2, $3,LOWER($4), $5, $6, $7)";
            //inserimento dei dati nel database
            $result = pg_prepare($db, "insert", $query_no_injection);
            $values = array($nome, $cognome, $username, $email, $hash, $bytea, $type);

            //adesso eseguo la query con i valori escapati
            $result = pg_execute($db, "insert", $values);


            if (!$result) {
                $_SESSION['errore'] = "Impossibile conatattare il database, riprova più tardi.";
                header("Location: registrazione.php");
                exit();
            } else {
                $_SESSION['auth'] = "Prima di accedere autenticati";
                header("Location: registrazione.php?login&email=$email");
                exit();
            }

        }

    }
} else if ($form == "login") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    if (controlloEmail($email, $db)) {
        if (controlloPassword($email, $password, $db)) {
            $_SESSION['email'] = $email;
            header("Location: index.php");
        } else {//CONTROLLO PASSWORD FALLITO
            $_SESSION['errore'] = $_SESSION['errore'] . " Password errata. ";
            //header("Location: index.php"); 
            header("Location: registrazione.php?login");
            exit();
        }

    } else {//CONTROLLO EMAIL FALLITO
        $_SESSION['errore'] = $_SESSION['errore'] . " L'email inserita non è associata ad alcun account. ";
        //header("Location: index.html"); 
        header("Location: registrazione.php?login");
        exit();
    }

}
pg_close($db);

?>