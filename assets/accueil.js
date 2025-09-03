function openPopup() {
    var popup = document.getElementById('popup');
    popup.style.display = 'block';
}

function closePopup() {
    var popup = document.getElementById('popup');
    popup.style.display = 'none';
}

const consentForm = document.getElementById('consentForm');
const accessAppButton = document.getElementById('accessApp');


document.addEventListener('DOMContentLoaded', () => {
    accessAppButton.classList.add('disabled');
    accessAppButton.setAttribute('aria-disabled', 'true');
    accessAppButton.setAttribute('tabindex', '-1'); 
});

consentForm.addEventListener('submit', function(event) {
    event.preventDefault(); 

   
    const participationConsent = document.getElementById('participationConsent').checked;
    const resultsReuseConsent = document.getElementById('resultsReuseConsent').checked;

    if (participationConsent && resultsReuseConsent) {
        alert('Merci pour votre consentement !');
        accessAppButton.classList.remove('disabled');
        accessAppButton.removeAttribute('aria-disabled');
        accessAppButton.removeAttribute('tabindex');
        closePopup(); 
    } else {
        alert('Veuillez cocher les deux cases pour valider votre consentement.');
    }
});