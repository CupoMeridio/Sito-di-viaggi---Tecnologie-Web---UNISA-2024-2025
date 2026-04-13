# BeyondReality Journeys - Progetto di Tecnologie Web (UNISA 2024-2025)
<img width="1213" height="454" alt="Immagine 2026-04-03 173918" src="https://github.com/user-attachments/assets/182d6dfa-36cd-41cc-8090-22a0af62a9fc" />

## Descrizione del Progetto
Il presente repository contiene il codice sorgente per un'applicazione web dedicata alla gestione e prenotazione di viaggi fantasy. Il progetto è stato realizzato come prova d'esame per il corso di **Tecnologie Web** dell'Università degli Studi di Salerno (UNISA).

L'architettura segue il modello client-server, implementando i fondamenti di **HTML5**, **CSS3** e **JavaScript** per il frontend, con una logica di backend basata su **PHP** e gestione della persistenza tramite **MySQL/MariaDB**.

---

## Caratteristiche Tecniche e Implementazione

### 1. Gestione Utenti e Autenticazione
- **Registrazione e Login**: Implementati tramite script PHP ([elabora_autenticazione.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/elabora_autenticazione.php)) che gestiscono la validazione dei dati lato server e l'hashing delle password tramite `password_hash()`.
- **Sessioni**: Utilizzo di `session_start()` per il mantenimento dello stato dell'utente e la gestione dei permessi di accesso alle aree riservate.
- **Profilo Utente**: Supporto per il caricamento e la visualizzazione di immagini di profilo memorizzate come dati `BLOB` nel database MySQL.

### 2. Sistema di Prenotazione e Pagamento
- **Gestione Prenotazioni**: Logica di inserimento e recupero dati ([salva_prenotazione.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/stripe/salva_prenotazione.php)) per la memorizzazione dei dettagli di viaggio associati all'account utente.
- **Integrazione Stripe**: Implementazione dell'API di pagamento **Stripe** ([crea_pagamento.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/stripe/crea_pagamento.php)) per l'elaborazione sicura delle transazioni tramite `PaymentIntent` con calcolo del prezzo lato server.
- **Generazione Documentazione**: Utilizzo della libreria **FPDF** ([genera_ricevuta_pdf.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/stripe/genera_ricevuta_pdf.php)) per la creazione dinamica di ricevute in formato PDF al termine dell'acquisto.

### 3. Interazioni Asincrone e Feedback
- **AJAX**: Utilizzo di `fetch` ([gestione_commenti.js](file:///c:/xampp/htdocs/Sito_di_viaggi/js/gestione_commenti.js), [verifica_email_ajax.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/verifica_email_ajax.php)) per l'invio e il recupero di dati senza ricaricare la pagina, specificamente per:
  - Validazione in tempo reale dell'email in fase di registrazione.
  - Caricamento e pubblicazione di commenti e recensioni.
- **Sistema di Recensioni**: Archiviazione e visualizzazione di feedback utente tramite endpoint AJAX dedicati.

### 4. Comunicazioni e Notifiche
- **PHPMailer**: Integrazione della libreria **PHPMailer** ([servizio_email.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/servizio_email.php)) per l'invio di notifiche email via protocollo SMTP (Brevo/Gmail).

---

## Tecnologie Utilizzate

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla).
- **Backend**: PHP 8.x.
- **Database**: MySQL/MariaDB (tramite estensione `mysqli`).
- **Librerie Esterne** (gestite via Composer):
  - [Stripe PHP SDK](https://github.com/stripe/stripe-php)
  - [PHPMailer](https://github.com/PHPMailer/PHPMailer)
  - [FPDF](http://www.fpdf.org/)

---

## Configurazione dell'Ambiente

### Requisiti
- Server HTTP (Apache) con supporto PHP.
- Istanza MySQL attiva.
- Estensioni PHP abilitate: `mysqli`, `curl`, `openssl`.

### Parametri di Configurazione
Le credenziali del database e le chiavi API devono essere configurate nel file [config.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/config.php) (creato a partire da `config.example.php`). Il progetto utilizza un sistema di configurazione centralizzato per database, Stripe e servizi email.

### Schema del Database (Logico)
- **utente**: `(id_utente, nome, cognome, username, email, password, img, type)`
- **prenotazione**: `(id_prenotazione, email, nome, cognome, destinazione, data)`
- **commento**: `(id_commento, email, username, testo, mondo, stelle)`

---

## Struttura del Workspace

```text
.
├── api/                        # Logica di backend e endpoint API
│   ├── stripe/                 # Modulo pagamenti (Stripe, FPDF)
│   │   ├── crea_pagamento.php  # Inizializzazione transazione
│   │   ├── salva_prenotazione.php # Salvataggio dati post-acquisto
│   │   └── genera_ricevuta_pdf.php # Creazione ricevuta PDF
│   ├── config.php              # Configurazione centralizzata (Database, API keys)
│   ├── connessione_db.php      # Connessione al DB MySQL
│   ├── elabora_autenticazione.php # Logica Login/Registrazione
│   └── servizio_email.php      # Integrazione PHPMailer
├── components/                 # Componenti UI riutilizzabili
│   ├── navbar.php              # Barra di navigazione dinamica
│   ├── dashboard.html          # Interfaccia account utente
│   └── footer.html             # Piè di pagina comune
├── css/                        # Fogli di stile organizzati per componente
├── img/                        # Asset grafici suddivisi per mondi
├── js/                         # Script client-side (Stripe, AJAX, Animazioni)
│   ├── integrazione_stripe.js  # Gestione flusso pagamento
│   └── gestione_commenti.js    # Logica asincrona per recensioni
├── vendor/                     # Dipendenze installate tramite Composer
├── index.php                   # Landing Page del sito
├── autenticazione.php          # Pagina Login e Registrazione
├── viaggio_dragonball.php      # Pagina tematica: Mondo Dragon Ball
├── viaggio_doctorwho.php       # Pagina tematica: Mondo Doctor Who
└── viaggio_jojos.php           # Pagina tematica: Mondo Jojo's Bizarre Adventure
```
---

## 📸Galleria
<table align="center">
  <thead>
    <tr>
      <th>Login</th>
      <th>Registrazione</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><img alt="Immagine1" src="https://github.com/user-attachments/assets/8fc060ed-7cfc-4443-a599-008fa3855271"/></td>
      <td><img width="376" height="243" alt="Immagine2" src="https://github.com/user-attachments/assets/9b87250b-495d-4579-a1fe-71c52236761b"/></td>
    </tr>
</tbody>
</table>
<table align="center">
  <thead>
    <tr>
      <th>Home page</th>
      <th>Dragon Ball page</th>
      <th>Doctor Who page</th>
      <th>Jojo page</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><img width="267" height="454" alt="Immagine3" src="https://github.com/user-attachments/assets/46d918a0-c5f8-4e82-b6d1-51e366785402"/></td>
      <td><img width="183" height="471" alt="Immagine4" src="https://github.com/user-attachments/assets/c9785e13-088d-481a-b946-27662d76ba2c"/></td>
      <td><img width="190" height="471" alt="Immagine5" src="https://github.com/user-attachments/assets/08c39b9f-78f7-47b5-9012-c494e8d4d5c2"/></td>
      <td><img width="185" height="471" alt="Immagine6" src="https://github.com/user-attachments/assets/68073c3e-d3da-47c2-ae2f-2bdcc8aa85f3"/></td>
    </tr>
</tbody>
</table>


