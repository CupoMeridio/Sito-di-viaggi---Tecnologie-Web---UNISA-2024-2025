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
  <meta charset="UTF-8"> <!-- Definisce la codifica dei caratteri come UTF-8, per supportare caratteri speciali -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Rende la pagina responsiva, adattandola alla larghezza dello schermo del dispositivo -->
  <title>Doctor who</title> <!-- Imposta il titolo della pagina che apparirà nella scheda del browser -->

  <script src="doctorwho.js" type="text/javascript" defer="true"></script>
  <!-- Collegamento al file JavaScript esterno per la logica di validazione o interattività -->
  <script src="commenti.js" type="text/javascript" defer="true"></script>
  <link rel="stylesheet" href="doctorwho.css">
  <!-- Collega il file CSS esterno per definire gli stili visivi della pagina -->
</head>
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

<header>
  <video src="video/doctorwho/doctorwho.mp4" class="headerVideo" id="background-video"
    alt="Dragon Ball background video" autoplay muted loop></video>
  <img class="headerImg" id="worldTitle" src="immagini/Doctor-Who-Logo.png" alt="Dragon Ball Title screen">
</header>


<div class="intermezzo fade">
      <img src="immagini/tardis_.gif" id="intermezzo-img">
</div>
<div class="slideshow-container">
  <div class="mySlides fade">
    <img src="immagini/vesuvio.png" id="location1"> 
    <div class="captionText">Nome 1</div>
  </div>

  <div class="mySlides fade">
    <img src="immagini/gallifrey.jpg" id="location2">
    <div class="captionText">Nome 2</div>
  </div>

  <div class="mySlides fade">
    <img src="immagini/namecc.jpeg" id="location3">
    <div class="captionText">Nome 3</div>
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
    <p>
      È un pianeta affascinante con una lunga storia e una cultura avanzata.<br>
      Gallifrey si trova nella costellazione di Kasterborous, al 10º pianeta dal suo sole.
      È un mondo di tecnologia avanzata, con enormi città coperte da cupole, 
      la più famosa delle quali è la capitale, chiamata anche Gallifrey o più comunemente Citadel.
    </p>
    <h2> Per chi è adatto questo viaggio ?</h2>
    <p>A tutti gli esseri viventi che amano tecnologie aliene avanzate e non hanno paura del nuovo e del diverso. </p>

  </div>
  <div class="clearfix" id="info_location2">
    <h2>
      🌌 Esplora Namecc: Un Viaggio tra Natura Mistica e Potere Leggendario! 🛸
    </h2>
    <p>
      🌿 Benvenuti su Namecc, il pianeta verde smeraldo dove la natura incontaminata e il misticismo si fondono in
      un’esperienza di viaggio unica!<br>
      Situato in una galassia lontana, questo paradiso extraterrestre offre paesaggi mozzafiato, villaggi pacifici e
      un’energia spirituale che scorre tra le sue terre sacre.
    </p>

    <h3>
      ✨ Cosa ti aspetta su Namecc?
    </h3>
    <img class="float-left clear-right" src="immagini/desktop-wallpaper-planet-namek.jpg">
    <h4 class="clear-right">🟢 Paesaggi Alieni e Incantevoli</h4>
    <p class="clear-right">
      Immergiti in un mondo dalle sfumature verde-blu, dove gli alberi alti e slanciati, i cieli cangianti e gli
      immensi specchi d’acqua creano un’atmosfera di pura meraviglia.<br>
      Goditi tramonti surreali mentre esplori questo angolo di universo lontano dalla frenesia terrestre.
    </p>
    <h4 class="clear-right">🛕 Visita i Villaggi Namecciani</h4>
    <p class="clear-right">
      Scopri le antiche comunità dei Namecciani, una razza pacifica e saggia.<br>
      Interagisci con gli abitanti locali e lasciati affascinare dalla loro cultura basata sull’equilibrio, la
      meditazione e l’armonia con la natura.
    </p>

    <img class="float-right clear-left"
      src="immagini/adding-a-new-character-every-day-until-sparking-zero-is-v0-z7u56vhfjzyc1.webp">
    <h4 class="clear-left">🌟 Alla Ricerca delle Sfere del Drago</h4>
    <p class="clear-left">
      Namecc è il luogo d’origine delle leggendarie Sfere del Drago!<br>
      Unisciti a una spedizione esclusiva per scoprire i templi sacri e gli altari nascosti dove queste reliquie
      mistiche sono state custodite per secoli.<br>
      Chi lo sa? Magari potresti persino avvistare Porunga, il drago eterno!
    </p>
    <h4 class="clear-left">⚔ Le Rovine della Battaglia Epica</h4>
    <p class="clear-left">
      Se sei un fan dell’azione, visita i luoghi dove si è combattuta una delle battaglie più leggendarie
      dell’universo!<br>
      Attraversa le valli devastate dallo scontro tra Goku e Freezer e ascolta i racconti che hanno reso questo
      pianeta un'icona della storia intergalattica.
    </p>

    <img class="float-left clear-right" src="immagini/Namecciani.png">
    <h4 class="clear-right">🌱 Rigenerazione e Benessere</h4>
    <p class="clear-right">
      Dopo tanta avventura, rilassati nelle acque rigenerative naturali del pianeta e goditi un percorso di benessere
      sotto la guida di un anziano namecciano.<br>
      Qui potrai ricaricare corpo e spirito, avvolto dalla quiete e dalla magia di Namecc.
    </p>
  </div>
  <div class="clearfix" id="info_location3">
    <h2>
      🌌 Viaggio sul Pianeta di King Kai: Allenati con il Maestro dell’Oltretomba! 🏃‍♂️⚡
    </h2>
    <p>
      ✨ Benvenuti sul mitico Pianeta di King Kai! ✨<br>
      Situato alla fine del Serpentone dell’aldilà, questo piccolo ma straordinario mondo è il luogo perfetto per chi
      desidera affinare la propria forza interiore, migliorare i riflessi e, perché no, farsi qualche risata con gli
      indovinelli del suo eccentrico abitante!
    </p>
    <h3>
      🔥 Cosa ti aspetta sul Pianeta di King Kai?
    </h3>
    <img class="float-left clear-right" src="immagini/Dead_Z-Fighters_on_King_Kai's_planet.png">
    <h4 class="clear-right">🪐 Un Pianeta Unico nel Suo Genere</h4>
    <p class="clear-right">
      Qui la gravità è 10 volte superiore a quella terrestre! Ogni passo è una sfida, ogni movimento un allenamento.
      Sei pronto a testare i tuoi limiti?
    </p>
    <h4 class="clear-right">🐵 Incontra King Kai e la Sua Simpatica Compagnia</h4>
    <p class="clear-right">
      Scopri le antiche comunità dei Namecciani, una razza pacifica e saggia.<br>
      Interagisci con gli abitanti locali e lasciati affascinare dalla loro cultura basata sull’equilibrio, la
      meditazione e l’armonia con la natura.
    </p>

    <img class="float-right clear-left" src="immagini/Goku-Struggles-With-The-Gravity-On-King-Kais-Planet.jpg">
    <h4 class="clear-left">🐒 Sfida Bubbles e Gregory!</h4>
    <p class="clear-left">
      Per diventare un vero allievo di King Kai, dovrai superare due prove iconiche:
    <ul>
      <li>Insegui e cattura Bubbles, la scimmietta più veloce del pianeta! Non lasciarti ingannare dal suo aspetto
        carino, con la gravità aumentata ogni salto sarà un’impresa!</li>
      <li>Colpisci Gregory, la cavalletta volante con un riflesso fulmineo! Se ci riesci, King Kai potrebbe svelarti
        alcuni segreti proibiti…</li>
    </ul>
    </p>
    <h4 class="clear-left">🌠 Panorama Celestiale e Relax Spirituale</h4>
    <p class="clear-left">
      Dopo tanto allenamento, rilassati sotto un cielo stellato incredibilmente limpido, circondato da un’atmosfera di
      pura pace cosmica.<br>
      Medita con King Kai e scopri i segreti dell’equilibrio tra mente e corpo.
    </p>

    <img class="float-left clear-right"
      src="immagini/dragon-ball-goku-riesce-superare-velocitA-luce-scopriamolo-v3-532194-1280x720.webp">
    <h4 class="clear-right">🌱 Rigenerazione e Benessere</h4>
    <p class="clear-right">
      Dopo tanta avventura, rilassati nelle acque rigenerative naturali del pianeta e goditi un percorso di benessere
      sotto la guida di un anziano namecciano.<br>
      Qui potrai ricaricare corpo e spirito, avvolto dalla quiete e dalla magia di Namecc.
    </p>
  </div>
