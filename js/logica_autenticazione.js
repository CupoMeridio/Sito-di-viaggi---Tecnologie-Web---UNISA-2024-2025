/**
 * BeyondReality Journeys - Registrazione & Login Logic
 */

// --- VALIDAZIONE REGISTRAZIONE ---

function verificaModulo() {
    console.log("Esecuzione verificaModulo");
    
    const fields = ['nome', 'cognome', 'username', 'email', 'password', 'confirmPassword'];
    let allValid = true;

    // Reset messaggi generali
    Utils.clearError('message');

    // Validazione base (presenza valori)
    fields.forEach(f => {
        const val = document.getElementById(f).value;
        if (!val) {
            allValid = false;
            // Se necessario aggiungi logica per evidenziare campi vuoti
        }
    });

    if (allValid && validateAllRealTime()) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').textContent = 'Effettua la registrazione, dopo autenticati facendo il login.';
        return true;
    }

    return false;
}

/**
 * Controlla se tutti i campi sono validi basandosi sullo stato corrente della validazione real-time.
 */
function validateAllRealTime() {
    const nome = document.getElementById('nome').value;
    const cognome = document.getElementById('cognome').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    return Utils.patterns.nome.test(nome) &&
           Utils.patterns.cognome.test(cognome) &&
           Utils.isValidEmail(email) &&
           Utils.patterns.password.test(password) &&
           password === confirmPassword;
}

// --- VALIDAZIONE REAL-TIME ---

// Nome
document.getElementById('nome').addEventListener('input', function() {
    const val = this.value;
    if (val === '') {
        Utils.clearError('nameError');
        this.style.outline = "";
    } else if (Utils.patterns.nome.test(val)) {
        Utils.clearError('nameError');
        this.style.outline = "solid #287b3f 2px";
    } else {
        Utils.showError('nameError', 'Il nome non può cominciare con numeri o caratteri speciali. Può contenere numeri.');
        this.style.outline = "solid red 2px";
    }
});

// Cognome
document.getElementById('cognome').addEventListener('input', function() {
    const val = this.value;
    if (val === '') {
        Utils.clearError('cognomeError');
        this.style.outline = "";
    } else if (Utils.patterns.cognome.test(val)) {
        Utils.clearError('cognomeError');
        this.style.outline = "solid #287b3f 2px";
    } else {
        Utils.showError('cognomeError', 'Il cognome non può contenere numeri o caratteri speciali.');
        this.style.outline = "solid red 2px";
    }
});

// Email Registrazione (con controllo disponibilità asincrono)
document.getElementById('email').addEventListener('input', async function() {
    const val = this.value;
    if (val === '') {
        Utils.clearError('emailError');
        this.style.outline = "";
        return;
    }

    if (!Utils.isValidEmail(val)) {
        Utils.showError('emailError', "L'email inserita non è valida o il provider non è supportato.");
        this.style.outline = "solid red 2px";
        return;
    }

    // Controllo disponibilità via Fetch
    try {
        const result = await Utils.postData("api/verifica_email_ajax.php", { email: val });
        if (result === "disponibile") {
            Utils.clearError('emailError');
            this.style.outline = "solid #287b3f 2px";
        } else {
            Utils.showError('emailError', "Questa email è già associata ad un account.");
            this.style.outline = "solid red 2px";
        }
    } catch (e) {
        console.error("Errore controllo email:", e);
    }
});

// Password Corrente
document.getElementById('password').addEventListener('input', function() {
    const val = this.value;
    const span = document.getElementById("pwReg");
    const hint = document.getElementById('passwordHint');
    const security = document.getElementById('passwordSecurity');

    if (val === '') {
        Utils.clearError('passwordError');
        span.textContent = '';
        this.style.outline = "";
        security.innerHTML = '';
        return;
    }

    span.textContent = 'Show Password';
    
    // Forza password
    const strength = getPasswordStrength(val);
    security.innerHTML = `<div class="${strength}"></div>`;

    if (Utils.patterns.password.test(val)) {
        Utils.clearError('passwordError');
        this.style.outline = "solid #287b3f 2px";
    } else {
        Utils.showError('passwordError', 'La password non rispetta i requisiti.');
        this.style.outline = "solid red 2px";
    }
});

document.getElementById('password').addEventListener('focus', () => document.getElementById('passwordHint').style.display = 'block');
document.getElementById('password').addEventListener('blur', () => document.getElementById('passwordHint').style.display = 'none');

// Conferma Password
document.getElementById('confirmPassword').addEventListener('input', function() {
    const val = this.value;
    const original = document.getElementById('password').value;
    const span = document.getElementById("confirmReg");

    if (val === '') {
        Utils.clearError('confirmPasswordError');
        span.textContent = '';
        this.style.outline = "";
        return;
    }

    span.textContent = 'Show Password';
    if (val === original) {
        Utils.clearError('confirmPasswordError');
        this.style.outline = "solid #287b3f 2px";
    } else {
        Utils.showError('confirmPasswordError', 'Le password non corrispondono!');
        this.style.outline = "solid red 2px";
    }
});

// --- EMAIL LOGIN (Asincrono) ---
document.getElementById('email-login')?.addEventListener('input', async function() {
    const val = this.value.trim();
    if (val === '') {
        Utils.clearError('emailErrorLogin');
        this.style.outline = "";
        return;
    }

    try {
        const result = await Utils.postData("api/verifica_email_ajax.php", { email: val });
        if (result === "esiste") {
            Utils.clearError('emailErrorLogin');
            this.style.outline = "";
        } else {
            Utils.showError('emailErrorLogin', "Non esiste alcun account associato a questa email.");
            this.style.outline = "solid red 2px";
        }
    } catch (e) {
        console.error("Errore controllo login email:", e);
    }
});

// --- UTILITY LOCALI ---

function getPasswordStrength(password) {
    if (password.length < 8) return 'weak';
    if (password.match(Utils.patterns.password)) return 'strong';
    return 'medium';
}

function toggleClick(pw_id, span_id) {
    const password = document.getElementById(pw_id);
    const span = document.getElementById(span_id);
    if (password.type === "password") {
        password.type = "text";
        span.textContent = 'Hide Password';
    } else {
        password.type = "password";
        span.textContent = 'Show Password';
    }
}

// --- FOTO PROFILO ---
const dropArea = document.getElementById("dropArea");
const inputFile = document.getElementById("fotoProfilo");
const previewImage = document.getElementById("immagineAnteprima");
const MAX_FILE_SIZE = 5 * 1024 * 1024;

function handleFile(file) {
    if (!file || !file.type.startsWith("image/")) {
        alert("Per favore, carica un'immagine valida.");
        return;
    }
    if (file.size > MAX_FILE_SIZE) {
        alert('Il file supera la dimensione massima consentita di 5 MB.');
        return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
        previewImage.src = e.target.result;
        previewImage.style.display = "block";
    };
    reader.readAsDataURL(file);
}

dropArea?.addEventListener("dragover", (e) => { e.preventDefault(); dropArea.classList.add("drag-over"); });
dropArea?.addEventListener("dragleave", () => dropArea.classList.remove("drag-over"));
dropArea?.addEventListener("drop", (e) => {
    e.preventDefault();
    dropArea.classList.remove("drag-over");
    handleFile(e.dataTransfer.files[0]);
});
dropArea?.addEventListener("click", () => inputFile.click());
inputFile?.addEventListener("change", () => handleFile(inputFile.files[0]));

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

// Toggle password login visibility
document.getElementById("password-login")?.addEventListener("input", function() {
    const span = document.getElementById("pwLogin");
    span.textContent = this.value === "" ? "" : 'Show Password';
});

