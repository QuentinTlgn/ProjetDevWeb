<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: admin_login.php");
    exit();
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier_utilisateur'])) {
    $oldUsername = $_POST['oldUsername'];
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];

    try {
        // Mettre à jour le nom d'utilisateur
        $sql = "UPDATE admins SET username = ? WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$newUsername, $oldUsername]);

        // Mettre à jour le mot de passe si un nouveau mot de passe est fourni
        if (!empty($newPassword)) {
            // Hacher le nouveau mot de passe

            $sql = "UPDATE admins SET password = ? WHERE username = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$newPassword, $newUsername]); 
        }

        header("Location: ../pages/admin_dashboard.php?success=6"); // Message de succès pour la modification
        exit();
    } catch (PDOException $e) {
        // Gérer les erreurs (par exemple, si le nouveau nom d'utilisateur existe déjà)
        echo "Erreur: " . $e->getMessage();
    }
}
?>