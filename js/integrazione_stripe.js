    let form_prenotazione = document.getElementById('booking-form');
    let pag_stripe = document.getElementById('pagamento_con_stripe');

    const MAX=101;

    function prendiDatiAggiuntivi() {
        let formData = new FormData(form_prenotazione);
        let num_biglietti = parseInt(formData.get('tickets-count'));
        let stringa = []; 

        for (let i = 0; i < num_biglietti; i++) {
            const nameEl = document.getElementById("ticket-name-" + i);
            if (nameEl) {
                stringa[i] = "nominativo" + i + ":" + nameEl.value;
            }
        }
    
        const commentsEl = document.getElementById('comments');
        if (commentsEl) {
            stringa[num_biglietti] = "commento:" + commentsEl.value;
        }
    
        return JSON.stringify(stringa);
    }

    function calcolaprezzo(event) {
        event.preventDefault(); 
        
        if (pag_stripe) {
            pag_stripe.style.display = "block";
        }
        document.getElementById('popup').classList.add("open");

        let formData = new FormData(form_prenotazione);
        let num_biglietti = parseInt(formData.get('tickets-count')) || 1;
        let data_p = Date.parse(formData.get('departure-date'));
        let data_r = Date.parse(formData.get('return-date'));
        let bottone_stripe = document.getElementById('submit-button');
        let importoInput = document.getElementById('importo');
        let prenotazioneBtn = document.getElementById('submit-form-button');

        if (isNaN(data_p) || isNaN(data_r)) {
            alert("Per favore, inserisci una data di partenza e ritorno valida.");
            return false;
        }

        // Calcolo prezzo (es: 50€ al giorno per biglietto + 5€ base)
        const diffTime = Math.abs(data_r - data_p);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) || 1;
        let saldo_tot = (diffDays * num_biglietti * 50) + 5;

        bottone_stripe.textContent = `Prenota il tuo viaggio a soli ${saldo_tot}€`;
        importoInput.value = saldo_tot * 100; // In centesimi per Stripe
        prenotazioneBtn.disabled = true;
        
        return false;
    }

    const closeBttn = document.getElementById('close-button');
    if (closeBttn) {
        closeBttn.addEventListener("click", () => {
            document.getElementById('popup').classList.remove("open");
            pag_stripe.style.display = "none";
        });
    }

    const stripe = Stripe('pk_test_51QsWhnRwYugaEVfWZdpr479jZxUCuBKqds9KN0c01v8DtI9PQFFV3MSOwStu8zRt6ri900dIcnhvctZ1NVG9OCKD004ZiiHr18');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');
    const cardErrors = document.getElementById("card-errors");
    const paymentForm = document.getElementById('payment-form');

    cardElement.on('change', (event) => {
        cardErrors.textContent = event.error ? event.error.message : '';
    });

    paymentForm?.addEventListener('submit', async (event) => {
        event.preventDefault();
        const submitBtn = document.getElementById('submit-button');
        submitBtn.disabled = true;

        const amount = parseInt(paymentForm.importo.value);

        try {
            // Creazione PaymentIntent tramite Fetch
            const responseData = await Utils.postData("api/stripe/crea_pagamento.php", {
                importo: amount / 100, // Passiamo in euro se payment.php lo aspetta così, o aggiustiamo
                fullname: paymentForm.fullname.value
            });

            const response = JSON.parse(responseData);

            if (response.error) {
                throw new Error(response.error);
            }

            const clientSecret = response.clientSecret;

            const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: paymentForm.fullname.value,
                    },
                },
            });

            if (error) {
                cardErrors.textContent = `Errore durante il pagamento: ${error.message}`;
                submitBtn.disabled = false;
            } else if (paymentIntent && paymentIntent.status === 'succeeded') {
                alert('Prenotazione completata con successo! Preparati al decollo!');
                document.getElementById('popup').classList.remove("open");
                
                await aggiornaPrenotazione();
                
                window.open('api/stripe/genera_ricevuta_pdf.php', '_blank');
                
                if (pag_stripe) pag_stripe.style.display = "none";
                document.getElementById('submit-form-button').disabled = false;
            }
        } catch (e) {
            console.error('Errore nel processo di pagamento:', e);
            cardErrors.textContent = 'Errore durante la creazione del pagamento.';
            submitBtn.disabled = false;
        }
    });

    async function aggiornaPrenotazione() {
        let formData = new FormData(form_prenotazione);
        const importoInput = document.getElementById('importo');

        const dati = {
            numbiglietti: formData.get('tickets-count'),
            location: formData.get('location'),
            datap: formData.get('departure-date'),
            datar: formData.get('return-date'),
            dati: prendiDatiAggiuntivi(),
            prezzo: importoInput.value
        };

        try {
            const result = await Utils.postData('api/stripe/salva_prenotazione.php', dati);
            console.log("Prenotazione salvata:", result);
        } catch (error) {
            console.error("Errore nel salvataggio della prenotazione:", error);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('close-button')?.addEventListener('click', function(event) {
            event.preventDefault();
            paymentForm.reset();
            cardElement.clear();
            cardErrors.textContent = '';
            document.getElementById('pagamento_con_stripe').style.display = "none";
            document.getElementById('popup').classList.remove("open");
            document.getElementById('submit-form-button').disabled = false;
        });
    });


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