</div>
</div>


<!-- Sezione Prenotazione Viaggio -->
<div class="booking-section" style="clear:both">
  <h2>Prenota il Tuo Viaggio Fantastico!</h2>
  <form id="booking-form" onsubmit="return calcolaprezzo(event)">
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
    <input type="date" id="departure-date" name="departure-date" required min="" onchange="setMinReturnDate()">

    <label for="return-date">Data di Ritorno:</label>
    <input type="date" id="return-date" name="return-date" required min="">

    <label for="comments">Commenti Speciali:</label>
    <textarea id="comments" name="comments" rows="4"
      placeholder="Inserisci richieste particolari o commenti"></textarea>

    <?php if (isset($email)) { ?>
      <input type="submit" id="submit-form-button" value="Prenota il tuo viaggio!">
    <?php } else { ?>
      <input type="button" id="submit-form-button" value="Registrati o accedi per prenotare il tuo viaggio!">
    <?php } ?>
  </form>
</div>

<!--SONO QUI-->
<script>
  // Impostare la data minima per la partenza come la data corrente
  document.getElementById('departure-date').min = new Date().toLocaleDateString('en-CA');

  // Funzione per aggiornare la data minima di ritorno
  function setMinReturnDate() {
    const departureDate = document.getElementById('departure-date').value;
    document.getElementById('return-date').min = departureDate;
  }
