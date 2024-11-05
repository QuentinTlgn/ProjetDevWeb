<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/admin_login.php");
    exit();
}

include('../php/db.php'); // Inclure le fichier de connexion à la base de données
include 'log_functions.php'; // Inclure la fonction d'ajout de log

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $content = $_POST['content'];

    // Préparer la requête de mise à jour
    $sql = "UPDATE accueil_content SET type = :type, content = :content WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Définir les valeurs des paramètres
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':content', $content);

    ajouter_log($pdo, 'Modification contenu accueil', "Contenu avec ID $id modifié par {$_SESSION['user_id']}");

    // Exécuter la requête
    if ($stmt->execute()) {
        // Rediriger vers la page d'administration avec un message de succès
        header('Location: ../pages/admin_dashboard.php?success=10');
        exit();
    } else {
        // Afficher un message d'erreur si la mise à jour a échoué
        echo "Erreur lors de la modification du contenu.";
    }
}
?>