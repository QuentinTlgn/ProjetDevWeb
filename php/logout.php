<?php
session_start();
include 'db.php'; // Assurez-vous que le chemin est correct
include 'log_functions.php'; // Inclure la fonction d'ajout de log

// Ajouter un log pour la déconnexion
if (isset($_SESSION['user_id'])) {
    ajouter_log($pdo, 'Déconnexion', "{$_SESSION['user_id']} s'est déconnecté.");
}

// Détruit toutes les sessions
session_destroy(); 

// Redirige l'utilisateur vers la page de connexion
header("Location: ../index.php");
exit();
?>
