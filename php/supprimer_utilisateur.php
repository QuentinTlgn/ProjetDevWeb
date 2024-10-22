<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: admin_login.php");
    exit();
}

include('db.php');
include('log_functions.php'); // Assurez-vous que le chemin est correct

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    try {
        // Préparer et exécuter la requête pour supprimer l'administrateur
        $sql = "DELETE FROM admins WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);

        // Ajouter un log pour la suppression de l'administrateur
        ajouter_log($pdo, 'Suppression Administrateur', "{$_SESSION['user_id']} a supprimé l'administrateur '$username'.");

        // Redirection avec un message de succès
        header("Location: ../pages/admin_dashboard.php?success=7"); // Message de succès pour la suppression
        exit();
    } catch (PDOException $e) {
        // Gérer les erreurs
        echo "Erreur: " . $e->getMessage();
    }
}
?>
