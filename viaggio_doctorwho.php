<?php
  session_start();
  if(isset($_SESSION['img']))
    $img=$_SESSION['img'];
  if(isset($_SESSION['username']))
    $username=$_SESSION['username'];
  if(isset($_SESSION['email']))
    $email=$_SESSION['email'];
  //DEVO SETTARE IL MONDO
  $_SESSION['mondo']='doctor_who';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">                                                                            <!-- Definisce la codifica dei caratteri come UTF-8, per supportare caratteri speciali -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">                            <!-- Rende la pagina responsiva, adattandola alla larghezza dello schermo del dispositivo -->
  <title>Doctor who</title>                                                                         <!-- Imposta il titolo della pagina che apparirà nella scheda del browser -->
  <?php include("components/imposta_icona.html"); ?>
  <script src="js/utils.js" type="text/javascript" defer></script>
  <script src="js/animazioni_doctorwho.js" type="text/javascript" defer="true"></script>
  <script src="js/gestione_commenti.js" type="text/javascript" defer="true"></script>

  <script src="js/logica_mondi.js" type="text/javascript" defer></script>   
  <link rel="stylesheet" href="css/doctorwho.css">                                                      <!-- Collega il file CSS esterno per definire gli stili visivi della pagina -->
  <link rel="stylesheet" href="css/stile_footer.css">
  <link rel="stylesheet" href="css/stile_navbar.css">
  <link rel="stylesheet" href="css/stile_dashboard.css">
  <link rel="stylesheet" href="css/stile_header.css">
  <link rel="stylesheet" href="css/stile_overlay.css">
  <link rel="stylesheet" href="css/stile_storico_ordini.css">
  <link rel="stylesheet" href="css/popup.css">
  <?php include("components/imposta_icona.html"); ?>

  <script src="js/utils.js" type="text/javascript" defer></script>

  <script src="js/gestione_commenti.js" type="text/javascript" defer></script>

  <script src="js/integrazione_stripe.js" type="text/javascript" defer></script>
  <script src="https://js.stripe.com/v3/"></script>   

  
                   
</head>


<?php include("components/navbar.php"); ?>

<?php include("components/dashboard.html"); ?>

<header>
  <video src="video/doctorwho/doctorwho.mp4" class="headerVideo" id="background-video"
    alt="Doctor who background video" autoplay muted loop></video>
  <img class="headerImg" id="worldTitle" src="img/doctorwho/Doctor-Who-Logo.png" alt="Doctor who Title screen" style="margin-top: 10px; height: 200px;">
</header>


<div class="intermezzo fade">
      <img src="img/doctorwho/tardis_.gif" id="intermezzo-img">
</div>
<div class="slideshow-container">
  <div class="mySlides fade">
    <img src="img/doctorwho/gallifrey2.jpg" id="location1"> 
    <div class="captionText">Gallifrey</div>
  </div>

  <div class="mySlides fade">
    <img src="img/doctorwho/Skyro.png" id="location2">
    <div class="captionText">Skaro</div>
  </div>

  <div class="mySlides fade">
    <img src="img/doctorwho/castello.jpg" id="location3">
    <div class="captionText" style="width: fit-content;">Prigione del tempo</div>
  </div>

  <!--pulsanti <- e -> -->
  <a class="prev" onclick="changeSlide(-1)"> &nbsp;&#10094;&nbsp; </a>
  <a class="next" onclick="changeSlide(1)"> &nbsp;&#10095;&nbsp; </a>



  <!--pallini di scorrimento-->
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>

