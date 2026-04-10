<?php

include 'api/recupera_dati_utente.php';


?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/stile_home.css">
    <link rel="stylesheet" href="css/stile_navbar.css">
    <link rel="stylesheet" href="css/stile_dashboard.css">
    <link rel="stylesheet" href="css/stile_storico_ordini.css">
    <?php include("components/imposta_icona.html"); ?>
    <script src="js/utils.js" type="text/javascript" defer></script>
    <script src="js/logica_home.js" type="text/javascript" defer="true"></script>

</head>

<body>

    <?php include 'components/navbar.php'; ?>
  
    <?php include 'components/dashboard.html'; ?>
    
    
    
    <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numberText">1 / 3</div>
            <a href="viaggio_jojos.php"><img src="img/index/vesuvio.png"></a>
            <div class="captionText">Scopri: Napoli!</div>
        </div>

        <div class="mySlides fade">
            <div class="numberText">2 / 3</div>
            <a href="viaggio_doctorwho.php"><img src="img/index/gallifrey.jpg"></a>
            <div class="captionText">Scopri: Gallifrey!</div>
        </div>

        <div class="mySlides fade">
            <div class="numberText">3 / 3</div>
            <a href="viaggio_dragonball.php"><img src="img/dragonball/namecc.jpeg"></a>
            <div class="captionText">Scopri: Namecc!</div>
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
    
    <section class="destinations">
        <h1>Our destinations</h1>
        <div class="destinations_selector" id="destinations_selector">
            <div class="destination" id="destination1">
                <a href="viaggio_jojos.php"><img src="img/index/jojos.png"></a>
                <div class="destination-name">Le bizzarre avventure di Jojo</div>
            </div>
            <div class="destination" id="destination2">
                <a href="viaggio_doctorwho.php"><img src="img/index/drwho.jpg"></a>
                <div class="destination-name">Doctor Who</div>
            </div>
            <div class="destination" id="destination3">
                <a href="viaggio_dragonball.php"><img src="img/index/dragonballtitleindex.png"></a>
                <div class="destination-name">Dragonball</div>
            </div>
        </div>
    </section>



    <section class="about-section" id="about-section">
        <br> <!--per facilitare href-->
        <div id="presentazione">
            <h2>About Us – BeyondReality Journeys</h2>
            <p>
                Benvenuti in <strong>BeyondReality Journeys</strong>, l’agenzia di viaggi definitiva per chi sogna di esplorare mondi oltre l’immaginazione! 
                Da sempre appassionati di avventure straordinarie, abbiamo trasformato l’impossibile in realtà: ora puoi prenotare viaggi nei tuoi universi preferiti, 
                dalle terre incantate dei cartoni agli scenari epici di anime, film e serie TV.
            </p>
        
            <h3>Come abbiamo reso possibile tutto questo?</h3>
            <p>
                Grazie a un rivoluzionario mix di tecnologia avanzata e pura magia narrativa, i nostri esperti hanno sviluppato il <strong>Reality Gateway</strong>, 
                un sistema in grado di aprire portali verso qualsiasi universo tu possa immaginare. Ogni viaggio è progettato per garantirti un’esperienza immersiva e autentica, 
                permettendoti di interagire con i tuoi personaggi preferiti e vivere storie uniche in prima persona.
            </p>
        
        <h3>La nostra missione</h3>
        <p>
            Il nostro obiettivo è abbattere i confini tra fantasia e realtà, offrendo ai viaggiatori la possibilità di scoprire mondi straordinari come mai prima d’ora. 
            Che tu voglia volare su una scopa a Hogwarts, esplorare la Contea con gli hobbit o combattere al fianco dei tuoi eroi anime preferiti, noi possiamo portarti lì.
        </p>
        
        <p>Sei pronto a partire? <br> <strong>BeyondReality Journeys</strong> ti aspetta per il viaggio della tua vita!</p>
        
        <h3>Il nostro team</h3>
        <div class="team" id="contact-section">
            <div class="team-member"> <!--https://pbs.twimg.com/media/FbjFQH_WAAE_RsA.png-->
                <a href="https://linktr.ee/ciiprosk"><div class="profile-pic"><img src="https://i1.sndcdn.com/artworks-96KvhzYlwoy1zhOY-PaPjQw-t500x500.jpg"></div></a>
                <h4>Passaro Rosa</h4>
                <p>r.passaro5@studenti.unisa.it</p>
            </div>
            <div class="team-member">
                <a href="https://linktr.ee/CupoMeridio"><div class="profile-pic"><img src="img/index/20200806_125456.jpg"></div></a>
                <h4>Postiglione Vittorio</h4>
                <p>v.postiglione7@studenti.unisa.it</p>
            </div>
            <div class="team-member">
                <a href="https://linktr.ee/MattiaSanzari"><div class="profile-pic"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQquPDtFOisYUHZfHEqMgPePp_Mu7oS9_F1w&s"></div></a>
                <h4>Sanzari Mattia</h4>
                <p>m.sanzari@studenti.unisa.it</p>
            </div>
            <div class="team-member">
                <a href="https://linktr.ee/a.ntibiotico"><div class="profile-pic"><img src="img/index/av.jpg"></div></a>
                <h4>Vitale Antonio</h4>
                <p>a.vitale132@studenti.unisa.it</p>
            </div>
        </div>
    </div>

        
    </section>

    <footer id="footer-section">
        <div class="footer-content">
            <p>&copy; 2025 BeyondReality Journeys | Tutti i diritti riservati.</p>
            <p class="disclaimer">
                🚨 <strong>Disclaimer:</strong> Questo sito non è un reale sito di viaggi, ma è un progetto creato per l'esame di <strong>Tecnologie Web</strong> dell'Università degli Studi di Salerno (UNISA) per l'anno accademico 2024/2025. <br>
                Tutti i contenuti sono puramente fittizi.
            </p>
        </div>
    </footer>
</body>

</html>
