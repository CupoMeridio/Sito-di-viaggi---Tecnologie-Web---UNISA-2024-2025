<?php
session_start();
ini_set ('session.gc_maxlifetime', '600'); 
ini_set ('session.cookie_lifetime', '600'); 

// Imposta la probabilità che il garbage collector delle sessioni venga eseguito
ini_set('session.gc_probability', 100);

// Imposta il divisore per la probabilità del garbage collector delle sessioni
ini_set('session.gc_divisor', 100);

include('controlloGenerale.php');
include('connection.php');

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
        $query_no_injection = "SELECT nome, cognome FROM utente WHERE email=$1";
        $result = pg_prepare($db, "select_email", $query_no_injection);
        $values = array($email);
        $result = pg_execute($db, "select_email", $values);

        if ($result && pg_num_rows($result) > 0) {
            $_SESSION['email_inviata']="Ti abbiamo inviato un'email al seguente indirizzo " . $email;
           // echo "Ti abbiamo inviato un'email al seguente indirizzo " . $email;

            $row = pg_fetch_assoc($result);
            $nome = $row['nome'];
            $cognome = $row['cognome'];
            $_SESSION['codice'] = rand(100000, 999999);
            $_SESSION['email'] = $email;

            $body = "Ecco il codice per resettare la password: " . $_SESSION['codice'];
            $subject = 'Recupero password';
            include('invia_email.php');
        } else {
            $_SESSION['pw_problem'] = "<div><p>Non hai ancora un account  <a href='registrazione.php#form-registrazione'>Registrati</a></p></div> ";
        }
    }
}

if (isset($_POST['Cambia_password']))
    $password = $_POST['Cambia_password'];

if ($password != "") {
    if (controlloPatternPassword($password)) {
        if (isset($_POST['codice_cambia_password']) && isset($_POST['Cambia_password'])) {
            if ($_POST['codice_cambia_password'] == $_SESSION['codice']) {
                $query_no_injection = "UPDATE utente SET password=$1 WHERE email=$2";
                $result = pg_prepare($db, "cambio_pw", $query_no_injection);
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $values = array($hash, $_SESSION['email']);
                $result = pg_execute($db, "cambio_pw", $values);

                if ($result) {
                    echo "Password cambiata";
                } else {
                    echo "Problema con la procedura - password non cambiata";
                }
                include('logout.php');
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
    <link rel="stylesheet" href="registrazioneStyle.css"> <!-- Collega il file CSS esterno per definire gli stili visivi della pagina -->
    <?php include("commons/setIcon.html"); ?>
    <script src="recupero_pw.js" type="text/javascript" defer="true"></script>
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