/**
 * BeyondReality Journeys - Recupero Password Logic
 */

// --- VIDEO BACKGROUND ---
const videos = [
    'video/registrazione/Video1.mp4',
    'video/registrazione/Video2.mp4',
    'video/registrazione/Video3.mp4',
    'video/registrazione/Video4.mp4',
];

const videoElement = document.getElementById('background-video');
if (videoElement) {
    const randomVideo = videos[Math.floor(Math.random() * videos.length)];
    videoElement.innerHTML = `<source src="${randomVideo}" type="video/mp4">Errore nella riproduzione del video.`;
}

// --- VALIDAZIONE EMAIL ---
const emailInput = document.getElementById("email");
if (emailInput) {
    emailInput.addEventListener("input", function() {
        const val = this.value.trim();
        if (val === '') {
            this.style.outline = "";
            Utils.clearError('emailError'); // Assumendo che ci sia un elemento per l'errore o gestendo tramite outline
        } else if (Utils.isValidEmail(val)) {
            this.style.outline = "solid green 3px";
            Utils.clearError('emailError');
        } else {
            this.style.outline = "solid red 3px";
        }
    });
}

// --- VALIDAZIONE NUOVA PASSWORD ---
const passwordInput = document.getElementById("Cambia_password");
if (passwordInput) {
    passwordInput.addEventListener("input", function() {
        const val = this.value;
        const errorEl = document.getElementById("error");
       
        if (val === '') {
            this.style.outline = "";
            if (errorEl) errorEl.textContent = "";
            return;
        }

        if (Utils.patterns.password.test(val)) {
            this.style.outline = "solid 3px green";
            if (errorEl) errorEl.textContent = "";
        } else {
            this.style.outline = "solid 3px red";
            if (errorEl) errorEl.textContent = "La password non rispetta i requisiti (min 8 car, 1 Mausc, 1 Minusc, 1 Num, 1 Spec).";
        }
    });
}

