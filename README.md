# BeyondReality Journeys - Progetto di Tecnologie Web (UNISA 2024-2025)
<img width="1213" height="454" alt="Immagine 2026-04-03 173918" src="https://github.com/user-attachments/assets/182d6dfa-36cd-41cc-8090-22a0af62a9fc" />

## Descrizione del Progetto
Il presente repository contiene il codice sorgente per un'applicazione web dedicata alla gestione e prenotazione di viaggi fantasy. Il progetto è stato realizzato come prova d'esame per il corso di **Tecnologie Web** dell'Università degli Studi di Salerno (UNISA).

L'architettura segue il modello client-server, implementando i fondamenti di **HTML5**, **CSS3** e **JavaScript** per il frontend, con una logica di backend basata su **PHP** e gestione della persistenza tramite **PostgreSQL**.

---

## Caratteristiche Tecniche e Implementazione

### 1. Gestione Utenti e Autenticazione
- **Registrazione e Login**: Implementati tramite script PHP ([logreg.php](file:///c:/Users/cupom/Downloads/Sito-di-viaggi---Tecnologie-Web---UNISA-2024-2025/logreg.php)) che gestiscono la validazione dei dati lato server e l'hashing delle password tramite `password_hash()`.
- **Sessioni**: Utilizzo di `session_start()` per il mantenimento dello stato dell'utente e la gestione dei permessi di accesso alle aree riservate.
- **Profilo Utente**: Supporto per il caricamento e la visualizzazione di immagini di profilo memorizzate come dati `bytea` nel database PostgreSQL.

### 2. Sistema di Prenotazione e Pagamento
- **Gestione Prenotazioni**: Logica di inserimento e recupero dati ([prenotazioni.php](file:///c:/Users/cupom/Downloads/Sito-di-viaggi---Tecnologie-Web---UNISA-2024-2025/stripe/prenotazioni.php)) per la memorizzazione dei dettagli di viaggio associati all'account utente.
- **Integrazione Stripe**: Implementazione dell'API di pagamento **Stripe** ([payment.php](file:///c:/Users/cupom/Downloads/Sito-di-viaggi---Tecnologie-Web---UNISA-2024-2025/stripe/payment.php)) per l'elaborazione sicura delle transazioni tramite `PaymentIntent`.
- **Generazione Documentazione**: Utilizzo della libreria **FPDF** ([gen_pdf.php](file:///c:/Users/cupom/Downloads/Sito-di-viaggi---Tecnologie-Web---UNISA-2024-2025/stripe/gen_pdf.php)) per la creazione dinamica di ricevute in formato PDF al termine dell'acquisto.

### 3. Interazioni Asincrone e Feedback
- **AJAX**: Utilizzo di `XMLHttpRequest` o `fetch` ([commenti.js](file:///c:/Users/cupom/Downloads/Sito-di-viaggi---Tecnologie-Web---UNISA-2024-2025/commenti.js), [controlloEmailAjax.php](file:///c:/Users/cupom/Downloads/Sito-di-viaggi---Tecnologie-Web---UNISA-2024-2025/controlloEmailAjax.php)) per l'invio e il recupero di dati senza ricaricare la pagina, specificamente per:
  - Validazione in tempo reale dell'email in fase di registrazione.
  - Caricamento e pubblicazione di commenti e recensioni.
- **Sistema di Recensioni**: Archiviazione e visualizzazione di feedback utente con valutazione numerica (stelle).

### 4. Comunicazioni e Notifiche
- **PHPMailer**: Integrazione della libreria **PHPMailer** ([invia_email.php](file:///c:/Users/cupom/Downloads/Sito-di-viaggi---Tecnologie-Web---UNISA-2024-2025/invia_email.php)) per l'invio di notifiche email via protocollo SMTP (Gmail).

---

## Tecnologie Utilizzate

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla).
- **Backend**: PHP 8.x.
- **Database**: PostgreSQL (con driver `pg_connect`).
- **Librerie Esterne**:
  - [Stripe PHP SDK](https://github.com/stripe/stripe-php)
  - [PHPMailer](https://github.com/PHPMailer/PHPMailer)
  - [FPDF](http://www.fpdf.org/)

---

## Configurazione dell'Ambiente

### Requisiti
- Server HTTP (Apache) con supporto PHP.
- Istanza PostgreSQL attiva.
- Estensioni PHP abilitate: `pgsql`, `curl`, `openssl`.

### Parametri di Connessione
Le credenziali del database devono essere configurate nel file [connection.php](file:///c:/Users/cupom/Downloads/Sito-di-viaggi---Tecnologie-Web---UNISA-2024-2025/connection.php). Il progetto supporta configurazioni separate per ambienti di sviluppo locali e server remoti.

### Schema del Database (Logico)
- **utente**: `(id_utente, nome, cognome, username, email, password, img, type)`
- **prenotazione**: `(id_prenotazione, email, nome, cognome, destinazione, data)`
- **commento**: `(id_commento, email, username, testo, mondo, stelle)`

---

## Struttura del Workspace

```text
.
├── PHPMailer/                  # Libreria PHPMailer per invio email via SMTP
│   └── PHPMailer-master/
│       └── src/                # File sorgenti di PHPMailer (PHPMailer.php, SMTP.php, etc.)
├── commons/                    # Componenti UI e stili condivisi
│   ├── dashboard.html          # Interfaccia dashboard utente
│   ├── navbar.php              # Barra di navigazione dinamica
│   ├── setIcon.html            # Gestione delle icone della pagina
│   └── *Style.css              # Fogli di stile modulari per i componenti
├── immagini/                   # Asset grafici (JPG, PNG, WebP)
│   ├── DragonBall/             # Risorse specifiche per il mondo Dragon Ball
│   ├── logo.png                # Logo ufficiale del sito
│   └── ...
├── stripe/                     # Modulo per pagamenti e documentazione PDF
│   ├── fpdf/                   # Libreria FPDF per la generazione di PDF
│   ├── vendor/                 # Dipendenze Stripe (SDK) via Composer
│   ├── config.php              # Configurazione delle chiavi API Stripe
│   ├── gen_pdf.php             # Script per la creazione della ricevuta d'acquisto
│   ├── payment.php             # Gestione del PaymentIntent lato server
│   ├── prenotazioni.php        # Logica di salvataggio prenotazioni post-pagamento
│   └── stripe.js               # Gestione client-side del flusso di pagamento
├── index.php                   # Entry point dell'applicazione (Landing Page)
├── logreg.php                  # Logica di backend per Login e Registrazione
├── connection.php              # Script di configurazione database PostgreSQL
├── commenti.js                 # Gestione asincrona (AJAX) delle recensioni
├── commenti.php                # Salvataggio recensioni nel database
├── registrazione.php           # Form di registrazione e login utente
├── dragonball.php              # Pagina tematica: Mondo Dragon Ball
├── doctorwho.php               # Pagina tematica: Mondo Doctor Who
└── jojos.php                   # Pagina tematica: Mondo Jojo's Bizarre Adventure
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


