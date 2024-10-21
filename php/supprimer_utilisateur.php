<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: admin_login.php");
    exit();
}

include('db.php');

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    try {
        $sql = "DELETE FROM admins WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);

        header("Location: ../pages/admin_dashboard.php?success=7"); // Message de succès pour la suppression
        exit();
    } catch (PDOException $e) {
        // Gérer les erreurs
        echo "Erreur: " . $e->getMessage();
    }
}
?>