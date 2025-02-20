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
    if(isset($img_up)){
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

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica dati</title>
    <link rel="stylesheet" href="modifica.css">
</head>

<body>
    <nav>
        <a href="index.php"><img src="immagini/logo.png"></a>
        <a class="navButton" id="homeButton" href="index.php">Home</a>
        <a class="navButton" id="aboutButton" href="index.php#about-section">About</a>
        <a class="navButton" id="contactButton" href="index.php#contact-section">Contact</a>

        <?php if (!isset($email)) { ?>
            <a class="navButton" id="registrazioneButton" href="registrazione.php">Registrati</a>
            <a class="navButton" id="accessoButton" href="registrazione.php?login">Accedi</a>
        <?php } ?>

        <?php if (isset($email)) { ?>
            <!-- Sezione profilo utente -->
            <div id="userProfile">
                <span id="welcomeMessage"><?php echo "Ciao, $username"; ?> </span>
                <?php echo '<img id="profilePic" src="' . $img . '">'; ?>
            </div>
        <?php } ?>
    </nav>
    <h2>Modifica Dati</h2>
    <div>
        <p id='email'>EMAIL: <?php echo $_SESSION['email'] ?></p>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome ?>" required>

        <label>Cognome:</label>
        <input type="text" name="cognome" value="<?php echo $cognome ?>" required>

        

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