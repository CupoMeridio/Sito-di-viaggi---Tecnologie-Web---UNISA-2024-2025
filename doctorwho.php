<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">                                                                              <!-- Definisce la codifica dei caratteri come UTF-8, per supportare caratteri speciali -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">                              <!-- Rende la pagina responsiva, adattandola alla larghezza dello schermo del dispositivo -->
    <title>Doctor who</title>                                                                          <!-- Imposta il titolo della pagina che apparirà nella scheda del browser -->                                                
      
    <script src="mondo_javascript.js" type="text/javascript" defer="true"></script>                    <!-- Collegamento al file JavaScript esterno per la logica di validazione o interattività -->
    <script src="commenti.js" type="text/javascript" defer="true"></script>
    <link rel="stylesheet" href="doctorwho.css">                                                       <!-- Collega il file CSS esterno per definire gli stili visivi della pagina -->
</head>
<body onload="cambio_luogo()">
    <nav>
        <a href="index.html"><img src="immagini/logo.png"></a>
        <a class="navButton" id="homeButton" href="index.html">Home</a>
        <a class="navButton" id="aboutButton"href="index.html#about-section">About</a>
        <a class="navButton" id="contactButton" href="index.html#contact-section">Contact</a>
        
        <?php if(!isset($email)){?>
        <a class="navButton" id="registrazioneButton" href="registrazione.php">Registrati</a>
        <a class="navButton" id="accessoButton" href="registrazione.php?login">Accedi</a>
        <?php }?>
        
        <?php if(isset($email)){?>
        <!-- Sezione profilo utente -->
        <div id="userProfile">
            <span id="welcomeMessage"><?php echo "Ciao, $nomeutente";?> </span>  
             <?php echo '<img id="profilePic" src="'.$img.'">'; ?>
            
        </div>
        <?php }?>
        
      </nav>
    <header>
    <video src="video/doctorwho/doctorwho.mp4" class="headerVideo" id="background-video" alt="Dragon Ball background video" autoplay muted loop></video>
    <img class="headerImg" id="worldTitle" src="immagini/Doctor-Who-Logo.png" alt="Dragon Ball Title screen">
  </header>


    <div class="presentazione"> 
       
        <div class="colonne immagini ">
            <audio id="myAudio" src="tardis.mp3"></audio>
            <img id="porta" src="immagini/s-l400.jpg">
            <img id='img1' src="https://ichef.bbci.co.uk/images/ic/976xn/p03b20k9.jpg">
            <img id='img2' src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEi637lJLBGHhPjoCu-dDoH6Gy40li81QyxWbm4wU3Ni5mCCGlxMPqRoAFuX1eIKhJKiiw16GDyHXx2AWJdEB7zD5qhOVTaUW5Vk17XZZU3d2NR9V-tXjvowoApm9SOJrKWQMKXg-XCXlSA/s1600/13152669_927233087375833_925574505_n.jpg">
            <img id='img3' src="https://i0.wp.com/www.blogtorwho.com/wp-content/uploads/2020/12/Daleks-Day-of-Reckoning-5.png?fit=1534%2C921&ssl=1">
        </div>
        
    </div>
    <div id="text1" class="text">testo 1 Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque similique est consequatur laborum autem neque placeat dolorem. Temporibus sed voluptas nostrum deserunt. Sapiente, corporis labore. Doloremque provident natus quae aliquid?</div>
    <div id="text2" class="text">testo2 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae delectus dolorum earum fugiat hic itaque ipsam tempore officia expedita adipisci. Molestiae ullam, animi veniam facere illum fugiat alias non iusto!</div>
    <div id="text1"class="text">testo3 Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum dignissimos libero pariatur at ratione vitae alias esse, possimus ipsam totam atque facilis consectetur odit cumque, rem inventore magnam molestias? Voluptate.</div>
<!-- Sezione Recensioni -->
<div class="reviews-section" style="display: flex; justify-content: space-between">
  
  <!-- Colonna Visualizzazione Recensioni -->
  <div class="reviews-display" style="width: 50%;">
    <h2>Recensioni dei Viaggiatori</h2>
    <div id="reviews-container" style="border: 1px solid; margin: 10px; padding: 10px">
      <p>Nessuna recensione disponibile. Sii il primo a lasciare un commento!</p>
    </div>
  </div>
  
  <!-- Colonna Aggiunta Recensione -->
  <div class="review-form" style="width: 50%;">
    <h2>Lascia una Recensione</h2>
    <!-- <form action="submit_review.php" method="post">-->
      <form id="reviewForm" name="commenti">
        <label for="location">Seleziona la location:
        <select id="location" name="location" onchange="updateReviewPlaceholder()"></label>
            <option value="kamehouse">Kame House</option>
            <option value="namecc">Namecc</option>
            <option value="kingkaiplanet">King Kai Planet</option>
        </select>
        <br><br>
        
        <label for="rating">Valutazione (1-5 stelle):</label>
        <select id="rating" name="rating">
            <option value="1">1 ⭐</option>
            <option value="2">2 ⭐⭐</option>
            <option value="3">3 ⭐⭐⭐</option>
            <option value="4">4 ⭐⭐⭐⭐</option>
            <option value="5">5 ⭐⭐⭐⭐⭐</option>
        </select>
        <br><br>
        
        <label for="experience">La tua esperienza:</label><br>
        <textarea id="experience" name="experience" rows="4" cols="50" required placeholder="Scrivi la tua esperienza..."></textarea>
        <br><br>
        
        <input type="button" value="Invia Recensione" onclick="InserisciCommento()">
    </form>
  </div>
