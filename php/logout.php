<?php
session_start();
session_destroy(); // Détruit toutes les sessions

// Redirige l'utilisateur vers la page de connexion
header("Location: ../index.php");
exit();
?>
