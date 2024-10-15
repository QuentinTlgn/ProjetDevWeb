<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/admin_login.php");
    exit();
}

// Inclure la connexion à la base de données
include('../php/db.php');

// Si le formulaire de modification des contacts est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier_contact'])) {
    $adresse = $_POST['adresse'];
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $telephone = $_POST['telephone'];

    // Mise à jour des informations de contact dans la base de données
    $updateSQL = "UPDATE contacts SET valeur = ? WHERE champ = ?";

    $stmt = $pdo->prepare($updateSQL);

    // Mettre à jour chaque champ individuellement
    $stmt->execute([$adresse, 'adresse']);
    $stmt->execute([$nom, 'nom']);
    $stmt->execute([$mail, 'mail']);
    $stmt->execute([$telephone, 'telephone']);

    // Redirection avec un message de succès
    header("Location: ../pages/admin_dashboard.php?success=4");
    exit();
}
?>
