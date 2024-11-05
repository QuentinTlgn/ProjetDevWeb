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
    $type = $_POST['type'];
    $content = $_POST['content'];

    // Récupérer le dernier ID dans la table
    $sql = "SELECT MAX(id) AS last_id FROM accueil_content";
    $stmt = $pdo->query($sql);
    $lastIdRow = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastId = $lastIdRow['last_id'];

    // Calculer le nouvel ID (dernier ID + 1)
    $newId = $lastId + 1;

    // Préparer la requête d'insertion
    $sql = "INSERT INTO accueil_content (id, type, content) VALUES (:id, :type, :content)";
    $stmt = $pdo->prepare($sql);

    ajouter_log($pdo, 'Ajout contenu accueil', "Contenu avec ID $newId - $type ajouté par {$_SESSION['user_id']}");

    // Définir les valeurs des paramètres
    $stmt->bindParam(':id', $newId);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':content', $content);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Rediriger vers la page d'administration avec un message de succès
        header('Location: /pages/admin_dashboard.php');
        exit();
    } else {
        // Afficher un message d'erreur si l'insertion a échoué
        echo "Erreur lors de l'ajout du contenu.";
    }
}
?>