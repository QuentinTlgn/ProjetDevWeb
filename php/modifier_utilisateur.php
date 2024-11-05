<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Inclure la connexion à la base de données et les fonctions de logs
include('db.php');
include('log_functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier_utilisateur'])) {
    $oldUsername = $_POST['oldUsername'];
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];

    try {
        // Mettre à jour le nom d'utilisateur
        $sql = "UPDATE admins SET username = ? WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$newUsername, $oldUsername]);

        // Ajouter un log pour la mise à jour du nom d'utilisateur
        ajouter_log($pdo, 'Modification Utilisateur', "{$_SESSION['user_id']} a modifié le nom d'utilisateur de $oldUsername à $newUsername.");

        // Mettre à jour le mot de passe si un nouveau mot de passe est fourni
        if (!empty($newPassword)) {
            
            $sql = "UPDATE admins SET password = ? WHERE username = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$newPassword, $newUsername]); 

            // Ajouter un log pour la mise à jour du mot de passe
            ajouter_log($pdo, 'Mise à jour Mot de Passe', "{$_SESSION['user_id']} a mis à jour le mot de passe de $newUsername.");
        }

        header("Location: ../pages/admin_dashboard.php?success=6"); // Message de succès pour la modification
        exit();
    } catch (PDOException $e) {
        // Gérer les erreurs (par exemple, si le nouveau nom d'utilisateur existe déjà)
        echo "Erreur: " . $e->getMessage();
    }
}
?>
