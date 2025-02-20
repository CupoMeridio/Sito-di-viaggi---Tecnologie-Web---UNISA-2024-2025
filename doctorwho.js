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
