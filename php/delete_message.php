<?php

session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/admin_login.php");
    exit();
}

include('../php/db.php');
include('../php/log_functions.php');

if (isset($_GET['id'])) {
    $messageId = $_GET['id'];

    // Supprimer le message de la base de données
    $sql = "DELETE FROM messages WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$messageId]);

    ajouter_log($pdo, 'Suppression Message', "{$_SESSION['user_id']} a supprimé le message avec l'ID $messageId.");

    // Vérifier si la suppression a réussi
    if ($stmt->rowCount() > 0) {
        // Envoyer une réponse HTTP 200 OK pour indiquer le succès
        http_response_code(200); 
    } else {
        // Envoyer une réponse HTTP 500 Internal Server Error en cas d'erreur
        http_response_code(500); 
    }
}
?>