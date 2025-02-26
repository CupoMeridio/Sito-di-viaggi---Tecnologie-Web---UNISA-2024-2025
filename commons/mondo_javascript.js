// Funzione per mostrare un elemento con dissolvenza
function showWithFadeIn(element) {
    setTimeout(function() {
        element.style.display = 'block';  // Imposta display su block per renderlo visibile
    }, 500); // Dopo 0.5s (durata della transizione di dissolvenza)
    setTimeout(function() {
        element.classList.add('show');  // Aggiungi la classe 'show' per animare l'opacità
    }, 1000); // Un piccolo timeout per applicare il cambiamento di display prima dell'animazione
}

// Funzione per nascondere un elemento con display:none
function hideElement(element) {
    element.classList.remove('show');  // Rimuovi la classe 'show' per farlo svanire
    setTimeout(function() {
        element.style.display = 'none';  // Imposta display su none dopo l'animazione
    }, 500);  // Dopo 0,5s secondo (tempo della transizione di dissolvenza)
}

// Seleziona gli elementi del form e gli overlay
const formprenota = document.getElementById('form-container');
const formrecensione = document.getElementById('form-container-review');
const overlay = document.getElementById('form-overlay');
const overlayrecensione = document.getElementById('form-overlay-review');

// Aggiungi event listener per mostrare/nascondere l'overlay di blocco al passaggio del mouse per gli elementi non accessibili senza login
if (formprenota && overlay) {
    formprenota.addEventListener('mouseover', function() {
        overlay.style.display = 'flex';
    });

    formprenota.addEventListener('mouseout', function() {
        overlay.style.display = 'none';
    });
}

if (formrecensione && overlayrecensione) {
    formrecensione.addEventListener('mouseover', function() {
        overlayrecensione.style.display = 'flex';
    });

    formrecensione.addEventListener('mouseout', function() {
        overlayrecensione.style.display = 'none';
    });
}

// Gestione del click sulle location per mostrare/nascondere le informazioni
document.getElementById('location1').addEventListener('click', function () {
    hideElement(document.getElementById('info_location2'));
    hideElement(document.getElementById('info_location3'));
    showWithFadeIn(document.getElementById('info_location1'));
});

document.getElementById('location2').addEventListener('click', function () {
    hideElement(document.getElementById('info_location1'));
    hideElement(document.getElementById('info_location3'));
    showWithFadeIn(document.getElementById('info_location2'));
});

document.getElementById('location3').addEventListener('click', function () {
    hideElement(document.getElementById('info_location1'));
    hideElement(document.getElementById('info_location2'));
    showWithFadeIn(document.getElementById('info_location3'));
});

// Gestione dell'input per il conteggio dei biglietti
document.getElementById('tickets-count').addEventListener('input', function() {
    // Ottieni il valore inserito dall'utente nel campo "tickets-count" e convertilo in un numero intero.
    // Se il valore non è un numero valido, usa 1 come valore predefinito.
    const ticketsCount = parseInt(this.value) || 1;

    // Seleziona il contenitore dove verranno inseriti i campi per i nomi dei passeggeri.
    const container = document.getElementById('ticket-names-container');

    // Svuota il contenitore per rimuovere eventuali campi precedenti.
    container.innerHTML = '';

    // Ciclo per creare un campo di input per ogni biglietto richiesto.
    for (let i = 0; i < ticketsCount; i++) {
        const label = document.createElement('label');                      // Crea un elemento <label> per il campo di input.
        label.setAttribute("for", `ticket-name-${i}`);                      // Imposta l'attributo "for" del label per associarlo al campo di input corrispondente.
        label.textContent = `Nome Passeggero ${i + 1}:`;                    // Imposta il testo del label (es. "Nome Passeggero 1:", "Nome Passeggero 2:", ecc.).

        const input = document.createElement('input');                      // Crea un elemento <input> per il nome del passeggero.
        input.setAttribute("type", "text");                                 // Imposta il tipo di input come "text".
        input.setAttribute("id", `ticket-name-${i}`);                       // Assegna un ID univoco al campo di input.
        input.setAttribute("name", `ticket-name-${i}`);                     // Assegna un nome al campo di input per identificarlo quando il form viene inviato.
        input.setAttribute("required", "");                                 // Rende il campo obbligatorio.
        input.setAttribute("placeholder", `Nome Passeggero ${i + 1}`);      // Aggiunge un placeholder

        // Aggiungi il label e il campo di input al contenitore.
        container.appendChild(label);
        container.appendChild(input);
    }
});

// Seleziona l'immagine e la dashboard
const toggleButton = document.getElementById('profilePic');
const dashboard = document.getElementById('dashboard');
const navbar = document.getElementById('navbar');

// Aggiungi un event listener per il click sull'immagine
navbar.addEventListener('click', function(event) {
    if (event.target.id === "profilePic") {
        event.stopPropagation(); // Impedisce la propagazione dell'evento
        dashboard.classList.toggle('visible'); // Apre/chiude la dashboard
    }
});

// Chiudi la dashboard quando clicchi fuori da essa
document.addEventListener('click', function(event) {
    if (toggleButton != null) {
        if (!dashboard.contains(event.target) && !toggleButton.contains(event.target)) {
            dashboard.classList.remove('visible'); // Chiude la dashboard
        }
    }
});

/* Login popup (non è stato più utilizzato)
const openBtn = document.getElementById("submit-button");
const closeBtn = document.getElementById("close-button");
const popup = document.getElementById("popup");

openBtn.addEventListener("click", () => {
    popup.classList.add("open");
});

closeBtn.addEventListener("click", () => {
    popup.classList.remove("open");
});
*/