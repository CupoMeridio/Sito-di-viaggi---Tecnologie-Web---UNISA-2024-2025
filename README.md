# BeyondReality Journeys - Progetto di Tecnologie Web (UNISA 2024-2025)

## Descrizione del Progetto
Applicazione web dedicata alla gestione e prenotazione di viaggi fantasy, realizzata per il corso di **Tecnologie Web**.

---

## Struttura del Progetto (Aggiornata)

L'architettura è stata riorganizzata per essere modulare e professionale, con nomi dei file in italiano descrittivo.

### 📂 Root Directory (Pagine Principali)
- `index.php`: Landing page del sito.
- `autenticazione.php`: Gestione login e registrazione.
- `gestione_profilo.php`: Modifica dati utente e impostazioni account.
- `recupero_password.php`: Procedura di reset password via email.
- `viaggio_doctorwho.php`: Destinazione a tema Doctor Who.
- `viaggio_dragonball.php`: Destinazione a tema Dragon Ball.
- `viaggio_jojos.php`: Destinazione a tema Jojo's Bizarre Adventure.

### 📂 /api (Logica di Backend)
- `config.php`: File di configurazione centralizzato (Database, Stripe, Email).
- `connessione_db.php`: Script centralizzato per la connessione al database.
- `elabora_autenticazione.php`: Gestione flussi login/registrazione.
- `recupera_commenti_ajax.php`: Endpoint per il caricamento dinamico dei commenti.
- `salva_commento_ajax.php`: Endpoint per il salvataggio dei nuovi commenti.
- `servizio_email.php`: Integrazione con PHPMailer per invio notifiche.
- `validazione_generale.php`: Funzioni di controllo pattern e sicurezza.
- `logout_utente.php`: Gestione della chiusura sessione.

### 📂 /api/stripe (Pagamenti)
- `configurazione_stripe.php`: Caricamento SDK via Composer.
- `crea_pagamento.php`: Inizializzazione transazione Stripe con calcolo prezzo lato server.
- `salva_prenotazione.php`: Salvataggio dati post-pagamento.
- `genera_ricevuta_pdf.php`: Creazione PDF della ricevuta tramite FPDF.

### 📂 /css (Stili)
- `stile_navbar.css`, `stile_footer.css`, `stile_home.css`, etc.

### 📂 /js (Script)
- `logica_autenticazione.js`, `gestione_commenti.js`, `integrazione_stripe.js`, etc.

### 📂 /img (Asset)
- Suddivisa per mondi e componenti comuni (`/common`).

---

## Requisiti e Installazione
1. **Composer**: Eseguire `php composer.phar install` per installare le dipendenze (Stripe, PHPMailer, FPDF).
2. **Database**: Configurare i parametri in `api/config.php`.
3. **Server**: Apache con PHP 8.x e MySQL/MariaDB.
