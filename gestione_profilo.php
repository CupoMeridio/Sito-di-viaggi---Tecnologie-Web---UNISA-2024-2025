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

include 'api/connessione_db.php';
/** @var mysqli $db */

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
        // Limite 1MB per InfinityFree
        if ($_FILES['fotoProfilo']['size'] > 1024 * 1024) {
            $_SESSION['errore'] = "L'immagine è troppo grande (max 1MB).";
            header("Location: gestione_profilo.php");
            exit();
        }
        $img_tmp = $_FILES['fotoProfilo']['tmp_name'];
        $type = $_FILES['fotoProfilo']['type'];
        $bin = file_get_contents($img_tmp);
        $img_up = mysqli_real_escape_string($db, $bin);
    }

    // Query per aggiornare i dati dell'utente
    if (isset($img_up) && $img_up != null) {
        $query = "UPDATE utente SET nome = ?, cognome = ?, username = ?, img = ?, type = ? WHERE email = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $nome, $cognome, $username, $type, $img_up, $_SESSION['email']);
        
        if ($img_up != "") {
            mysqli_stmt_send_long_data($stmt, 3, $img_up);
        }
        
        $result = mysqli_stmt_execute($stmt);
    } else {
        $query = "UPDATE utente SET nome = ?, cognome = ?, username = ? WHERE email = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $nome, $cognome, $username, $_SESSION['email']);
        $result = mysqli_stmt_execute($stmt);
    }

    if ($result) {
        header("Location: index.php");
        echo "<script>window.parent.postMessage('operationComplete', '*');</script>";
        //exit();
    } else {
        $_SESSION['errore'] = "Errore durante l'aggiornamento dei dati.";
        header("Location: gestione_profilo.php");
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
    <link rel="stylesheet" href="css/stile_navbar.css">
    <link rel="stylesheet" href="css/stile_footer.css">
    <link rel="stylesheet" href="css/stile_modifica_profilo.css">
    <?php include("components/imposta_icona.html"); ?>
    <script src="js/utils.js" type="text/javascript" defer></script>



</head>

<body>



    <div id="modifica">

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h2>Modifica Dati</h2>
            <h3>Attenzione, modificare i dati ti riporterà nella home.</h3>
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

            <div class="file-input-container">
                <label for="fotoProfilo" class="custom-file-label">Scegli un file</label>
                <input type="file" id="fotoProfilo" name="fotoProfilo" accept="image/*" class="custom-file-input">
            </div>

            <div class="wrapper">
                <input type="submit" name="update" value="Aggiorna Dati" onclick="window.parent.postMessage('operationComplete', '*')">
            </div>
<!-- onclick="window.parent.postMessage('closeIframe', '*')" -->
            <div class="wrapper">
                <input type="button" name="close" value="Chiudi" onclick="window.parent.postMessage('closeIframe', '*')">
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
        const MAX_FILE_SIZE = 1 * 1024 * 1024; // 1MB per InfinityFree

        // Riferimenti agli elementi del DOM
        const fotoProfiloInput = document.getElementById('fotoProfilo');
        const immagineAnteprima = document.getElementById('immagineAnteprima');
        const anteprimaDiv = document.getElementById('anteprimaFoto');
        const imgCorrente = document.getElementById('current');

        // Funzione per gestire il file selezionato
        function handleFile(file) {
            if (!file) return;

            if (file.size > MAX_FILE_SIZE) {
                // Invece di alert, usiamo una notifica più discreta se possibile, 
                // o manteniamo alert se è un errore bloccante critico.
                alert('Il file supera la dimensione massima consentita di 1 MB per InfinityFree.');
                fotoProfiloInput.value = ""; // Reset input
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                immagineAnteprima.src = e.target.result;
                anteprimaDiv.style.display = "block";
                imgCorrente.style.display = "none";
            };
            reader.readAsDataURL(file);
        }

        // Gestione del cambio di file
        fotoProfiloInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                handleFile(file);
            } else {
                anteprimaDiv.style.display = "none";
                imgCorrente.style.display = "block";
            }
        });
    </script>


</body>


</html>
<?php


unset($_SESSION['errore']);
mysqli_close($db);


?>