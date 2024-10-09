// Ouvrir la popup quand le bouton Modifier est cliqué
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const titre = this.getAttribute('data-titre');
        const description = this.getAttribute('data-description');

        // Pré-remplir le formulaire avec les données du produit
        document.getElementById('editId').value = id;
        document.getElementById('editTitre').value = titre;
        document.getElementById('editDescription').value = description;

        // Afficher la popup
        document.getElementById('popup').style.display = 'flex';
    });
});

// Fermer la popup
document.getElementById('closePopup').addEventListener('click', function() {
    document.getElementById('popup').style.display = 'none';
});

// Fermer la popup si on clique en dehors du contenu
window.addEventListener('click', function(e) {
    if (e.target === document.getElementById('popup')) {
        document.getElementById('popup').style.display = 'none';
    }
});