</div>


<!-- Sezione Prenotazione Viaggio -->
<div class="booking-section" style="clear:both">
  <h2>Prenota il Tuo Viaggio Fantastico!</h2>
  <form id="booking-form" action="#" method="POST">
    <label for="tickets-count">Numero di Biglietti:</label>
    <input type="number" id="tickets-count" name="tickets-count" min="1" value="1" required>
    
    <h3>Nominativi</h3>
    <div id="ticket-names-container">
      <label for="ticket-name-0">Nome Passeggero 1:</label>
      <input type="text" id="ticket-name-0" name="ticket-name-0" required placeholder="Nome Passeggero 1">
    </div>
    
    <label for="location">Scegli la Destinazione:</label>
    <select id="location" name="location" required>
      <option value="kame_house">Kame House</option>
      <option value="namecc">Namecc</option>
      <option value="king_kai">Pianeta di King Kai</option>
    </select>
    
    <label for="departure-date">Data di Partenza:</label>
    <input type="date" id="departure-date" name="departure-date" required>
    
    <label for="return-date">Data di Ritorno:</label>
    <input type="date" id="return-date" name="return-date" required>
    
    <label for="comments">Commenti Speciali:</label>
    <textarea id="comments" name="comments" rows="4" placeholder="Inserisci richieste particolari o commenti"></textarea>
    
    <button type="submit" id="submit-button">Prenota il Tuo Viaggio</button>
  </form>
</div>
    <footer>
    <div class="footer-content">
        <p>&copy; 2025 BeyondReality Journeys | Tutti i diritti riservati.</p>
        <p class="disclaimer">
            🚨 <strong>Disclaimer:</strong> Questo sito non è un reale sito di viaggi, ma è un progetto creato per l'esame di <strong>Tecnologie Web</strong> dell'Università degli Studi di Salerno (UNISA) per l'anno accademico 2024/2025. <br>
            Tutti i contenuti sono puramente fittizi.
        </p>
    </div>    
</footer>
</body>

<script type="text/javascript">
    var audio = document.getElementById('myAudio');
    var cont_img = document.getElementsByClassName('immagini');
    var testo= document.getElementsByClassName('text');
    var numero_img_mostrare=1;
    var numero_text_mostrare=0;

    for (let i = 0; i < cont_img.length; i++) {
        var img_luoghi = cont_img[i].getElementsByTagName("img");
    }
    img_luoghi[0].addEventListener('animationstart', () => { audio.play(); });
    for (let i = 0; i <img_luoghi.length; i++) {
        img_luoghi[i].addEventListener("click",transizione);
    }

    function cambio_luogo(){
        console.log(cont_img.length); 
        console.log(img_luoghi.length);
        console.log(numero_img_mostrare);
        console.log("testo" +testo.length);
    if(img_luoghi.length<1){
        numero_img_mostrare= img_luoghi.length-1;
        console.log("entrato 1 "+ numero_img_mostrare);
    }
    if(numero_img_mostrare > img_luoghi.length-1){
        numero_img_mostrare=1;
        console.log("entrato 2 "+ numero_img_mostrare);
    }

    for (let i = 0; i < img_luoghi.length ; i++) {
        img_luoghi[i].style.setProperty("display", "none", "");
    }
    for(let i=0; i< testo.length;i++){
        testo[i].style.setProperty("dislpay","none",);
    }
        img_luoghi[numero_img_mostrare].style.setProperty("display", "block", "");
        testo[numero_text_mostrare].style.setProperty("display", "block", "");
        
        numero_text_mostrare++;
        numero_img_mostrare++;
    }
    function transizione(){
        for (let i = 0; i < img_luoghi.length ; i++) {
        img_luoghi[i].style.setProperty("display", "none", "");
        
    }
      for(let i=0; i< testo.length;i++){
        testo[i].style.setProperty("dislpay","none");
      }
        img_luoghi[0].style.setProperty("display", "block", "");
        setTimeout(cambio_luogo, 4000);
    }
</script>
</html>