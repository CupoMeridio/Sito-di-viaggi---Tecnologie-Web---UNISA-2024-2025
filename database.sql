-- Script di creazione database per il sito di viaggi fantasia
-- MySQL (compatibile con XAMPP e InfinityFree)

CREATE DATABASE IF NOT EXISTS sito_viaggi_fantasia;
USE sito_viaggi_fantasia;

-- Tabella utenti
CREATE TABLE IF NOT EXISTS utente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cognome VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    img LONGBLOB,
    type VARCHAR(50),
    data_registrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabella prenotazioni
CREATE TABLE IF NOT EXISTS prenotazione (
    id_prenotazione INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    cognome VARCHAR(100) NOT NULL,
    data VARCHAR(100) NOT NULL, -- Formato legacy: {data_p,data_r}
    destinazione VARCHAR(100) NOT NULL,
    data_prenotazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (email) REFERENCES utente(email) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabella commenti
CREATE TABLE IF NOT EXISTS commento (
    id_testo INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(100) NOT NULL,
    testo TEXT NOT NULL,
    mondo VARCHAR(50) NOT NULL,
    stelle INT DEFAULT 0,
    data_commento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (email) REFERENCES utente(email) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Indici per migliorare le performance
CREATE INDEX idx_prenotazione_email ON prenotazione(email);
CREATE INDEX idx_commento_mondo ON commento(mondo);
CREATE INDEX idx_commento_email ON commento(email);