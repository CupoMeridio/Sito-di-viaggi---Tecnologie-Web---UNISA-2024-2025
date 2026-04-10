<?php
ini_set ('session.gc_maxlifetime', '120'); 
ini_set ('session.cookie_lifetime', '120'); 

// Imposta la probabilità che il garbage collector delle sessioni venga eseguito
ini_set('session.gc_probability', 100);

// Imposta il divisore per la probabilità del garbage collector delle sessioni
ini_set('session.gc_divisor', 100);
session_start();

include('api/validazione_generale.php');
include('api/connessione_db.php');
/** @var mysqli $db */


$password = "";
$email = "";
//echo $_POST['email'];
if (isset($_POST['email']))
    $email = $_POST['email'];
//echo $email;
if ($email != "") {
    //echo $email;
    if (!controlloPatternEmail($email)) {
        $_SESSION['pw_problem'] = "Errore nella forma della email";
    } else {
        $query_no_injection = "SELECT nome, cognome FROM utente WHERE email=?";
        $stmt = mysqli_prepare($db, $query_no_injection);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $_SESSION['email_inviata']="Ti abbiamo inviato un'email al seguente indirizzo " . $email;
           // echo "Ti abbiamo inviato un'email al seguente indirizzo " . $email;

            $row = mysqli_fetch_assoc($result);
            $nome = $row['nome'];
            $cognome = $row['cognome'];
            $_SESSION['codice'] = rand(100000, 999999);
            $_SESSION['time_codice']= time();
            $_SESSION['email'] = $email;

            $body = "Ecco il codice per resettare la password: " . $_SESSION['codice']."\nIl codice è valido per 5 minuti";
            $subject = 'Recupero password';
            include('api/servizio_email.php');
        } else {
            $_SESSION['pw_problem'] = "<div><p>Non hai ancora un account  <a href='autenticazione.php#form-registrazione'>Registrati</a></p></div> ";
        }
    }
}

if (isset($_POST['Cambia_password']))
    $password = $_POST['Cambia_password'];

if ($password != "") {
    if (controlloPatternPassword($password)) {
        if (isset($_POST['codice_cambia_password']) && isset($_POST['Cambia_password'])) {

            $time_current= time();
            if(isset($_SESSION['time_codice']))
            $time_code=$_SESSION['time_codice'];

        if ( isset($time_code) && ($time_current - $time_code)>300 ){ 
            unset($_SESSION['codice']);
            unset($_SESSION['codice_timestamp']);
            $_SESSION['pw_problem']="Il codice è scaduto. Richiedi un nuovo codice.";
            
            header('recupero_password.php'); 
        }
        if(  isset($_SESSION['codice']))
        if($_POST['codice_cambia_password'] == $_SESSION['codice']) {
                $query_no_injection = "UPDATE utente SET password=? WHERE email=?";
                $stmt = mysqli_prepare($db, $query_no_injection);
                $hash = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ss", $hash, $_SESSION['email']);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    echo "Password cambiata";
                } else {
                    echo "Problema con la procedura - password non cambiata";
                }
                include('api/logout_utente.php');
            } else {
                echo "Il codice non è corretto " . $_POST['codice_cambia_password'];
                session_unset();
                session_destroy();
                if (isset($_SERVER['HTTP_COOKIE'])) {
                    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                    foreach ($cookies as $cookie) {
                        $parts = explode('=', $cookie);
                        $name = trim($parts[0]);
                        setcookie($name, '', time() - 3600, "/");
                    }
                }
            }
        }
    } else {
        $_SESSION['pw_problem_cambio'] = " La password deve rispettare il pattern ";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Recupero password</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/stile_autenticazione.css"> <!-- Collega il file CSS esterno per definire gli stili visivi della pagina -->
    <?php include("components/imposta_icona.html"); ?>
    <script src="js/utils.js" type="text/javascript" defer></script>
    <script src="js/logica_recupero_password.js" type="text/javascript" defer="true"></script>

    <style>
        #error {
            color: crimson;
            margin: auto;
            font-size: 15px;
        }

        #hint {
            color: grey;
            margin: 2px;
        }
        .container{
            margin: auto;
        }
        
    </style>
</head>

<body>
    <video id="background-video" autoplay muted loop></video>
    <div id="main-container" class="regcontainer" style="display: block;">
        <?php
        if (!isset($_SESSION['codice'])) { //echo $_SESSION['codice'];
        ?>
            <!-- Contenitore principale per il modulo di registrazione -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="email">Inserisci la tua e-mail:</label>
                <input type="text" id="email" name="email" value="<?php $email ?>">
                <input type="submit" value="Invio" style="width: 100%; margin-top:10px;" ;>
            </form>
            <?php if (isset($_SESSION['pw_problem'])) {
                echo $_SESSION['pw_problem'];
            } ?>
        <?php } else { 
            if(isset($_SESSION['email_inviata'])){?> 
            
            <div id="email_inviata" style="margin: 3px; font-size: 15px; color:deeppink"> <?php echo $_SESSION['email_inviata'] ?></div>

        <?php }?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                
                <div class="container">
                    <label for="Cambia_password">Scrivi la nuova password:</label>
                    <input type="text" id="Cambia_password" name="Cambia_password" required>
                    <div id="hint" style="margin: bottom 10px; font-size: 13px;">La lunghezza della password deve essere di almeno 8 caratteri. <br>La password deve contenere almeno una lettera maiuscola e almeno un carattere speciale.</div>
                    <div id="error"></div>
                </div>
                <p class="container">
                    <label for="codice_cambia_password">Scrivi il codice:</label>
                    <input name="codice_cambia_password" id="codice_cambia_password" type="text" pattern="\d{6}" required>
                </p>
                <input type="submit" value="Invio" style="width: 100%; margin-top:10px;">
            </form>
            <?php if (isset($_SESSION['pw_problem_cambio'])) {
                echo $_SESSION['pw_problem_cambio'];
            } ?>
    </div>
<?php
        } ?>


</body>


</html>

<?php
unset($_SESSION['email_inviata']);
?>