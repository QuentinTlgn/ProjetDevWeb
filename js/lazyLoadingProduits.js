// Fonction pour ouvrir la lightbox et charger l'image
document.querySelectorAll('a[href^="#lightbox"]').forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        var lightbox = document.querySelector(link.getAttribute('href'));
        var img = lightbox.querySelector('img');

        // Charger l'image seulement si elle n'est pas encore chargée
        if (img && !img.src) {
            img.src = img.getAttribute('data-src');
        }

        // Afficher la lightbox
        lightbox.style.display = 'flex';
    });
});

// Fonction pour fermer la lightbox
document.querySelectorAll('.lightbox .close').forEach(function(closeButton) {
    closeButton.addEventListener('click', function(event) {
        event.preventDefault();
        this.parentElement.style.display = 'none';
    });
});