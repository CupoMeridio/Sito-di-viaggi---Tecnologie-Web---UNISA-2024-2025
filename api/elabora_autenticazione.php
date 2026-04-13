<?php

require __DIR__ . '/connessione_db.php';
/** @var mysqli $db */

require __DIR__ . '/validazione_generale.php';
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
            // Limite 1MB per InfinityFree
            if ($_FILES["fotoProfilo"]['size'] > 1024 * 1024) {
                $_SESSION['errore'] = "L'immagine è troppo grande (max 1MB).";
                header("Location: ../autenticazione.php");
                exit();
            }
            $img = $_FILES["fotoProfilo"]['tmp_name'];
            $type = $_FILES["fotoProfilo"]['type'];
            $bin = file_get_contents($img);
            $bytea = mysqli_real_escape_string($db, $bin);
        }
        if (controlloPatternEmail($email) && controlloPatternPassword($password_pre_hash) && controlloPatternNome($nome) && controlloPatternCognome($cognome)) {
            $hash = password_hash($password_pre_hash, PASSWORD_DEFAULT);
            $query_no_injection = "INSERT INTO utente (nome, cognome, username, email, password, img, type) VALUES (?, ?, ?, LOWER(?), ?, ?, ?)";
            $stmt = mysqli_prepare($db, $query_no_injection);
            
            // Definiamo una variabile per il parametro long data (blob)
            $null = null;
            // Ordine: nome(s), cognome(s), username(s), email(s), password(s), img(b), type(s)
            mysqli_stmt_bind_param($stmt, "sssssbs", $nome, $cognome, $username, $email, $hash, $null, $type);
            
            if ($bytea != "") {
                mysqli_stmt_send_long_data($stmt, 5, $bytea);
            }
            
            $result = mysqli_stmt_execute($stmt);


            if (!$result) {
                $_SESSION['errore'] = "Impossibile conatattare il database, riprova più tardi.";
                header("Location: ../autenticazione.php");
                exit();
            } else {
                $_SESSION['auth'] = "Prima di accedere autenticati";
                header("Location: ../autenticazione.php?login&email=$email");
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
            header("Location: ../index.php");
        } else {
            $_SESSION['errore'] = $_SESSION['errore'] . " Password errata. ";
            header("Location: ../autenticazione.php?login");
            exit();
        }

    } else {
        $_SESSION['errore'] = $_SESSION['errore'] . " L'email inserita non è associata ad alcun account. ";
        header("Location: ../autenticazione.php?login");
        exit();
    }

}
mysqli_close($db);

?>