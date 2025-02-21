<?php
  session_start();
  if(isset($_SESSION['img']))
    $img=$_SESSION['img'];
  if(isset($_SESSION['username']))
    $username=$_SESSION['username'];
  if(isset($_SESSION['email']))
    $email=$_SESSION['email'];
  //DEVO SETTARE IL MONDO
  $_SESSION['mondo']='dragon_ball';
?>

<!DOCTYPE html>
<html lang="it">                                                                                        <!-- Specifica il tipo di documento come HTML5 e imposta la lingua della pagina su italiano -->

<head>
    <meta charset="UTF-8">                                                                              <!-- Definisce la codifica dei caratteri come UTF-8, per supportare caratteri speciali -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">                              <!-- Rende la pagina responsiva, adattandola alla larghezza dello schermo del dispositivo -->
    <title>Dragon Ball</title>                                                                          <!-- Imposta il titolo della pagina che apparirà nella scheda del browser -->
    <link rel="stylesheet" href="DragonBallStyle.css">                                                  <!-- Collega il file CSS esterno per definire gli stili visivi della pagina -->
    <link rel="stylesheet" href="commons/footerStyle.css">
    <link rel="stylesheet" href="commons/navbarStyle.css">
    <link rel="stylesheet" href="commons/dashboardStyle.css">
    <link rel="stylesheet" href="commons/headerStyle.css">
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
  <?php include("commons/navbar.php"); ?>
  
  <?php include("commons/dashboard.html"); ?>
    
  <header>
    <video src="video/Dragon_Ball/video1.mp4" class="headerVideo" id="background-video" alt="Dragon Ball background video" autoplay muted loop></video>
    <img class="headerImg" id="worldTitle" src="immagini/DragonBall/dragonballtitleheader.png" alt="Dragon Ball Title screen">
  </header>
  
  <div class="container" id="container">
    <h2>Esplora le più belle location del mondo di Dragon Ball!</h2>
    <div class="locations_selector"id="locations_selector">
      <div class="location" id="location1">
        <img src="immagini/DragonBall/kamehouse_.jpg">
         <div class="location-name">Kame House</div>
      </div>
      <div class="location" id="location2">
        <img src="immagini/DragonBall/Namek.png">
         <div class="location-name">Namecc</div>
      </div>
      <div class="location" id="location3">
        <img src="immagini/DragonBall/KingKaisPlanetNV.png">
         <div class="location-name">Pianeta di King Kai</div>
      </div>
    </div>
    <div class="info_location">
      <div id="info_location1" class="clearfix">
        <h2>
          🏝️ Scopri la Kame House: Paradiso Tropicale del Maestro Muten! 🐢🌊
        </h2>
        <p>
          🌴 Benvenuti alla Kame House, la leggendaria isoletta tropicale dove il tempo sembra fermarsi e l’avventura è sempre dietro l’angolo!<br>
          Situata in mezzo a un oceano cristallino, questa destinazione è perfetta per chi desidera un mix di relax, allenamento e un pizzico di magia marziale!
        </p>
        <h3>🐢 Cosa ti aspetta alla Kame House?</h3>
        <img class="float-left clear-right" src="immagini/DragonBall/Dragon-Ball-Son-Goku-Bulma-Young-Bulma-Dragon-Ball-Z-group-of-people-2232722.jpg">

        <h4 class="clear-right">🌅 Un’Isola da Sogno</h4>
        <p class="clear-right">
          Circondata da acque turchesi e sabbie bianchissime, la Kame House è il luogo ideale per chi cerca tranquillità e un panorama mozzafiato.<br>
          Rilassati all’ombra delle palme e lasciati cullare dal suono delle onde.
        </p>
        <h4 class="clear-right">👓 Incontra il Maestro Muten</h4>
        <p class="clear-right">
          Preparati a conoscere il leggendario Maestro delle Tartarughe, Muten Roshi!<br>
          Partecipa alle sue esclusive sessioni di allenamento (e qualche storia strampalata!) per scoprire i segreti delle arti marziali più potenti dell’universo.
        </p>

        
        <img class="float-right clear-left" src="immagini/DragonBall/Krillin-Goku-training-Master-Roshi.jpg">
        <h4 class="clear-left">💪 Allenamenti sulla Spiaggia</h4>
          <p class="clear-left">
            Per i più temerari, la Kame House offre programmi di allenamento personalizzati.<br>
            Prova l’esperienza di allenarti con pesi giganteschi, corse sulla spiaggia e, se sei fortunato, qualche lezione speciale di Kamehameha direttamente dal Maestro!
          </p>
          <h4 class="clear-left">🌊 Attività Acquatiche Avventurose</h4>
          <p class="clear-left">
            Esplora le acque circostanti con sessioni di snorkeling e immersioni, alla scoperta di fauna marina incredibile e, chissà, magari anche qualche tesoro nascosto!
          </p>

          <img class="float-left clear-right" src="immagini/DragonBall/kamehousefood.jpg">
          <h4 class="clear-right">🥥 Cucina Esotica</h4>
          <p class="clear-right">
            Dopo una giornata di avventure, rilassati gustando specialità locali a base di cocco, pesce fresco e deliziosi piatti ispirati alle ricette segrete di Muten Roshi.
          </p>
          <h4 style="clear-right">📜 Storie e Leggende Epiche</h4>
          <p style="clear-right">
            Rilassati al tramonto ascoltando le incredibili avventure del Maestro Muten, dalle storie di Goku e Crilin fino alle tecniche segrete dei guerrieri Z.<br>
            Ogni serata è un tuffo nella storia dell'arte marziale più potente dell'universo!
          </p>

      </div>
      <div class="clearfix" id="info_location2">
        <h2>
          🌌 Esplora Namecc: Un Viaggio tra Natura Mistica e Potere Leggendario! 🛸
        </h2>
        <p>
          🌿 Benvenuti su Namecc, il pianeta verde smeraldo dove la natura incontaminata e il misticismo si fondono in un’esperienza di viaggio unica!<br>
          Situato in una galassia lontana, questo paradiso extraterrestre offre paesaggi mozzafiato, villaggi pacifici e un’energia spirituale che scorre tra le sue terre sacre. 
        </p>
        
        <h3>
          ✨ Cosa ti aspetta su Namecc?
        </h3>
        <img class="float-left clear-right" src="immagini/DragonBall/desktop-wallpaper-planet-namek.jpg">
        <h4 class="clear-right">🟢 Paesaggi Alieni e Incantevoli</h4>
        <p class="clear-right">
          Immergiti in un mondo dalle sfumature verde-blu, dove gli alberi alti e slanciati, i cieli cangianti e gli immensi specchi d’acqua creano un’atmosfera di pura meraviglia.<br>
          Goditi tramonti surreali mentre esplori questo angolo di universo lontano dalla frenesia terrestre.
        </p>
        <h4 class="clear-right">🛕 Visita i Villaggi Namecciani</h4>
        <p class="clear-right">
          Scopri le antiche comunità dei Namecciani, una razza pacifica e saggia.<br>
          Interagisci con gli abitanti locali e lasciati affascinare dalla loro cultura basata sull’equilibrio, la meditazione e l’armonia con la natura.
        </p>
        
        <img class="float-right clear-left" src="immagini/DragonBall/adding-a-new-character-every-day-until-sparking-zero-is-v0-z7u56vhfjzyc1.webp">
        <h4 class="clear-left">🌟 Alla Ricerca delle Sfere del Drago</h4>
        <p class="clear-left">
          Namecc è il luogo d’origine delle leggendarie Sfere del Drago!<br>
          Unisciti a una spedizione esclusiva per scoprire i templi sacri e gli altari nascosti dove queste reliquie mistiche sono state custodite per secoli.<br>
          Chi lo sa? Magari potresti persino avvistare Porunga, il drago eterno!
        </p>
        <h4 class="clear-left">⚔ Le Rovine della Battaglia Epica</h4>
        <p class="clear-left">
          Se sei un fan dell’azione, visita i luoghi dove si è combattuta una delle battaglie più leggendarie dell’universo!<br>
          Attraversa le valli devastate dallo scontro tra Goku e Freezer e ascolta i racconti che hanno reso questo pianeta un'icona della storia intergalattica.
        </p>
        
        <img class="float-left clear-right" src="immagini/DragonBall/Namecciani.png">
        <h4 class="clear-right">🌱 Rigenerazione e Benessere</h4>
        <p class="clear-right">
          Dopo tanta avventura, rilassati nelle acque rigenerative naturali del pianeta e goditi un percorso di benessere sotto la guida di un anziano namecciano.<br>
          Qui potrai ricaricare corpo e spirito, avvolto dalla quiete e dalla magia di Namecc.
        </p>
      </div>
      <div class="clearfix" id="info_location3">
        <h2>
          🌌 Viaggio sul Pianeta di King Kai: Allenati con il Maestro dell’Oltretomba! 🏃‍♂️⚡
        </h2>
        <p>
          ✨ Benvenuti sul mitico Pianeta di King Kai! ✨<br>
          Situato alla fine del Serpentone dell’aldilà, questo piccolo ma straordinario mondo è il luogo perfetto per chi desidera affinare la propria forza interiore, migliorare i riflessi e, perché no, farsi qualche risata con gli indovinelli del suo eccentrico abitante!
        </p>
        <h3>
          🔥 Cosa ti aspetta sul Pianeta di King Kai?
        </h3>
        <img class="float-left clear-right" src="immagini/DragonBall/Dead_Z-Fighters_on_King_Kai's_planet.png">
        <h4 class="clear-right">🪐 Un Pianeta Unico nel Suo Genere</h4>
        <p class="clear-right">
          Qui la gravità è 10 volte superiore a quella terrestre! Ogni passo è una sfida, ogni movimento un allenamento. Sei pronto a testare i tuoi limiti?
        </p>
        <h4 class="clear-right">🐵 Incontra King Kai e la Sua Simpatica Compagnia</h4>
        <p class="clear-right">
          Scopri le antiche comunità dei Namecciani, una razza pacifica e saggia.<br>
          Interagisci con gli abitanti locali e lasciati affascinare dalla loro cultura basata sull’equilibrio, la meditazione e l’armonia con la natura.
        </p>
        
        <img class="float-right clear-left" src="immagini/DragonBall/Goku-Struggles-With-The-Gravity-On-King-Kais-Planet.jpg">
        <h4 class="clear-left">🐒 Sfida Bubbles e Gregory!</h4>
        <p class="clear-left">
          Per diventare un vero allievo di King Kai, dovrai superare due prove iconiche:
          <ul>
            <li>Insegui e cattura Bubbles, la scimmietta più veloce del pianeta! Non lasciarti ingannare dal suo aspetto carino, con la gravità aumentata ogni salto sarà un’impresa!</li>
            <li>Colpisci Gregory, la cavalletta volante con un riflesso fulmineo! Se ci riesci, King Kai potrebbe svelarti alcuni segreti proibiti…</li>
          </ul>
        </p>
        <h4 class="clear-left">🌠 Panorama Celestiale e Relax Spirituale</h4>
        <p class="clear-left">
          Dopo tanto allenamento, rilassati sotto un cielo stellato incredibilmente limpido, circondato da un’atmosfera di pura pace cosmica.<br>
          Medita con King Kai e scopri i segreti dell’equilibrio tra mente e corpo.
        </p>
        
        <img class="float-left clear-right" src="immagini/DragonBall/dragon-ball-goku-riesce-superare-velocitA-luce-scopriamolo-v3-532194-1280x720.webp">
        <h4 class="clear-right">🌱 Rigenerazione e Benessere</h4>
        <p class="clear-right">
          Dopo tanta avventura, rilassati nelle acque rigenerative naturali del pianeta e goditi un percorso di benessere sotto la guida di un anziano namecciano.<br>
          Qui potrai ricaricare corpo e spirito, avvolto dalla quiete e dalla magia di Namecc.
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
      <option value="kame_house">Kame House</option>
      <option value="namecc">Namecc</option>
      <option value="king_kai">Pianeta di King Kai</option>
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
