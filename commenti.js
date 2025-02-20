var ID_ULTIMO_COMMENTO = 0;

function InserisciCommento() {
    var com = document.forms["commenti"]["experience"].value;
    var stelle = document.forms["commenti"]["rating"].value;
    if (confirm("Vuoi inserire il commento?\n" + com)) {
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(this.responseText);
                PrendiCommenti();
            }
        };

        xhr.open("POST", "commenti.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("experience=" + encodeURIComponent(com) + "&rating=" + encodeURIComponent(stelle));
    }
}

function PrendiCommenti() {
    var xhrCommenti = new XMLHttpRequest();
    xhrCommenti.onreadystatechange = function () {
        if (xhrCommenti.readyState == 4 && xhrCommenti.status == 200) {
            LeggiCommenti(this.responseText);
        }
    };
    xhrCommenti.open("POST", "prova_JSON");
    xhrCommenti.send(ID_ULTIMO_COMMENTO);
}

function LeggiCommenti(response) {
    var html = "";
    try {
        var commenti = JSON.parse(response);
        if (commenti.length) {
            //tutto ok
            for (var i = 0; i < commenti.length; i++) {
                html += `
                    <div class="commento">
                        <div class="commento-header">
                            <span class="email">${commenti[i].email}</span>
                            <span class="rating">${convertiStelle(commenti[i].stelle)}</span>
                        </div>
                        <div class="commento-body">
                            <p class="testo" style="white-space: pre-wrap;">${commenti[i].testo}</p>
                        </div>
                        <div class="commento-footer">
                            <span class="id-testo">ID: ${commenti[i].id_testo}</span>
                        </div>
                    </div>
                `;
                ID_ULTIMO_COMMENTO = commenti[i].id_testo;
            }
            document.getElementById("reviews-container").innerHTML = html;
        }else{
            //vuoto
            html="<p>Nessuna recensione disponibile. Sii il primo a lasciare un commento!</p>";
            document.getElementById("reviews-container").innerHTML = html;
        }
    } catch (e) {
        //errore
        alert("errore nel caricamento dei commenti riprovare "+ e.message);
    }
}

function convertiStelle(rating) {
    var stellePiene = "⭐".repeat(rating);
    var stelleVuote = "☆".repeat(5 - rating);
    return stellePiene + stelleVuote;
}

function formattaData(data) {
    var dataObj = new Date(data);
    var giorno = dataObj.getDate();
    var mese = dataObj.toLocaleString('it-IT', { month: 'long' });
    var anno = dataObj.getFullYear();
    return `${giorno} ${mese} ${anno}`;
}

PrendiCommenti();
setInterval(PrendiCommenti, 5000);


function updateReviewPlaceholder() {
    // Ottieni l'elemento select della location
    const locationSelect = document.getElementById("location_selection");
    // Ottieni l'elemento textarea
    const experienceTextarea = document.getElementById("experience");

    // Ottieni il testo della location selezionata
    const selectedLocation = locationSelect.options[locationSelect.selectedIndex].text;

    // Imposta il valore della textarea
    experienceTextarea.value = `Recensione su ${selectedLocation}\n`;
}


// Esegui la funzione all'avvio per impostare il valore iniziale
window.onload = function() {
    updateReviewPlaceholder();
};