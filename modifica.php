<?php
session_start();
if (isset($_SESSION['img']))
    $img = $_SESSION['img'];
if (isset($_SESSION['username']))
    $username = $_SESSION['username'];
if (isset($_SESSION['email']))
    $email = $_SESSION['email'];
if (isset($_SESSION['nome']))
    $nome = $_SESSION['nome'];
if (isset($_SESSION['cognome']))
    $cognome = $_SESSION['cognome'];

include 'connection.php';
$img_tmp = '';
$type = '';
$bin = '';
$img_up = '';

if (isset($_POST['update'])) {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    //$email = $_POST['email'];
    $username = $_POST['username'];

    //$img = $_SESSION['img'];

    // Gestione dell'upload della nuova immagine del profilo
    if ($_FILES['fotoProfilo']['tmp_name'] != null) {
        $img_tmp = $_FILES['fotoProfilo']['tmp_name'];
        $type = $_FILES['fotoProfilo']['type'];
        $bin = file_get_contents($img_tmp);
        $img_up = pg_escape_bytea($bin);
    }

    // Query per aggiornare i dati dell'utente
    if (isset($img_up) && $img_up != null) {
        $query = "UPDATE utente SET nome = $1, cognome = $2, username = $3, img = $4, type = $5 WHERE email = $6";
        $result = pg_prepare($db, "update_user", $query);
        $values = array($nome, $cognome, $username, $img_up, $type, $_SESSION['email']);
    } else {
        $query = "UPDATE utente SET nome = $1, cognome = $2, username = $3 WHERE email = $4";
        $result = pg_prepare($db, "update_user", $query);
        $values = array($nome, $cognome, $username, $_SESSION['email']);
    }

    $result = pg_execute($db, "update_user", $values);

    if ($result) {
        //header("Location: index.php");
        echo "<script>window.parent.postMessage('operationComplete', '*');</script>";
        //exit();
    } else {
        $_SESSION['errore'] = "Errore durante l'aggiornamento dei dati.";
        header("Location: modifica.php");
        echo "<script>window.parent.postMessage('operationComplete', '*');</script>";
        //exit();
    }

    unset($img_up);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica dati</title> <!-- Collega il file CSS esterno per definire gli stili visivi della pagina -->
    <link rel="stylesheet" href="commons/navbarStyle.css">
    <link rel="stylesheet" href="commons/footerStyle.css">
    <link rel="stylesheet" href="commons/footerStyle.css">
    <link rel="stylesheet" href="modifica.css">
    <?php include("commons/setIcon.html"); ?>

    
</head>

<body>



    <div id="modifica">

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h2>Modifica Dati</h2>
            <div class="wrapper">
                <img src="<?php echo $img; ?>" alt="Foto Profilo" width="100" id="current">
                <div id="anteprimaFoto" class="anteprima-foto">
                    <img id="immagineAnteprima" src="" alt="Anteprima foto profilo">
                </div>
            </div>

            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $nome ?>" required>

            <label>Cognome:</label>
            <input type="text" name="cognome" value="<?php echo $cognome ?>" required>

            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $username ?>" required>

            <label>Foto Profilo:</label>
            <input type="file" name="fotoProfilo" id="fotoProfilo" accept="image/*">

            <div class="wrapper"><input type="submit" name="update" value="Aggiorna Dati"></div>
            <div class="wrapper">
                <input type="button" name="close" value="Chiudi la Pagina" onclick="window.parent.postMessage('operationComplete', '*')">
            </div>
        </form>
        <?php
        if (isset($_SESSION['errore'])) {
        ?>
            <p><?php echo $_SESSION['errore']; ?></p>
        <?php } ?>

    </div>
    <script>
        // Costanti
        const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB

        // Riferimenti agli elementi del DOM
        const fotoProfiloInput = document.getElementById('fotoProfilo');
        const immagineAnteprima = document.getElementById('immagineAnteprima');

        let img_corrente=document.getElementById("current");
        // Funzione per gestire il file selezionato
        function handleFile(file) {
            if (file.size > MAX_FILE_SIZE) {
                alert('Il file supera la dimensione massima consentita di 5 MB.');
                return;
            }

            const reader = new FileReader(); // Crea un oggetto FileReader

            // Quando il file è stato caricato
            reader.onload = function(e) {
                immagineAnteprima.src = e.target.result; // Imposta l'URL dell'immagine letta come sorgente dell'anteprima
                immagineAnteprima.style.display = "block"; // Mostra l'immagine nell'anteprima
                img_corrente.style.display="none";
            };

            reader.readAsDataURL(file); // Legge il file come URL di dati
        }

        // Gestione del cambio di file
        fotoProfiloInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Ottieni il file selezionato

            if (file) {
                handleFile(file); // Gestisci il file
            } else {
                immagineAnteprima.style.display = "none"; // Nascondi l'anteprima se non ci sono file
                img_corrente.style.display="block";
            }
        });
    </script>
</body>


</html>
<?php


unset($_SESSION['errore']);
pg_close();


?>