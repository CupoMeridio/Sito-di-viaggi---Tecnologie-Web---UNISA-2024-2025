<nav id="navbar">
    <a href="index.php"><img src="immagini/logo.png"></a>
    <a class="navButton" id="homeButton" href="index.php">Home</a>
    <a class="navButton" id="aboutButton"href="index.php#about-section">About</a>
    <a class="navButton" id="contactButton" href="index.php#contact-section">Contact</a>
    
    <?php if(!isset($email)){?>
    <a class="navButton" id="registrazioneButton" href="registrazione.php">Registrati</a>
    <a class="navButton" id="accessoButton" href="registrazione.php?login">Accedi</a>
    <?php }?>
    
    <?php if(isset($email)){?>
    <!-- Sezione profilo utente -->
    <div id="userProfile">
        <span id="welcomeMessage"><?php  echo "Ciao, $username";?> </span>
         <?php echo '<img id="profilePic" src="'.$img.'">'; ?>
        
    </div>
    <?php }?>
    
  </nav>