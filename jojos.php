<?php
  session_start();
  if(isset($_SESSION['img']))
    $img=$_SESSION['img'];
  if(isset($_SESSION['username']))
    $username=$_SESSION['username'];
  if(isset($_SESSION['email']))
    $email=$_SESSION['email'];
  //DEVO SETTARE IL MONDO
  $_SESSION['mondo']='jojo';
?>
<!DOCTYPE html>
<html lang="it">                                                                                        <!-- Specifica il tipo di documento come HTML5 e imposta la lingua della pagina su italiano -->

<head>
    <meta charset="UTF-8">                                                                              <!-- Definisce la codifica dei caratteri come UTF-8, per supportare caratteri speciali -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">                              <!-- Rende la pagina responsiva, adattandola alla larghezza dello schermo del dispositivo -->
    <title>JoJo's Bizarre Adventure</title>                                                                          <!-- Imposta il titolo della pagina che apparirà nella scheda del browser -->
    <link rel="stylesheet" href="jojos.css">                                                  <!-- Collega il file CSS esterno per definire gli stili visivi della pagina -->
    <link rel="stylesheet" href="commons/navbarStyle.css">
    <link rel="stylesheet" href="commons/headerStyle.css">
    <link rel="stylesheet" href="commons/footerStyle.css">
    <link rel="stylesheet" href="commons/dashboardStyle.css">
    <link rel="stylesheet" href="commons/overlayblockStyle.css">
    <link rel="stylesheet" href="commons/storicoOrdiniStyle.css">
    <link rel="stylesheet" href="commons/popup.css">
    <?php include("commons/setIcon.html"); ?>
    <script src="commons/mondo_javascript.js" type="text/javascript" defer></script>                            <!-- Collegamento al file JavaScript esterno per la logica di validazione o interattività -->
    <script src="commenti.js" type="text/javascript" defer></script>
    <script src="stripe/stripe.js" type="text/javascript" defer></script>
    <script src="https://js.stripe.com/v3/"></script>
  
  </head>

