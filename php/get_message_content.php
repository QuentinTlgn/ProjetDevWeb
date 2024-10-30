<?php

session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/admin_login.php");
    exit();
}

include('../php/db.php'); 

if (isset($_GET['id'])) {
    $messageId = $_GET['id'];

    // Récupérer le contenu du message depuis la base de données
    $sql = "SELECT content FROM messages WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$messageId]);

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlspecialchars($row['content']);
    } else {
        echo "Message non trouvé.";
    }
}
?>