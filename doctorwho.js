let slideIndex = 1; // Inizia dalla prima slide
showSlides(slideIndex); // Mostra la prima slide all'avvio

// Funzione per cambiare slide manualmente (Next/Previous)
function changeSlide(n) {
    showSlides(slideIndex += n); // Incrementa o decrementa l'indice della slide
}

// Funzione per andare a una slide specifica (Thumbnail controls)
function currentSlide(n) {
    showSlides(slideIndex = n); // Imposta l'indice della slide a n
}

// Funzione principale per mostrare le slide
function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides"); // Ottieni tutte le slide
    let intermezzo = document.querySelector('.intermezzo');

    // Se n è maggiore del numero di slide, torna alla prima slide
    if (n > slides.length) {
        slideIndex = 1;
    }

    // Se n è minore di 1, vai all'ultima slide
    if (n < 1) {
        slideIndex = slides.length;
    }

    // Nascondi tutte le slide
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    // Mostra l'immagine intermezzo per 0.5s prima della slide successiva
    intermezzo.style.display = "flex";

    setTimeout(() => {
        intermezzo.style.display = "none";

        // Mostra la slide corrente
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }, 4950); // millisecondi di intermezzo, sincronizzato con la durata della gif
}

// Funzione per mostrare un elemento con dissolvenza
function showWithFadeIn(element) {
	setTimeout(function() {
    element.style.display = 'block';  // Imposta display su block per renderlo visibile
	},500); //Dopo 0.5s, (durata della transizione di dissolvenza)
    setTimeout(function() {
        element.classList.add('show');  // Aggiungi la classe 'show' per animare l'opacità
    },1000); // Un piccolo timeout per applicare il cambiamento di display prima dell'animazione
}

// Funzione per nascondere un elemento con display:none
function hideElement(element) {
    element.classList.remove('show');  // Rimuovi la classe 'show' per farlo svanire
    setTimeout(function() {
        element.style.display = 'none';  // Imposta display su none dopo l'animazione
    },500);  // Dopo 0,5s secondo (tempo della transizione di dissolvenza)
}

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




document.getElementById('tickets-count').addEventListener('input', function() {
    const ticketsCount = parseInt(this.value) || 1;
    const container = document.getElementById('ticket-names-container');
    container.innerHTML = '';
    
    for (let i = 0; i < ticketsCount; i++) {
      const label = document.createElement('label');
      label.setAttribute("for", `ticket-name-${i}`);
      label.textContent = `Nome Passeggero ${i + 1}:`;
      
      const input = document.createElement('input');
      input.setAttribute("type", "text");
      input.setAttribute("id", `ticket-name-${i}`);
      input.setAttribute("name", `ticket-name-${i}`);
      input.setAttribute("required", "");
      input.setAttribute("placeholder", `Nome Passeggero ${i + 1}`);
      
      container.appendChild(label);
      container.appendChild(input);
    }
  });
  
  // Seleziona l'immagine e la dashboard
const toggleButton = document.getElementById('profilePic');
const dashboard = document.getElementById('dashboard');

// Aggiungi un event listener per il click sull'immagine
toggleButton.addEventListener('click', function(event) {
    event.stopPropagation(); // Impedisce la propagazione dell'evento
    dashboard.classList.toggle('visible'); // Apre/chiude la dashboard
});

// Chiudi la dashboard quando clicchi fuori da essa
document.addEventListener('click', function(event) {
    if (!dashboard.contains(event.target) && !toggleButton.contains(event.target)) {
        dashboard.classList.remove('visible'); // Chiude la dashboard
    }
});

/*Login popup*/
const openBtn = document.getElementById("submit-button");
const closeBtn = document.getElementById("close-button");
const popup = document.getElementById("popup");

openBtn.addEventListener("click", () => {
    popup.classList.add("open");
});

closeBtn.addEventListener("click", () => {
    popup.classList.remove("open");
});