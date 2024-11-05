// Gestionnaire d'événements pour les boutons "Voir le message"
const viewMessageBtns = document.querySelectorAll('.view-message-btn');
const messagePopup = document.getElementById('messagePopup');
const messageContent = document.getElementById('messageContent');
const closeMessagePopup = document.getElementById('closeMessagePopup');

viewMessageBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const messageId = btn.dataset.id;

        // Faire une requête AJAX pour récupérer le contenu du message
        fetch(`../php/get_message_content.php?id=${messageId}`)
            .then(response => response.text())
            .then(content => {
                messageContent.innerHTML = content;
                messagePopup.style.display = 'flex';
            });
    });
});

// Fermer la popup
closeMessagePopup.addEventListener('click', () => {
    messagePopup.style.display = 'none';
});

// Gestionnaire d'événements pour les boutons "Supprimer le message"
const deleteMessageBtns = document.querySelectorAll('.delete-message-btn');

deleteMessageBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const messageId = btn.dataset.id;

        if (confirm("Êtes-vous sûr de vouloir supprimer ce message ?")) {
            // Faire une requête AJAX pour supprimer le message
            fetch(`../php/delete_message.php?id=${messageId}`)
                .then(response => {
                    if (response.ok) {
                        // Recharger la page ou mettre à jour le tableau des messages
                        location.reload(); // Solution simple : recharge la page
                    } else {
                        alert("Erreur lors de la suppression du message.");
                    }
                });
        }
    });
});

// Gestionnaire d'événements pour les boutons "Supprimer le contenu"
const deleteContentBtns = document.querySelectorAll('.delete-content-btn');

deleteContentBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const contentId = btn.dataset.id;

        if (confirm("Êtes-vous sûr de vouloir supprimer cet élément ?")) {
            // Faire une requête AJAX pour supprimer le contenu
            fetch(`../php/delete_accueil_content.php?id=${contentId}`)
                .then(response => {
                    if (response.ok) {
                        // Recharger la page ou mettre à jour le tableau
                        location.reload();
                    } else {
                        alert("Erreur lors de la suppression de l'élément.");
                    }
                });
        }
    });
});


// Gestion de la popup pour modifier un utilisateur
const editUserButtons = document.querySelectorAll('.edit-user-btn');
const userPopup = document.getElementById('userPopup');
const closeUserPopup = document.getElementById('closeUserPopup');
const editUserForm = document.getElementById('editUserForm');
const editUsernameInput = document.getElementById('editUsername');
const newEditUsernameInput = document.getElementById('newEditUsername');
const newEditPasswordInput = document.getElementById('newEditPassword');

editUserButtons.forEach(button => {
    button.addEventListener('click', function() {
        const username = this.dataset.username;
        editUsernameInput.value = username;
        newEditUsernameInput.value = username; // Pré-remplir le nouveau nom d'utilisateur
        newEditPasswordInput.value = ''; // Vider le champ du mot de passe
        userPopup.style.display = 'flex';
    });
});

closeUserPopup.addEventListener('click', function() {
    userPopup.style.display = 'none';
});

// Gestion de la suppression d'un utilisateur
const deleteUserButtons = document.querySelectorAll('.delete-user-btn');

deleteUserButtons.forEach(button => {
    button.addEventListener('click', function() {
        const username = this.dataset.username;

        // Rediriger vers un script PHP pour supprimer l'utilisateur
        window.location.href = `../php/supprimer_utilisateur.php?username=${username}`;
    });
});

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