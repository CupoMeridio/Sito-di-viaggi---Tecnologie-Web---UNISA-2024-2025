<?php
session_start();
$nome="";
$cognome="";
$email="";
$username="";
$password_pre_hash="";
$img="";
$type="";

if(isset($_POST["inviato"])){
    include 'logreg.php';
    
}else{
    
?>
<!DOCTYPE html>
<html lang="it">                                                                                        <!-- Specifica il tipo di documento come HTML5 e imposta la lingua della pagina su italiano -->

<head>
    <meta charset="UTF-8">                                                                              <!-- Definisce la codifica dei caratteri come UTF-8, per supportare caratteri speciali -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">                              <!-- Rende la pagina responsiva, adattandola alla larghezza dello schermo del dispositivo -->
    <title>Form di registrazione</title>                                                                <!-- Imposta il titolo della pagina che apparirà nella scheda del browser -->
    <link rel="stylesheet" href="registrazioneStyle.css">                                               <!-- Collega il file CSS esterno per definire gli stili visivi della pagina -->
    <script src="registrazione_javascript.js" type="text/javascript" defer="true"></script>             <!-- Collegamento al file JavaScript esterno per la logica di validazione o interattività -->
</head>

<body>
    
    <nav>
        <a href="index.html"><img src="immagini/logo.png"></a>
        <a class="navButton" id="homeButton" href="index.html">Home</a>
        <a class="navButton" id="aboutButton"href="index.html#about">About</a>
    </nav>
    
                                                                                                                            <!-- Corpo del documento, dove vengono definiti i contenuti visibili sulla pagina -->
<video id="background-video" autoplay muted loop></video>                                                                            <!-- Video di background -->
    <div id="main-container" class="container">     
        <div id="registrazione_page" class="page">                                                                       <!-- Contenitore principale per il modulo di registrazione, utile per applicare stili CSS -->                                                                                             <!-- Titolo della sezione del modulo -->
        <form id="form-registrazione" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" onsubmit="return verificaPassword()">  <!-- onsubmit che serve alla verifica della pw -->
            <input type="hidden" name="action" value="reg">                                                  <!-- Inizio del modulo per la registrazione, identificato dall'id "registrazione" -->
            <div id="registrazione">

            <div class="form-group">

                <div class="form-fields">                                                               <!-- Contenitore per il campo Nome -->
                    <label for="nome">Nome</label>                                                      <!-- Etichetta per il campo di input associato, con l'attributo "for" legato all'id -->
                    <input type="text" id="nome" name="nome" value="<?php echo $nome ?>"required>                                  <!-- Campo di input per il nome, obbligatorio grazie all'attributo "required" -->
                </div>

                <div class="form-fields">                                                                <!-- Contenitore per il campo Cognome -->
                    <label for="cognome">Cognome</label>
                    <input type="text" id="cognome" name="cognome" value="<?php echo $cognome ?>" required>
                </div>

                <div class="form-fields">                                                                <!-- Contenitore per il campo Username -->
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo $username ?>"required>
                </div>

                <div class="form-fields">                                                                <!-- Contenitore per il campo Email -->
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $email ?>"required>                                <!-- Il tipo "email" garantisce una validazione di base del formato email -->
                </div>

                <div class="form-fields">                                                                <!-- Contenitore per il campo Password -->
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="" required>                       <!-- Il tipo "password" oscura il testo inserito per motivi di sicurezza -->
                    <div class="password-hint" id="passwordHint">                                        <!-- Testo di suggerimento per indicare i requisiti della password -->
                        La password deve contenere almeno 8 caratteri e includere almeno una
                        lettera maiuscola, una lettera minuscola, un numero e un carattere speciale.
                    </div>
                    <span id="passwordError" class="error"></span>                                       <!-- Messaggio di errore per il campo password (se necessario) -->
                    <div class="password-security" id="passwordSecurity"></div>                          <!-- Indicatore visivo della sicurezza della password -->
                </div>

                <div class="form-fields">                                                                <!-- Contenitore per il campo Conferma password -->
                    <label for="confirmPassword">Conferma password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>         <!-- Campo per confermare la password inserita -->
                    <div id="confirmPasswordError" class="error"></div>                                  <!-- Messaggio09% di errore per il campo di conferma password (se necessario) -->
                </div>
            </div>
        
    
            <div class="form-photo">                                                                     <!-- Contenitore per l'upload della foto profilo -->
                <div class="form-group">
                    <label>Foto profilo</label>
                    <div id="dropArea" class="drop-area">                                                <!-- Area per il drag-and-drop della foto -->
                        Trascina qui la tua immagine o clicca per selezionarla.
                        <input type="file" id="fotoProfilo" name="fotoProfilo" accept="image/*" style="display: none">
                    </div>
                    <div id="anteprimaFoto" class="anteprima-foto">                                       <!-- Anteprima della foto caricata -->
                        <img id="immagineAnteprima" src="" alt="Anteprima foto profilo" style="display: none;">
                    </div>
                </div>
            </div>
            </div>
            <div class="button-submit-container">
                <input type="submit" value="Registrati" name="inviato">                                              <!-- Pulsante per inviare il modulo -->
            </div>
            <div class="messaggio-login">Sei già registrato? <a href="#login_page">Login</a></div>
        </form>
        <p id="message"></p> 
        </div> 



        <div id="login_page" class="page">
        <form id="form-login"action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" name="action" value="login">                                                  <!-- Inizio del modulo per la registrazione, identificato dall'id "registrazione" -->
            <div id="login">

            <div class="form-group">
                <div class="form-fields">                                                                <!-- Contenitore per il campo Email -->
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $email ?>"required>                                <!-- Il tipo "email" garantisce una validazione di base del formato email -->
                </div>

                <div class="form-fields">                                                                <!-- Contenitore per il campo Password -->
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="" required>                       <!-- Il tipo "password" oscura il testo inserito per motivi di sicurezza -->
                </div>

            </div>
            <div class="button-submit-container">
                <input type="submit" value="Login" name="inviato">
            </div> 
            <div class="messaggio-registrazione">Non sei registrato? <a href="#registrazione_page">Registrati</a></div>
        </form>  
        </div>                                                                            <!-- Paragrafo8$ vuoto per visualizzare messaggi dinamici (es. conferma registrazione) -->
    </div>

    
</body>

</html>

<?php
} 
?>