/**
 * BeyondReality Journeys - Utility Library
 * Contiene funzioni comuni per validazione, sicurezza e comunicazioni AJAX.
 */

const Utils = {
    /**
     * Sanitizza una stringa per prevenire XSS.
     * @param {string} str 
     * @returns {string}
     */
    sanitizeHTML(str) {
        if (!str) return "";
        const temp = document.createElement('div');
        temp.textContent = str;
        return temp.innerHTML;
    },

    /**
     * Pattern di validazione Regex.
     */
    patterns: {
        email: /^[a-zA-Z0-9_.±]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
        password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_])[A-Za-z\d@$!%*?&_]{8,}$/,
        nome: /^[a-zA-Z][a-zA-Z0-9]*$/,
        cognome: /^[a-zA-Z]+$/
    },

    /**
     * Provider email supportati (dal codice originale).
     */
    emailProviders: [
        "@gmail.com", "@outlook.com", "@yahoo.com", "@icloud.com", "@protonmail.com",
        "@zoho.com", "@gmx.com", "@aol.com", "@mail.com", "@libero.it", "@tiscali.it",
        "@fastwebnet.it", "@email.it", "@aruba.it", "@kataweb.it", "@studenti.unisa.it",
        "@hotmail.it", "@hotmail.com"
    ],

    /**
     * Valida una mail controllando regex e provider.
     */
    isValidEmail(email) {
        if (!this.patterns.email.test(email)) return false;
        const dominio = "@" + email.split('@')[1];
        return this.emailProviders.includes(dominio);
    },

    /**
     * Wrapper per Fetch API con gestione errori.
     */
    async postData(url, data = {}) {
        const formData = new URLSearchParams();
        for (const key in data) {
            formData.append(key, data[key]);
        }

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: formData.toString()
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            return await response.text();
        } catch (error) {
            console.error("Fetch Error:", error);
            throw error;
        }
    },

    /**
     * Mostra un messaggio di errore sotto un elemento.
     */
    showError(elementId, message) {
        const errorEl = document.getElementById(elementId);
        if (errorEl) {
            errorEl.textContent = message;
            errorEl.style.color = "red";
        }
    },

    /**
     * Cancella un messaggio di errore.
     */
    clearError(elementId) {
        const errorEl = document.getElementById(elementId);
        if (errorEl) {
            errorEl.textContent = "";
        }
    }
};
