let ID_ULTIMO_COMMENTO = 0;

/**
 * Inserisce un nuovo commento tramite Fetch API.
 */
async function InserisciCommento() {
    const com = document.forms["commenti"]["experience"].value;
    const stelle = document.forms["commenti"]["rating"].value;

    if (!com.trim()) return;

    if (confirm("Vuoi inserire il commento?\n" + com)) {
        try {
            const responseText = await Utils.postData("api/salva_commento_ajax.php", {
                experience: com,
                rating: stelle
            });
            
            // Invece di un alert invasivo, potremmo mostrare un feedback inline
            // Per ora manteniamo alert ma modernizzato nel flusso
            alert(responseText);
            
            // Ricarica i commenti immediatamente
            await PrendiCommenti();
            
            // Pulisci il campo
            document.forms["commenti"]["experience"].value = "";
        } catch (error) {
            console.error("Errore nell'inserimento del commento:", error);
        }
    }
}

/**
 * Recupera i nuovi commenti dal server.
 */
async function PrendiCommenti() {
    try {
        const responseJSON = await Utils.postData("api/recupera_commenti_ajax.php", {
            max: ID_ULTIMO_COMMENTO
        });
        LeggiCommenti(responseJSON);
    } catch (error) {
        console.error("Errore nel recupero dei commenti:", error);
    }
}

/**
 * Elabora i commenti ricevuti e li aggiunge al DOM (senza resettare tutto).
 */
function LeggiCommenti(response) {
    const container = document.getElementById("reviews-container");
    if (!container) return;

    try {
        const commenti = JSON.parse(response);
        
        if (commenti.length > 0) {
            // Se c'è il messaggio "nessun commento", rimuovilo
            if (ID_ULTIMO_COMMENTO === 0) {
                container.innerHTML = "";
            }

            commenti.forEach(c => {
                const commentoDiv = document.createElement('div');
                commentoDiv.className = 'commento';
                
                // Usiamo template literals con sanitizzazione
                commentoDiv.innerHTML = `
                    <div class="commento-header">
                        <span class="username"><b>${Utils.sanitizeHTML(c.username)}</b></span>
                        <span class="rating">${convertiStelle(c.stelle)}</span>
                        <br>
                        <span class="email" style="color: grey; font-size: 11px;">${Utils.sanitizeHTML(c.email)}</span>
                    </div>
                    <div class="commento-body">
                        <p class="testo" style="white-space: pre-wrap;">${Utils.sanitizeHTML(c.testo)}</p>
                    </div>
                    <div class="commento-footer">
                        <span class="id-testo">ID: ${c.id_testo}</span>
                    </div>
                `;
                
                // Aggiungiamo in cima (o in fondo a seconda della preferenza, qui in fondo per mantenere l'ordine cronologico se caricati massivamente)
                container.appendChild(commentoDiv);
                ID_ULTIMO_COMMENTO = Math.max(ID_ULTIMO_COMMENTO, c.id_testo);
            });
        } else if (ID_ULTIMO_COMMENTO === 0) {
            container.innerHTML = "<p>Nessuna recensione disponibile. Sii il primo a lasciare un commento!</p>";
        }
    } catch (e) {
        console.error("Errore nel parsing dei commenti:", e);
    }
}

function convertiStelle(rating) {
    return "⭐".repeat(rating) + "☆".repeat(5 - rating);
}

function updateReviewPlaceholder() {
    const locationSelect = document.getElementById("location_selection");
    const experienceTextarea = document.getElementById("experience");
    if (locationSelect && experienceTextarea) {
        const selectedLocation = locationSelect.options[locationSelect.selectedIndex].text;
        experienceTextarea.value = `Recensione su ${selectedLocation}\n`;
    }
}

// Avvio iniziale
document.addEventListener('DOMContentLoaded', () => {
    PrendiCommenti();
    setInterval(PrendiCommenti, 5000);
    updateReviewPlaceholder();
});