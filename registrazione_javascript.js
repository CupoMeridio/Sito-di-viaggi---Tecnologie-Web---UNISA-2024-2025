// Aggiunge un listener per l'evento "submit" al form con ID 'registrazione'

// document.getElementById('main-container').addEventListener('submit', function (event) { // modifica da Mattia per provare il submit 


function verificaPassword(){ // viene chiamata dal onsubmit del form una volta cliccato fala verifica -> se vero spedisce | se falso NO.
   event.preventDefault(); // Previene il comportamento predefinito di invio del form

    // Assegna alle variabili i valori inseriti nei campi di input del form
    let nome = document.getElementById('nome').value;
    let cognome = document.getElementById('cognome').value;
    let username = document.getElementById('username').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('confirmPassword').value;
    let message = document.getElementById('message');
    let passwordError = document.getElementById('passwordError');
    let confirmPasswordError = document.getElementById('confirmPasswordError');
    let emailError=document.getElementById("emailError");
    
    if(!validateEmail(email)){
    emailError.textContent='Per favore inserisci un\'email valida';
        return false;
   }else{
    emailError.textContent='';
        return true;
   }
    // Valida la password utilizzando la funzione `validatePassword`
  let passwordValid = validatePassword(password);
    if (!passwordValid) {
        passwordError.textContent = 'La password inserita non rispetta i requisiti.';
        return false; // Interrompe l'esecuzione se la password non è valida
    } else {
        passwordError.textContent = ''; // Cancella eventuali messaggi di errore precedenti
        return true;
    }

    // Controlla se le password corrispondono
    if (password !== confirmPassword) {
        confirmPasswordError.textContent = 'La password non corrispondono!';
        return false; // Interrompe l'esecuzione se le password non corrispondono
    } else {
        confirmPasswordError.textContent = ''; // Cancella eventuali messaggi di errore precedenti
        return true;
    }
 // Se tutto è valido, mostra un messaggio di successo
    message.style.color = 'green';
    message.textContent = 'Registrazione effettuata con successo!';
}

/**
 * --------------------------ZONA PASSWORD E COFERMA PASSWORD---------------------------------------
 */
//la funzione verifica in tempo reale che la password sia corretta

let elementoPassword=document.getElementById("password");
let passwordError=document.getElementById("passwordError");
var span=document.getElementById("vedoPassword");
elementoPassword.addEventListener("input", function(){
    let passwordValid = validatePassword(elementoPassword.value);  
    
    if(elementoPassword.value===''){
        passwordError.textContent = '';
        span.textContent='';
    }else if (!passwordValid) {
        passwordError.textContent = 'La password inserita non rispetta i requisiti.';
        span.textContent='Show Password';
    } else {        
        passwordError.textContent = ''; // Cancella eventuali messaggi di errore precedenti
        span.textContent='Show Password';
    }
});

let elementoVerificaPassword=document.getElementById("confirmPassword");
let okPassword=document.getElementById("passwordOK");
elementoVerificaPassword.addEventListener("input", function(){
    let password=document.getElementById("password");
    if(elementoVerificaPassword.value === "") {
        okPassword.textContent = '';
        confirmPasswordError.textContent = '';
    }else if (password.value !== elementoVerificaPassword.value && elementoVerificaPassword.value!=='') {
        okPassword.textContent='';
        confirmPasswordError.textContent = 'La password non corrispondono!';        
    } else if(password.value === elementoVerificaPassword.value){
        okPassword.textContent='ok';
        confirmPasswordError.textContent = ''; 
    }
});



// Mostra il suggerimento per la password quando il campo 'password' riceve il focus
document.getElementById('password').addEventListener('focus', function () {
    document.getElementById('passwordHint').style.display = 'block';

});

// Nasconde il suggerimento per la password quando il campo 'password' perde il focus
document.getElementById('password').addEventListener('blur', function () {
    document.getElementById('passwordHint').style.display = 'none';
});

