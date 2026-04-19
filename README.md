[![it](https://img.shields.io/badge/lang-it-blue.svg)](https://github.com/CupoMeridio/Sito-di-viaggi---Tecnologie-Web---UNISA-2024-2025/blob/main/README.it.md)

# BeyondReality Journeys - Web Technologies Project (UNISA 2024-2025)
<img width="1213" height="454" alt="Image 2026-04-03 173918" src="https://github.com/user-attachments/assets/182d6dfa-36cd-41cc-8090-22a0af62a9fc" />

## Project Description
This repository contains the source code for a web application dedicated to managing and booking fantasy trips. The project was developed as an exam assignment for the **Web Technologies** course at the University of Salerno (UNISA).

The architecture follows the client-server model, implementing the fundamentals of **HTML5**, **CSS3**, and **JavaScript** for the frontend, with backend logic based on **PHP** and data persistence managed through **MySQL/MariaDB**.

---

## Technical Features and Implementation

### 1. User Management and Authentication
- **Registration and Login**: Implemented via PHP scripts ([elabora_autenticazione.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/elabora_autenticazione.php)) that handle server-side data validation and password hashing using `password_hash()`.
- **Sessions**: Use of `session_start()` to maintain user state and manage access permissions to restricted areas.
- **User Profile**: Support for uploading and displaying profile images stored as `BLOB` data in the MySQL database.

### 2. Booking and Payment System
- **Booking Management**: Data insertion and retrieval logic ([salva_prenotazione.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/stripe/salva_prenotazione.php)) for storing travel details associated with the user account.
- **Stripe Integration**: Implementation of the **Stripe** API ([crea_pagamento.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/stripe/crea_pagamento.php)) for secure transaction processing using `PaymentIntent` with server-side price calculation.
- **Documentation Generation**: Use of the **FPDF** library ([genera_ricevuta_pdf.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/stripe/genera_ricevuta_pdf.php)) to dynamically generate PDF receipts after purchase.

### 3. Asynchronous Interactions and Feedback
- **AJAX**: Use of `fetch` ([gestione_commenti.js](file:///c:/xampp/htdocs/Sito_di_viaggi/js/gestione_commenti.js), [verifica_email_ajax.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/verifica_email_ajax.php)) to send and retrieve data without reloading the page, specifically for:
  - Real-time email validation during registration.
  - Loading and publishing comments and reviews.
- **Review System**: Storage and display of user feedback via dedicated AJAX endpoints.

### 4. Communications and Notifications
- **PHPMailer**: Integration of the **PHPMailer** library ([servizio_email.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/servizio_email.php)) for sending email notifications via SMTP protocol (Brevo/Gmail).

---

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla).
- **Backend**: PHP 8.x.
- **Database**: MySQL/MariaDB (via `mysqli` extension).
- **External Libraries** (managed via Composer):
  - [Stripe PHP SDK](https://github.com/stripe/stripe-php)
  - [PHPMailer](https://github.com/PHPMailer/PHPMailer)
  - [FPDF](http://www.fpdf.org/)

---

## Environment Configuration

### Requirements
- HTTP Server (Apache) with PHP support.
- Active MySQL instance.
- Enabled PHP extensions: `mysqli`, `curl`, `openssl`.

### Configuration Parameters
Database credentials and API keys must be configured in the [config.php](file:///c:/xampp/htdocs/Sito_di_viaggi/api/config.php) file (created from `config.example.php`). The project uses a centralized configuration system for database, Stripe, and email services.

### Database Schema (Logical)
- **utente**: `(id_utente, nome, cognome, username, email, password, img, type)`
- **prenotazione**: `(id_prenotazione, email, nome, cognome, destinazione, data)`
- **commento**: `(id_commento, email, username, testo, mondo, stelle)`

---

## Workspace Structure

```text
.
├── api/                        # Backend logic and API endpoints
│   ├── stripe/                 # Payments module (Stripe, FPDF)
│   │   ├── crea_pagamento.php  # Transaction initialization
│   │   ├── salva_prenotazione.php # Save data after purchase
│   │   └── genera_ricevuta_pdf.php # PDF receipt generation
│   ├── config.php              # Centralized configuration (Database, API keys)
│   ├── connessione_db.php      # MySQL DB connection
│   ├── elabora_autenticazione.php # Login/Registration logic
│   └── servizio_email.php      # PHPMailer integration
├── components/                 # Reusable UI components
│   ├── navbar.php              # Dynamic navigation bar
│   ├── dashboard.html          # User account interface
│   └── footer.html             # Common footer
├── css/                        # Stylesheets organized by component
├── img/                        # Graphic assets divided by worlds
├── js/                         # Client-side scripts (Stripe, AJAX, Animations)
│   ├── integrazione_stripe.js  # Payment flow management
│   └── gestione_commenti.js    # Asynchronous logic for reviews
├── vendor/                     # Dependencies installed via Composer
├── index.php                   # Landing Page
├── autenticazione.php          # Login and Registration page
├── viaggio_dragonball.php      # Thematic page: Dragon Ball world
├── viaggio_doctorwho.php       # Thematic page: Doctor Who world
└── viaggio_jojos.php           # Thematic page: Jojo's Bizarre Adventure world

## 📸Gallery
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