</div>
<div class="info_location">
  <div id="info_location1" class="clearfix">
    <h2>
       Scopri il pianeta di Gallyfeid
    </h2>
    <img class="float-left clear-right" src="img/doctorwho/citadel.jpg">
    <p>
    Gallifrey è un pianeta affascinante con una lunga storia e una cultura avanzata. <br>
    Situato nella costellazione di Kasterborous, è il decimo pianeta dal suo sole. <br>
    Questo mondo straordinario è famoso per la sua tecnologia avanzata e le sue enormi città coperte da cupole, 
    la più celebre delle quali è la capitale, chiamata anche Gallifrey o più comunemente Citadel.
    </p>
    <h2> Per chi è adatto questo viaggio ?</h2>
    <ul>
      <li>Tutti gli esseri viventi che amano tecnologie aliene avanzate:<br>
         Se sei affascinato dalle innovazioni tecnologiche e dalle culture aliene, Gallifrey è il posto perfetto per te.</li>
      <li>Coloro che non hanno paura del nuovo e del diverso:<br>
         Gallifrey è un mondo che sfida le convenzioni e offre esperienze uniche, adatte a chi è aperto a scoprire l'ignoto.</li>
    </ul>
  </div>
  <div class="clearfix" id="info_location2">
    <h2>
      Esplora Skaro: La terra dei Daleck! 🛸
    </h2>
    <p>
    Skaro è il pianeta natale della razza Dalek, uno degli antagonisti più noti di "Doctor Who".
    <br> È un mondo devastato dalla guerra e dalla distruzione, riflettendo la natura bellicosa dei suoi abitanti.

    </p>

    <h3>
      ✨Caratteristiche di Skaro:
    </h3>
    <img class="float-left clear-right" src="img/doctorwho/dalek-inside.jpg">
    <h4 class="clear-right">🟢 Aspetto:</h4>
    <p class="clear-right">
       La superficie di Skaro è caratterizzata da vasti deserti, pianure aride, e rovine di antiche città.
       Le zone di guerra radioattive e i crateri di esplosioni nucleari sono una presenza comune.
    </p>
    <h4 class="clear-right">🛕 Città:</h4>
    <p class="clear-right">
    La città più famosa di Skaro è la "Cittadella dei Dalek", un'area altamente fortificata e tecnologicamente avanzata dove risiedono i Dalek.<br> 
    È piena di torri minacciose e strutture metalliche.
    </p>

    <img class="float-right clear-left"
      src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b1/Dalek_%28Dr_Who%29.jpg/1200px-Dalek_%28Dr_Who%29.jpg"> 
    <h4 class="clear-left"> Storia:</h4>
    <p class="clear-left">
    Skaro ha una storia di conflitti continui, principalmente tra i Kaleds e i Thals, due razze originarie del pianeta.<br> 
    I Dalek sono il risultato delle mutazioni dei Kaleds causate dalla guerra nucleare.
    </p>
    <h4 class="clear-left">Ambiente:</h4>
    <p class="clear-left">
     L'ambiente di Skaro è inospitale per la maggior parte delle forme di vita.<br>
     La contaminazione radioattiva e le condizioni climatiche estreme rendono difficile la sopravvivenza.
    </p>

    <img class="float-left clear-right" src="img/doctorwho/dalek-skaro-asylum-2.jpg">
    <h4 class="clear-right"> Guerriglia per sopravvivere</h4>
    <p class="clear-right">
      Adatta a chi ama combattere per sopravvivere. La nosta socetà non si prenderà cura di voi. <br>
      Anche se i dalek sembrano degli aspirapolvere, <br> sono la cosa più cattiva che ci sia.
    </p>
  </div>
  <div class="clearfix show" id="info_location3" style="display: none;">
    <h2>
      Combatti per la tua sopravvivenza!
    </h2>
    <p>Il castello(simile a quello di Guardia Sanframondi) è un luogo di tortura progettato per interrogare il Dottore e scoprire la verità su un misterioso "ibrido". 
      Le sue pareti sono fatte di un minerale chiamato Azbantium, più duro del diamante, e il castello cambia continuamente forma, 
      rendendo la fuga quasi impossibile.
    </p>
    
    <img class="float-left clear-right" src="img/doctorwho/castello_doctor_who.jpg">
    <h3>
      🔥 Cosa ti aspetta in questa escaperoom?
    </h3>
    <p class="clear-right">Questo castello è un luogo enigmatico e pericoloso, <br>
    con stanze che si riconfigurano continuamente e una creatura velata chiamata "Il Velo" che ti insegurà implacabilmente.</p>
    <h4 class="clear-right"> Scappa, ragiona e impara a conoscerti</h4>
    <p class="clear-right">
     Non potrai uscire sfruttando una sola vita ma non preoccuparti verrai rigenerato ogni volta.<br>
      Lascia messaggi e indizzi al te del futuro prima di venir rigenerato e perdere la memoria.<br>
      Solo chi sa conoscersi puo sfuggire.
    </p>

    <img class="float-right clear-left" src="img/doctorwho/ilvelo.jpg">
    <h4 class="clear-left">Per chi è adatto?</h4>
    <p class="clear-left">
      Consigliamo l' esperienza a tutti, ma sono preferiti:
    </p>
    <ul> 
     <li>Tutte le persone e alieni che vogliono mettersi in gioco</li> 
     <li>Persone che vogliono sbarazzarsi di una partner scomodo</li>
      </ul>
  </div>
</div>
</div>


