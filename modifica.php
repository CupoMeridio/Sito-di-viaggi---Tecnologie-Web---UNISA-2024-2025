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




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica dati</title>
    <link rel="stylesheet" href="registrazioneStyle.css">
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
    <form action="" method="post" enctype="multipart/form-data">
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
    if (isset($_SESSION['errore'])) {
        echo "<p style='color: red;'>{$_SESSION['errore']}</p>";
        unset($_SESSION['errore']);
    }
    if (isset($_SESSION['auth'])) {
        echo "<p style='color: green;'>{$_SESSION['auth']}</p>";
        unset($_SESSION['auth']);
    }
    ?>
</body>

</html>