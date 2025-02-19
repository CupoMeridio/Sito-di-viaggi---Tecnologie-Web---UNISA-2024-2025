    let form_prenotazione = document.getElementById('booking-form');
    let pag_stripe = document.getElementById('pagamento_con_stripe');
    
    const MAX=101;

    
    function prendiDatiAggiuntivi(){
        //1. una variaile stringa da ritornare
        let num_biglietti = parseInt(formData.get('tickets-count'));
        let stringa=new Array(MAX);
        for(let i=0; i<num_biglietti; i++){
            stringa[i]="nominativo"+i+":"+form_prenotazione.getElementsById("ticket-name-"+i).value;
        }
        //ABBIAMO TUTTI I BIGLIETTI
        stringa[num_biglietti]="commento:"+form_prenotazione.getElementById('comments').value;//qua si prende il commento
        //creo json
        let json=JSON.stringify(stringa);
        //alert(json);
    }

    function calcolaprezzo(event) {
        event.preventDefault(); // Evita il comportamento predefinito
        
        if (pag_stripe) {
            pag_stripe.style.display = "block";
        }
        popup.classList.add("open");

        let formData = new FormData(form_prenotazione);
        let num_biglietti = parseInt(formData.get('tickets-count'));
        let location = formData.get('location');
        let data_p = Date.parse(formData.get('departure-date'));
        let data_r = Date.parse(formData.get('return-date'));
        let bottone_stripe = document.getElementById('submit-button');
        var importo = document.getElementById('importo');
        let prenotazione = document.getElementById('submit-form-button');
        
        let costo_biglietto = 50;

        if (isNaN(data_p) || isNaN(data_r)) {
            alert("Inserisci una data di partenza e ritorno valida.");
            return false;
        }

        let saldo_tot= ((data_r-data_p)*num_biglietti *50/ (1000 * 60 * 60 * 24)) +5;
        alert(saldo_tot);

        bottone_stripe.textContent = `Prenota il tuo viaggio a soli ${saldo_tot}€`;
        importo.value = saldo_tot*100;
        prenotazione.disabled=true;
        

        return false;
    }



    closeBtn.addEventListener("click", () => {
        popup.classList.remove("open");
        pag_stripe.style.display = "none";
    });

    const stripe = Stripe('pk_test_51QsWhnRwYugaEVfWZdpr479jZxUCuBKqds9KN0c01v8DtI9PQFFV3MSOwStu8zRt6ri900dIcnhvctZ1NVG9OCKD004ZiiHr18');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');
    const cardErrors = document.getElementById("card-errors");
    const form = document.getElementById('payment-form');

    cardElement.on('change', (event) => {
        cardErrors.textContent = event.error ? event.error.message : '';
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        document.getElementById('submit-button').disabled = true;

        const amount = parseInt(form.importo.value) * 100;
        createPaymentIntent(amount, async (response) => {
            try {
                response = JSON.parse(response);
            } catch (e) {
                console.error('Errore nel parsing JSON:', e);
                cardErrors.textContent = 'Errore di comunicazione con il server.';
                document.getElementById('submit-button').disabled = false;
                return;
            }

            if (response.error) {
                console.error('Errore nella creazione del PaymentIntent:', response.error);
                cardErrors.textContent = 'Errore durante la creazione del pagamento.';
                document.getElementById('submit-button').disabled = false;
                return;
            }

            const clientSecret = response.clientSecret;
            console.log(clientSecret);

            const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: form.fullname.value,
                    },
                },
            });

            if (error) {
                console.error('Errore nel pagamento:', error.message);
                cardErrors.textContent = `Errore durante il pagamento: ${error.message}`;
                document.getElementById('submit-button').disabled = false;
            } else if (paymentIntent && paymentIntent.status === 'succeeded') {
                alert('Pagamento completato con successo!');
                aggiornaPrenotazione();
                let pag_stripe = document.getElementById('pagamento_con_stripe');
                if (pag_stripe) {
                    pag_stripe.style.display = "none";
                }
                let prenotazione = document.getElementById('submit-form-button');
                prenotazione.disabled=false;
            } else {
                console.error('Errore sconosciuto durante il pagamento.');
                cardErrors.textContent = 'Errore sconosciuto, riprova.';
                document.getElementById('submit-button').disabled = false;
            }
        });
    });

    function createPaymentIntent(amount, callback) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'stripe/payment.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    try {
                        const response = xhr.response;
                        console.log(response);
                        callback(response);
                    } catch (e) {
                        console.error('Errore nel parsing della risposta:', e);
                        callback({ error: 'Risposta del server non valida' });
                    }
                } else {
                    console.error('Errore nella richiesta AJAX:', xhr.statusText);
                    callback({ error: xhr.statusText });
                }
            }
        };
        const formData = new FormData(form);
        xhr.send(formData);
    }

    function aggiornaPrenotazione() {
        const xhr = new XMLHttpRequest();
        let formData = new FormData(form_prenotazione);
        let num_biglietti = parseInt(formData.get('tickets-count'));
        let location = formData.get('location');
        let data_p = Date.parse(formData.get('departure-date'));
        let data_r = Date.parse(formData.get('return-date'));
        let dati=prendiDatiAggiuntivi();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(this.responseText);
            }
        };

        xhr.open("POST", "prenotazioni.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(`num_biglietti=${num_biglietti}&location=${location}&data_p=${data_p}&data_r=${data_r}&dati=${dati}&prezzo=${importo}`);
    }

document.addEventListener('DOMContentLoaded', function() {
    // Il codice per il pulsante "Chiudi" e il reset del form
    document.getElementById('close-button').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('payment-form').reset();
        cardElement.clear();
        document.getElementById('card-errors').textContent = '';
        document.getElementById('pagamento_con_stripe').style.display = "none";
        document.getElementById('popup').classList.remove("open");
        document.getElementById('submit-form-button').disabled = false;
        
    });
});