<!-- Sezione Prenotazione Viaggio -->
<div class="booking-section" style="clear:both">
  <h2>Prenota il Tuo Viaggio Fantastico!</h2>
  <div id="form-container"> <!-- Contenitore per il form -->
  <form id="booking-form" onsubmit="return calcolaprezzo(event)">
    <label for="tickets-count">Numero di Biglietti:</label>
    <input type="number" id="tickets-count" name="tickets-count" min="1" max="10" value="1" required tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>">

    <h3>Nominativi</h3>
    <div id="ticket-names-container">
      <label for="ticket-name-0">Nome Passeggero 1:</label>
      <input type="text" id="ticket-name-0" name="ticket-name-0" required placeholder="Nome Passeggero 1" tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>">
    </div>

    <label for="location">Scegli la Destinazione:</label>
    <select id="location" name="location" required tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>">
    <option value="Gallifrey">Gallifrey</option>
      <option value="Skaro">Skaro</option>
      <option value="Prigione_dei_signori_del_tempo">Prigione dei signori del tempo</option>
    </select>

    <label for="departure-date">Data di Partenza:</label>
    <input type="date" id="departure-date" name="departure-date" required min="" onchange="setMinReturnDate()" tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>">

    <label for="return-date">Data di Ritorno:</label>
    <input type="date" id="return-date" name="return-date" required min="" tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>">

    <label for="comments">Commenti Speciali:</label>
    <textarea id="comments" name="comments" rows="4"
      placeholder="Inserisci richieste particolari o commenti" tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>"></textarea>

    <?php if(isset($email)){ ?>
    <input type="submit" id="submit-form-button"  value="Prenota il tuo viaggio!" tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>">
    <?php }else{ ?> 
      <input type="button" id="submit-form-button"  value="Registrati o accedi per prenotare il tuo viaggio!" tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>">
      <?php } ?>
  </form>
  <?php if(!isset($email)){ ?>
  <div id="form-overlay" class="form-overlay">
    <div class="overlay-message">Registrati o accedi per prenotare il tuo viaggio!</div>
  </div>
  <?php } ?>
  </div>
</div>


<script>
  // Impostare la data minima per la partenza come la data corrente
  document.getElementById('departure-date').min = new Date().toLocaleDateString('en-CA');

  // Funzione per aggiornare la data minima di ritorno
  function setMinReturnDate() {
    const departureDate = document.getElementById('departure-date').value;
    document.getElementById('return-date').min = departureDate;
  }
</script>


<?php include("components/popup.html"); ?>

<!-- Sezione Recensioni -->
<div class="reviews-section" style="display: flex; justify-content: space-between">

  <!-- Colonna Visualizzazione Recensioni -->
  <?php include("components/recensioni.html"); ?>

  <!-- Colonna Aggiunta Recensione -->

  <div class="review-form" style="width: 50%;">
    <h2>Lascia una Recensione</h2>
    <!-- <form action="submit_review.php" method="post">-->
    <div id="form-container-review"> <!-- Contenitore per il form -->
    <form id="reviewForm" name="commenti">
      <label for="location">Seleziona la location:
        <select id="location_selection" name="location" onchange="updateReviewPlaceholder()" tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>"></label>
      <option value="Gallifrey">Gallifrey</option>
      <option value="Skaro">Skaro</option>
      <option value="Prigione_dei_signori_del_tempo">Prigione dei signori del tempo</option>
      </select>
      <br><br>

      <label for="rating">Valutazione (1-5 stelle):</label>
      <select id="rating" name="rating" tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>">
        <option value="1">1 ⭐</option>
        <option value="2">2 ⭐⭐</option>
        <option value="3">3 ⭐⭐⭐</option>
        <option value="4">4 ⭐⭐⭐⭐</option>
        <option value="5">5 ⭐⭐⭐⭐⭐</option>
      </select>
      <br><br>

      <label for="experience">La tua esperienza:</label><br>
      <textarea id="experience" name="experience" rows="4" cols="50" required
        placeholder="Scrivi la tua esperienza..." tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>"></textarea>
      <br><br>
      <?php if (isset($email)) { ?>
        <input type="button" value="Invia Recensione" onclick="InserisciCommento()" style="background-color: #4CAF50; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; font-size: 12px;" tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>">
      <?php } else { ?>
        <input type="button" value="Registrati o accedi per inviare una recensione" tabindex="<?php echo !isset($email) ? '-1' : '0'; ?>">
      <?php } ?>
    </form>
    <?php if(!isset($email)){ ?>
      <div id="form-overlay-review" class="form-overlay">
        <div class="overlay-message">Registrati o accedi per scrivere una recensione!</div>
      </div>
      <?php } ?>
    </div>
  </div>

</div>

<?php include("components/footer.html"); ?>
</body>

</html>

</html>