// Funzione per mostrare un elemento con dissolvenza
function showWithFadeIn(element) {
	setTimeout(function() {
    element.style.display = 'block';  // Imposta display su block per renderlo visibile
	},500); //Dopo 0.5s, (durata della transizione di dissolvenza)
    setTimeout(function() {
        element.classList.add('show');  // Aggiungi la classe 'show' per animare l'opacità
    },1000); // Un piccolo timeout per applicare il cambiamento di display prima dell'animazione
}

// Funzione per nascondere un elemento con display:none
function hideElement(element) {
    element.classList.remove('show');  // Rimuovi la classe 'show' per farlo svanire
    setTimeout(function() {
        element.style.display = 'none';  // Imposta display su none dopo l'animazione
    },500);  // Dopo 0,5s secondo (tempo della transizione di dissolvenza)
}

document.getElementById('location1').addEventListener('click', function () {
	hideElement(document.getElementById('info_location2'));
    hideElement(document.getElementById('info_location3'));
    showWithFadeIn(document.getElementById('info_location1'));

});

document.getElementById('location2').addEventListener('click', function () {
	hideElement(document.getElementById('info_location1'));
    hideElement(document.getElementById('info_location3'));
    showWithFadeIn(document.getElementById('info_location2'));

});

document.getElementById('location3').addEventListener('click', function () {
	hideElement(document.getElementById('info_location1'));
    hideElement(document.getElementById('info_location2'));
    showWithFadeIn(document.getElementById('info_location3'));

});




document.getElementById('tickets-count').addEventListener('input', function() {
    const ticketsCount = parseInt(this.value) || 1;
    const container = document.getElementById('ticket-names-container');
    container.innerHTML = '';
    
    for (let i = 0; i < ticketsCount; i++) {
      const label = document.createElement('label');
      label.setAttribute("for", `ticket-name-${i}`);
      label.textContent = `Nome Passeggero ${i + 1}:`;
      
      const input = document.createElement('input');
      input.setAttribute("type", "text");
      input.setAttribute("id", `ticket-name-${i}`);
      input.setAttribute("name", `ticket-name-${i}`);
      input.setAttribute("required", "");
      input.setAttribute("placeholder", `Nome Passeggero ${i + 1}`);
      
      container.appendChild(label);
      container.appendChild(input);
    }
  });
  

