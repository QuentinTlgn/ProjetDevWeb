
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