// Valuta la sicurezza della password durante l'input e aggiorna l'indicatore visivo
document.getElementById('password').addEventListener('input', function () {
    let password = this.value; // Ottiene il valore attuale del campo 'password'
    let passwordSecurity = document.getElementById('passwordSecurity');
    let strength = getPasswordSecurity(password); // Determina la sicurezza della password

    passwordSecurity.innerHTML = ''; // Cancella eventuali barre di forza precedenti
    if (strength) {
        let strengthBar = document.createElement('div'); // Crea un nuovo elemento div per la barra di forza
        strengthBar.className = strength; // Assegna una classe in base alla forza della password
        passwordSecurity.appendChild(strengthBar); // Aggiunge la barra alla sezione di forza
    }
});
// Funzione per validare la password
// Richiede almeno una lettera maiuscola, una minuscola, un numero, un carattere speciale e almeno 8 caratteri
function validatePassword(password) {
    let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return regex.test(password); // Ritorna true se la password soddisfa i requisiti
}

// Funzione per determinare la sicurezza della password
function getPasswordSecurity(password) {
    if (password.length < 8) {
        return 'weak'; // Password debole se inferiore a 8 caratteri
    }
    if (password.match(/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/)) {
        return 'strong'; // Password forte se soddisfa tutti i requisiti
    }
    return 'medium'; // Password media se non è forte ma ha una lunghezza accettabile
}
/* -----------------TOGGLE CLICK------------------ */

function toggleClick() {
    var password = document.getElementById("password");
    
    if (password.type === "password") {
      password.type = "text";
      span.textContent='Hide Password';
    } else {
      password.type = "password";
      span.textContent='Show Password';
    }
    
  }
/* ----------------------------------ZONA EMAIL---------------------------------------------------- */
const emailProviders = [
    "@gmail.com",
    "@outlook.com",
    "@yahoo.com",
    "@icloud.com",
    "@protonmail.com",
    "@zoho.com",
    "@gmx.com",
    "@aol.com",
    "@mail.com",
    "@libero.it",
    "@tiscali.it",
    "@fastwebnet.it",
    "@email.it",
    "@aruba.it",
    "@kataweb.it",
    "@studenti.unisa.it" ,
    "@hotmail.it",
    "@hotmail.com"
  ];
//Funzione per validare l'email
//SITO REGEX---> https://support.boldsign.com/kb/article/15962/how-to-create-regular-expressions-regex-for-email-address-validation
//grazie al sito abbaimo aggiunto un punto anche dpo la chiocciola per permettere l'inserimento di email che hano più punti
function validateEmail(email){
    //alert("sono stato chiamato");
    let pattern = /^[a-zA-Z0-9_.±]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/; 
    if (!pattern.test(email)){   
        //alert("sono nell'if");     
        return false;
    }else{
        let split=email.split('@');
        let dominio = '@'+split[1];
        return emailProviders.includes(dominio);
    }

}

let elementoEmail=document.getElementById("email");
let elementoError=document.getElementById("emailError");
elementoEmail.addEventListener("input", function(){
    if(elementoEmail.value ===''){
        elementoError.textContent='';
    }else if(!validateEmail(email.value)){
        elementoError.textContent='L\'email inserita non è valida';
    }else if(validateEmail(email.value)){
        elementoError.textContent='';
    }
});
/*---------------------------------------------ZONA NOME/COGNOME------------------------------------- */
let nome=document.getElementById("nome");



/* ---------------------------------------------ZONA FOTO-------------------------------------------- */

// Funzione per recuperare e visualizzare l'immagine caricata tramite il click del mouse sull'apposito input nel form
document.getElementById("fotoProfilo").addEventListener("onclick", function (event) {
    const file = event.target.files[0]; // Ottieni il file caricato
    const anteprima = document.getElementById("immagineAnteprima"); // Elemento dell'immagine per l'anteprima

    if (file) {
        handleFile(file);
    } else {
        anteprima.style.display = "none"; // Nascondi l'immagine se non ci sono file
    }
});


const dropArea = document.getElementById("dropArea");                   // Seleziona l'elemento HTML dell'area di drag-and-drop
const inputFile = document.getElementById("fotoProfilo");               // Seleziona l'input nascosto per il caricamento del file
const previewImage = document.getElementById("immagineAnteprima");      // Seleziona l'elemento immagine per l'anteprima
const MAX_FILE_SIZE = 5 * 1024 * 1024;                                  // Limite dimensione del file in byte (5MB)