<body>                                                                                                  <!-- Corpo del documento, dove vengono definiti i contenuti visibili sulla pagina -->
   <?php include 'commons/navbar.php'; ?>
  
   <?php include 'commons/dashboard.html'; ?>
  

    
  <header>
    <video src="video/jojo/jojovideo.mp4" class="headerVideo" id="background-video" alt="Jojo background video" autoplay muted loop></video>
    <img class="headerImg" id="worldTitle" src="immagini/jojostitle.png" alt="Dragon Ball Title screen">
  </header>
  
  <div class="container" id="container">
    <h2>Esplora le più belle location del mondo di JoJo's bizarre adventure: Vento Aureo</h2>
    <div class="locations_selector"id="locations_selector">
      <div class="location" id="location1">
        <img src="immagini/rome.jpg">
         <div class="location-name">Roma</div>
      </div>
      <div class="location" id="location2">
        <img src="immagini/venice.png">
         <div class="location-name">Venezia</div>
      </div>
      <div class="location" id="location3">
        <img src="immagini/naples.jpg">
         <div class="location-name">Napoli</div>
      </div>
    </div>
    <div class="info_location">
      <div id="info_location1" class="clearfix">
        <h2>
         🐺 Scopri la magica Roma di JoJo’s Bizarre Adventure 🌟
        </h2>
        <p>
        🏛️Benvenuti a Roma, il cuore pulsante d’Italia e uno dei luoghi più iconici di JoJo’s Bizarre Adventure: Vento Aureo!<br>
        Qui, tra antiche rovine e vicoli pieni di fascino, si intrecciano le avventure di Giorno Giovanna e i suoi amici, in una battaglia per il destino dell'Itala intera.
        </p>
        <h3>Cosa ti aspetta nella Roma di Vento Aureo?</h3>
        <img class="float-left clear-right" src="https://static.jojowiki.com/images/thumb/5/50/latest/20200131204642/Rome_fontaine_de_tritone.png/197px-Rome_fontaine_de_tritone.png">

        <h4 class="clear-right">🫧 L’Incontro del Destino: Joseph Joestar e Caesar Antonio Zeppeli</h4>
        <p class="clear-right">
        Nel cuore di Roma, prima delle avventure di Vento Aureo, tra gli antichi palazzi, Joseph Joestar incontra il suo futuro alleato Caesar Zeppeli.
        È proprio qui, davanti la fontana del Tritone, che il loro pungente primo incontro avviene.
        </p>
        <h4 class="clear-right">🏛️Una città tutta da scoprire</h4>
        <p class="clear-right">
          Se ami l’avventura, il dramma e lo stile unico della serie,
          preparati a immergerti in una capitale ricca di emozioni!
        </p>

        
        <img class="float-right clear-left" src="https://static.jojowiki.com/images/thumb/a/a1/latest/20200130220947/Colosseum_manga.png/400px-Colosseum_manga.png">
        <h4 class="clear-left"> Il Colosseo: Arena di Duelli Epici 🏹</h4>
          <p class="clear-left">
          Il simbolo di Roma diventa teatro di una delle battaglie più leggendarie di JoJo! <br>
          Qui, Jean Pierre Polnareff svela i segreti di Requiem, mentre Diavolo scatena il caos con King Crimson!
        </p>
          <h4 class="clear-left"> Incontra Jean Pierre Polnareff 🐢🗡</h4>
          <p class="clear-left">
          Preparati a incontrare Jean Pierre Polnareff, il cavaliere francese dallo spirito indomito.<br>
          Ascolta le storie delle sue esperienze, i suoi combattimenti epici e, ovviamente, qualche battuta sopra le righe!
          </p>

          <img class="float-left clear-right" src="https://i.ytimg.com/vi/mZaJAkD2-FU/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLAlGYRGlPMEqYfcjhy940v1XplSNg">
          <h4 class="clear-right">⚔ Il luogo della Epica Battaglia</h4>
          <p class="clear-right">
            Visita il luogo dello scontro con Cioccolata e Secco, i due assassini spietati al servizio di Diavolo!<br>
            Con l’infernale Stand Green Day, Cioccolata trasforma Roma in un inferno in discesa, mentre Secco si muove con agilità sotterranea grazie a Oasis.
          </p>
          <h4 style="clear-right">📖 Racconti di Eroi e Villain</h4>
          <p style="clear-right">
          Roma è una città di leggende, e JoJo’s Bizarre Adventure l’ha resa ancora più epica! Rivivi le storie di Caesar, Joseph, Giorno e Bruno
          mentre cammini tra i monumenti, e immagina di far parte anche tu di questa incredibile avventura!
          </p>

      </div>
      <div class="clearfix" id="info_location2">
        <h2>
          🛶 Esplora la misteriosa Venezia di JoJo’s Bizarre Adventure 🌊
        </h2>
        <p>
        Benvenuti a Venezia, la città sull’acqua, intrisa di mistero e teatro di alcuni degli scontri più emozionanti di JoJo’s Bizarre Adventure: Vento Aureo!<br>
        Attraversando i suoi canali e i vicoli nascosti, potrai rivivere le gesta di Giorno Giovanna e dei suoi compagni, immerso in un’atmosfera unica e carica di tensione.  
        </p>
        
        <h3>
          ✨ Cosa ti aspetta a Venezia?
        </h3>
        <img class="float-left clear-right" src="https://64.media.tumblr.com/8851522b46f7d11283ddf75cf2039dcb/tumblr_pbxnpr7WID1wxbjq5o1_1280.jpg">
        <h4 class="clear-right"> Lisa Lisa e l’addestramento segreto 🩸</h4>
        <p class="clear-right">
        Prima di Vento Aureo, un'altra eroina di JoJo ha calcato le calli veneziane!<br>
        Lisa Lisa, la maestra di Onde Concentriche, ha vissuto qui in segreto mentre preparava Joseph Joestar e Caesar Zeppeli alla battaglia contro i temibili Uomini del Pilastro.
        </p>
        <h4 class="clear-right"> Un luogo pieno di pericoli nascosti 🌊</h4>
        <p class="clear-right">
        Venezia non è solo una città romantica: è un labirinto perfetto per imboscate e battaglie all’ultimo respiro!<br>
        Proprio qui, nel cuore della città, la Squadra Esecuzioni della Passione ha dato la caccia a Bucciarati e ai suoi uomini.  
        </p>
        
        <img class="float-right clear-left" src="immagini/gondola.png">
        <h4 class="clear-left">❄ Ghiaccio: Il terrore gelido tra i canali </h4>
        <p class="clear-left">
        Uno degli scontri più brutali della serie avviene proprio qui!<br>
        Ghiaccio, con il suo terrificante Stand White Album, trasforma Venezia in un deserto glaciale, mentre Mista e Giorno lottano disperatamente per sopravvivere.
        </p>
        <h4 class="clear-left">🚣‍♂️ In gondola verso la chiesa di San Giorgio </h4>
        <p class="clear-left">
        Raggiungere la chiesa di San Giorgio in gondola, scivolando silenziosamente tra i canali veneziani, aumenta la tensione dell’incontro con Diavolo.<br>
        Le acque scure riflettono le luci tremolanti della città, mentre il suono ritmico dei remi si mescola con il battito accelerato del cuore.
        </p>
        
        <img class="float-left clear-right" src="immagini/sangiorgio.png">
        <h4 class="clear-right"> Il primo incontro con Diavolo 🎭</h4>
        <p class="clear-right">
        Nel cuore di Venezia, tra le antiche mura della chiesa di San Giorgio, si consuma un momento cruciale di Vento Aureo: il primo scontro con il misterioso Boss di Passione!
        Bruno Bucciarati si trova faccia a faccia con il pericoloso criminale, scoprendo troppo tardi l’orrore di King Crimson e le abilità del suo stand.  
        </p>
      </div>
      <div class="clearfix" id="info_location3">
        <h2>
           Perditi nella bellissima Napoli 
        </h2>
        <p>
        Benvenuti a Napoli, una città intrisa di storia e cultura, che diventa il primo palcoscenico di JoJo's Bizarre Adventure: Vento Aureo.  
        </p>
        <h3>
          Cosa ti aspetta a Napoli?
        </h3>
        <img class="float-left clear-right" src="immagini/metro.png">
        <h4 class="clear-right">Koichi e l’aeroporto di Napoli 🛫</h4>
        <p class="clear-right">
        Uno degli incontri più intriganti della saga si svolge proprio qui, dove atterrerete: all’aeroporto di Napoli!<br>
        È proprio qui che Koichi Hirose, uno dei protagonisti delle avventure precedenti, incontra per la prima volta il nuovo protagonista Giorno Giovanna!
        </p>
        <h4 class="clear-right">Un incontro fatale in metro🚇</h4>
        <p class="clear-right">
          Scopri gli efficienti mezzi di trasporto che collegano tutta la città di Napoli.<br>
          È proprio la metro il luogo di incontro tra il protagonista Gionro Giovanna e quello che sarà uno dei suoi migliori amici, Bruno Bucciarati.
        </p>
        
        <img class="float-right clear-left" src="immagini/capri.png">
        <h4 class="clear-left">⛵ Salpa verso l'isola di Capri</h4>
        <p class="clear-left">
          Da Napoli potrai salpare verso l'isola di Capri, tre le acque cristalline e le rocce mozzafiato!<br>
          È proprio qui che i nostri protagonisti trovano il tesoro di Polpo, uno dei capi di Passione, che finanzia il loro viaggio verso le altre città d'Italia.
        </p>
        <h4 class="clear-left">🏹 Ottieni il tuo stand visitando Polpo</h4>
        <p class="clear-left">
          Come Giorno Giovanna, fai visita a Polpo e ottieni anche tu il tuo potere stand<br>
          O magari no. Pensa ai pericoli che dovrai affrontare prima di arrivare ad un capo di una gang...😨
        </p>
        
        <img class="float-left clear-right" src="immagini/vedinapoli.png">
        <h4 class="clear-right">Esplora la città 🌇</h4>
        <p class="clear-right">
          Per finire, Napoli è una città che affascina con la sua storia, la sua cultura vibrante e i panorami mozzafiato. <br>
          Come recita il famoso detto, e come ci ricorda anche il narratore: <br>"Vedi Napoli e poi muori"<br> Ogni angolo della città offre emozioni uniche che ti rimarranno nel cuore per sempre. 
        </p>
      </div>
    </div>
  </div>

