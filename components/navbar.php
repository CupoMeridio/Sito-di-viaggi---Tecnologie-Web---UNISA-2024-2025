<nav id="navbar">
    <a href="index.php"><img src="img/common/logo.png"></a>
    <a class="navButton" id="homeButton" href="index.php">Home</a>
    <a class="navButton" id="aboutButton"href="index.php#about-section">About</a>
    <a class="navButton" id="contactButton" href="index.php#contact-section">Contact</a>

    <?php if(!isset($email)){?>
    <div id="navAuth">
        <a class="navButton" id="registrazioneButton" href="autenticazione.php">Registrati</a>
        <a class="navButton" id="accessoButton" href="autenticazione.php?login">Accedi</a>
    </div>
    <?php }?>
    
    <?php if(isset($email)){?>
    <!-- Sezione profilo utente -->
    <div id="userProfile">
        <span id="welcomeMessage"><?php  echo "Ciao, $username";?> </span>
         <?php echo '<img id="profilePic" src="'.$img.'">'; ?>
        
    </div>
    <?php }?>
    
  </nav>