// Funzione per il check sulle dimensioni e per caricare l'immagine
function handleFile(file) {
    if (file.size > MAX_FILE_SIZE) {
            alert('Il file supera la dimensione massima consentita di 5 MB.');
            return;
    }
    const reader = new FileReader();                                     // Crea un oggetto FileReader per leggere il file
    reader.onload = function (e) {
        previewImage.src = e.target.result;                              // Imposta l'URL dell'immagine letta come sorgente dell'anteprima
        previewImage.style.display = "block";                            // Mostra l'immagine nell'anteprima
    };
    reader.readAsDataURL(file);                                          // Legge il file come URL di dati
}




// Gestione dell'evento "dragover" (trascinamento sopra l'area)
dropArea.addEventListener("dragover", (e) => {
    e.preventDefault();                                                  // Previene il comportamento di default del browser (es. aprire il file)
    dropArea.classList.add("drag-over");                                 // Aggiunge una classe per lo stile durante il trascinamento
});


// Gestione dell'evento "dragleave" (quando l'elemento viene lasciato)
dropArea.addEventListener("dragleave", () => {
    dropArea.classList.remove("drag-over");                             // Rimuove la classe quando il trascinamento esce dall'area
});

// Gestione dell'evento "drop" (rilascio del file sull'area)
dropArea.addEventListener("drop", (e) => {
    e.preventDefault();                                                 // Previene il comportamento di default del browser
    dropArea.classList.remove("drag-over");                             // Rimuove la classe "drag-over" dopo il rilascio
    const file = e.dataTransfer.files[0];                               // Recupera il primo file trascinato
    if (file && file.type.startsWith("image/")) {                       // Verifica che il file sia un'immagine
        handleFile(file);                                               // Chiama la funzione per gestire l'immagine
    } else {
        alert("Per favore, carica un'immagine valida.");                // Mostra un messaggio di errore per file non validi
    }
});

// Aprire il selettore file cliccando sull'area drag-and-drop
dropArea.addEventListener("click", () => inputFile.click());            // Simula un clic sull'input file nascosto


// Sincronizza il caricamento del file via input
inputFile.addEventListener("change", () => {
    const file = inputFile.files[0];                                    // Recupera il file selezionato dall'utente
    if (file) handleFile(file);                                         // Chiama la funzione per gestire l'immagine
});



// Array dei percorsi dei video
const videos = [
      'video/registrazione/Video1.mp4',
      'video/registrazione/Video2.mp4',
      'video/registrazione/Video3.mp4',
      'video/registrazione/Video4.mp4',
    ];

    // Seleziona un video casuale
    const randomVideo = videos[Math.floor(Math.random() * videos.length)];

    // Imposta il video come sorgente
    const videoElement = document.getElementById('background-video');
    videoElement.innerHTML = `<source src="${randomVideo}" type="video/mp4">`;

    // Aggiunge un messaggio se il browser non supporta il video
    videoElement.innerHTML += 'Errore nella riproduzione del video.';

/*gestione eventi di errore nei seguenti casi
    1. L'utente mentre si registra utilizza un'email già esistente---> riprova la registrazione o fa login
    2. L'utente nel login sbaglia password---> deve riprovare l'accesso
    3. L'utente nel login sbaglia email---> risprova l'accesso o si registra

    function responseHandler(response){
    
}
*/

document.getElementById('email').addEventListener('input', function(){
    let email=document.forms['form-registrazione']['email'];
    //alert(email);
    let serverRequest=new XMLHttpRequest();
    serverRequest.onreadystatechange = function(){
    if(serverRequest.readyState == 4 && serverRequest.status == 200){
        //chiamo la funzione che prende la risposta dal server
        //alert(this.responseText);
    }
    }
    //qui invece preparo la richiesta
    serverRequest.open("POST", "logreg.php");
    serverRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //metodo post-->invio key=value
    serverRequest.send("email="+encodeURIComponent(email));
    
});

