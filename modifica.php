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
    if(isset($img_up) && $img_up != null){
        $query = "UPDATE utente SET nome = $1, cognome = $2, username = $3, img = $4, type = $5 WHERE email = $6";
        $result = pg_prepare($db, "update_user", $query);
        $values = array($nome, $cognome, $username, $img_up, $type, $_SESSION['email']);
    }else{
        $query = "UPDATE utente SET nome = $1, cognome = $2, username = $3 WHERE email = $4";
        $result = pg_prepare($db, "update_user", $query);
        $values = array($nome, $cognome, $username, $_SESSION['email']);

    }

    $result = pg_execute($db, "update_user", $values);

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['errore'] = "Errore durante l'aggiornamento dei dati.";
        header("Location: modifica.php");
        exit();
    }

    unset($img_up);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica dati</title>                                                  <!-- Collega il file CSS esterno per definire gli stili visivi della pagina -->
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
        <div class="wrapper"><img src="<?php echo $img; ?>" alt="Foto Profilo" width="100"></div>
        
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome ?>" required>

        <label>Cognome:</label>
        <input type="text" name="cognome" value="<?php echo $cognome ?>" required>

        

        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $username ?>" required>

        <label>Foto Profilo:</label>
        <input type="file" name="fotoProfilo" accept="image/*">

        <div class="wrapper"><input type="submit" name="update" value="Aggiorna Dati"></div>
    </form>
    <?php 
    if(isset($_SESSION['errore'])){
    ?>
    <p><?php echo $_SESSION['errore'];?></p>
    <?php } ?>

    </div>
</body>

</html>
<?php


unset($_SESSION['errore']); 
pg_close();
?>