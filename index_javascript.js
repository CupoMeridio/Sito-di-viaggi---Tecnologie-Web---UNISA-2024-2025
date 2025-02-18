let slideIndex = 1; // Inizia dalla prima slide
showSlides(slideIndex); // Mostra la prima slide all'avvio

// Funzione per cambiare slide automaticamente
function autoSlide() {
    changeSlide(1); // Passa alla prossima slide
    setTimeout(autoSlide, 5000); // Cambia slide ogni 5 secondi (5000 millisecondi)
}

// Avvia lo slideshow automatico
setTimeout(autoSlide, 5000);

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
    let dots = document.getElementsByClassName("dot"); // Ottieni tutti i pallini di navigazione

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

    // Rimuovi la classe "active" da tutti i pallini
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    // Mostra la slide corrente
    slides[slideIndex - 1].style.display = "block";

    // Aggiungi la classe "active" al pallino corrispondente alla slide corrente
    dots[slideIndex - 1].className += " active";
}

//da gestore login e logout???
