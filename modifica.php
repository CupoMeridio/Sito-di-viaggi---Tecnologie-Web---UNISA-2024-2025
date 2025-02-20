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

if (isset($_POST['update'])) {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $img = $_SESSION['img'];
   

    // Gestione dell'upload della nuova immagine del profilo
    if ($_FILES['fotoProfilo']['tmp_name'] != null) {
        $img_tmp = $_FILES['fotoProfilo']['tmp_name'];
        $type = $_FILES['fotoProfilo']['type'];
        $bin = file_get_contents($img_tmp);
        $img = pg_escape_bytea($bin);
    }

    // Query per aggiornare i dati dell'utente
    $query = "UPDATE utente SET nome = $1, cognome = $2, username = $3, email = $4, img = $5, type = $6 WHERE email = $7";
    $result = pg_prepare($db, "update_user", $query);
    $values = array($nome, $cognome, $username, $email, $img, $type, $_SESSION['email']);

    $result = pg_execute($db, "update_user", $values);

    if ($result) {
        $_SESSION['nome'] = $nome;
        $_SESSION['cognome'] = $cognome;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['img'] = $img;

        header("Location: index.php");
        exit();
    } else {
        $_SESSION['errore'] = "Errore durante l'aggiornamento dei dati.";
        header("Location: modifica.php");
        exit();
    }

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
</head>

<body>
    <?php include 'commons/navbar.php'; ?>

    
    <div id="modifica">
    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <h2>Modifica Dati</h2>
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome ?>" required>

        <label>Cognome:</label>
        <input type="text" name="cognome" value="<?php echo $cognome ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $email ?>" required>

        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $username ?>" required>

        <label>Foto Profilo:</label>
        <input type="file" name="fotoProfilo" accept="image/*">
        <img src="<?php echo $img; ?>" alt="Foto Profilo" width="100">

        <input type="submit" name="update" value="Aggiorna Dati">
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