</script>
<div id="popup">
  <div id="pagamento_con_stripe" style="display: none;">
    <h1>Pagamento con Stripe</h1>
    <form method="post" id="payment-form">
      <div class="form-row">
        <label for="fullname">
          Nome Completo
        </label>
        <input type="text" id="fullname" name="fullname" value="">
        <input type="hidden" id="importo" name="importo" value="">
      </div>
      <div class="form-row">
        <label for="card-element">
          Credit or debit card
        </label>
        <div id="card-element">
          <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display Element errors. -->
        <div id="card-errors" role="alert"></div>
      </div>

      <button id="close-button">Chiudi</button>
      <button id="submit-button">Conferma pagamento</button>
    </form>
  </div>
</div>

<!-- Sezione Recensioni -->
<div class="reviews-section" style="display: flex; justify-content: space-between">

  <!-- Colonna Visualizzazione Recensioni -->
  <div class="reviews-display" style="width: 50%; height: 300px; overflow-y: auto;">
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
      <textarea id="experience" name="experience" rows="4" cols="50" required
        placeholder="Scrivi la tua esperienza..."></textarea>
      <br><br>
      <?php if (isset($email)) { ?>
        <input type="button" value="Invia Recensione" onclick="InserisciCommento()">
      <?php } else { ?>
        <input type="button" value="Registrati o accedi per inviare una recensione">
      <?php } ?>
    </form>
  </div>

</div>

<footer>
  <div class="footer-content">
    <p>&copy; 2025 BeyondReality Journeys | Tutti i diritti riservati.</p>
    <p class="disclaimer">
      🚨 <strong>Disclaimer:</strong> Questo sito non è un reale sito di viaggi, ma è un progetto creato per l'esame di
      <strong>Tecnologie Web</strong> dell'Università degli Studi di Salerno (UNISA) per l'anno accademico 2024/2025.
      <br>
      Tutti i contenuti sono puramente fittizi.
    </p>
  </div>
</footer>
</body>

</html>

</html>