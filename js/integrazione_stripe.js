    let form_prenotazione = document.getElementById('booking-form');
    let pag_stripe = document.getElementById('pagamento_con_stripe');
    let stripe, elements, cardElement;

    const MAX = 101;

    // Inizializza Stripe solo quando necessario
    async function inizializzaStripe() {
        if (stripe) return; // Già inizializzato

        // Carica dinamicamente lo script di Stripe se non è presente
        if (typeof Stripe === 'undefined') {
            await new Promise((resolve, reject) => {
                const script = document.createElement('script');
                script.src = 'https://js.stripe.com/v3/';
                script.onload = resolve;
                script.onerror = reject;
                document.head.appendChild(script);
            });
        }

        stripe = Stripe('pk_test_51TLVWQFXztomsFI9FjM50aWflNeIU8Swoq6T6MB9RfBFoXRCx3EKrO63n101Y9nzhynNNsBrLfXlNxW5wSSUDgHI00SafNbcvN');
        elements = stripe.elements();
        cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const cardErrors = document.getElementById("card-errors");
        cardElement.on('change', (event) => {
            cardErrors.textContent = event.error ? event.error.message : '';
        });
    }

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

    async function calcolaprezzo(event) {
        event.preventDefault(); 
        
        // Inizializziamo Stripe solo quando l'utente clicca su Prenota
        await inizializzaStripe();

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

        const diffTime = Math.abs(data_r - data_p);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) || 1;
        let saldo_tot = (diffDays * num_biglietti * 50) + 5;

        bottone_stripe.textContent = `Prenota il tuo viaggio a soli ${saldo_tot}€`;
        importoInput.value = saldo_tot * 100; // In centesimi per Stripe
        prenotazioneBtn.disabled = true;
        
        return false;
    }

    // Gestione chiusura e submit
    document.addEventListener('DOMContentLoaded', function() {
        const closeBttn = document.getElementById('close-button');
        const paymentForm = document.getElementById('payment-form');
        const cardErrors = document.getElementById("card-errors");

        closeBttn?.addEventListener("click", (event) => {
            event.preventDefault();
            document.getElementById('popup').classList.remove("open");
            if (pag_stripe) pag_stripe.style.display = "none";
            document.getElementById('submit-form-button').disabled = false;
            if (paymentForm) paymentForm.reset();
            if (cardElement) cardElement.clear();
            if (cardErrors) cardErrors.textContent = '';
        });

        paymentForm?.addEventListener('submit', async (event) => {
            event.preventDefault();
            const submitBtn = document.getElementById('submit-button');
            submitBtn.disabled = true;

            let formData = new FormData(form_prenotazione);
            const num_biglietti = formData.get('tickets-count') || 1;
            const data_p = formData.get('departure-date');
            const data_r = formData.get('return-date');

            try {
                const responseData = await Utils.postData("api/stripe/crea_pagamento.php", {
                    num_biglietti: num_biglietti,
                    data_p: data_p,
                    data_r: data_r,
                    fullname: paymentForm.fullname.value
                });

                const response = JSON.parse(responseData);
                if (response.error) throw new Error(response.error);

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