<!-- Sezione Prenotazione Viaggio -->
<div class="booking-section" style="clear:both">
  <h2>Prenota il Tuo Viaggio Fantastico!</h2>
  <div id="form-container"> <!-- Contenitore per il form -->
  <form id="booking-form" onsubmit="return calcolaprezzo(event)">
    <label for="tickets-count">Numero di Biglietti:</label>
    <input type="number" id="tickets-count" name="tickets-count" min="1" max="10" value="1" required>
    
    <h3>Nominativi</h3>
    <div id="ticket-names-container">
      <label for="ticket-name-0">Nome Passeggero 1:</label>
      <input type="text" id="ticket-name-0" name="ticket-name-0" required placeholder="Nome Passeggero 1">
    </div>
    
    <label for="location">Scegli la Destinazione:</label>
    <select id="location" name="location" required>
      <option value="kame_house">Roma</option>
      <option value="namecc">Venezia</option>
      <option value="king_kai">Napoli</option>
    </select>
    
    <label for="departure-date">Data di Partenza:</label>
    <input type="date" id="departure-date" name="departure-date" required min="" onchange="setMinReturnDate()">
    
    <label for="return-date">Data di Ritorno:</label>
    <input type="date" id="return-date" name="return-date" required min="">
    
    <label for="comments">Commenti Speciali:</label>
    <textarea id="comments" name="comments" rows="4" placeholder="Inserisci richieste particolari o commenti"></textarea>
    
    <?php if(isset($email)){ ?>
    <input type="submit" id="submit-form-button"  value="Prenota il tuo viaggio!">
    <?php }else{ ?> 
      <input type="button" id="submit-form-button"  value="Registrati o accedi per prenotare il tuo viaggio!">
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

  <?php include("commons/popup.html"); ?>

<!-- Sezione Recensioni -->
<div class="reviews-section" style="display: flex; justify-content: space-between">
  
  <!-- Colonna Visualizzazione Recensioni -->
  <?php include("commons/recensioni.html"); ?>
  
  <!-- Colonna Aggiunta Recensione -->
  <div class="review-form" style="width: 50%;">
    <h2>Lascia una Recensione</h2>
    <!-- <form action="submit_review.php" method="post">-->
      <div id="form-container-review"> <!-- Contenitore per il form -->
      <form id="reviewForm" name="commenti">
        <label for="location">Seleziona la location:
        <select id="location_selection" name="location" onchange="updateReviewPlaceholder()"></label>
            <option value="napoli">Napoli</option>
            <option value="venezia">Venezia</option>
            <option value="roma">Roma</option>
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
        <?php if(isset($email)){ ?> 
        <input type="button" value="Invia Recensione" onclick="InserisciCommento()" style="background-color: #4CAF50; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; font-size: 12px;">
        <?php }else{ ?> 
        <input type="button" value="Registrati o accedi per inviare una recensione" >
        <?php  }?>
      </form>
      <?php if(!isset($email)){ ?>
      <div id="form-overlay-review" class="form-overlay">
        <div class="overlay-message">Registrati o accedi per scrivere una recensione!</div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

  
  <?php include("commons/footer.html"); ?>
</body>
</html>
