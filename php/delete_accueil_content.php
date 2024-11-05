<?php
include('../php/db.php'); // Inclure le fichier de connexion à la base de données

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparer la requête de suppression
    $sql = "DELETE FROM accueil_content WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Définir la valeur du paramètre
    $stmt->bindParam(':id', $id);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Rediriger vers la page d'administration avec un message de succès
        header('Location: ../pages/admin_dashboard.php');
        exit();
    } else {
        // Afficher un message d'erreur si la suppression a échoué
        echo "Erreur lors de la suppression du contenu.";
    }
}
?>