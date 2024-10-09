<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/admin_login.php");
    exit();
}

// Inclure la connexion à la base de données
include('../php/db.php');

// Si le formulaire de modification est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    // Mettre à jour les informations du produit
    $updateSQL = "UPDATE produits SET titre = ?, description = ? WHERE id = ?";
    $stmt = $pdo->prepare($updateSQL);
    $stmt->execute([$titre, $description, $id]);

    // Rediriger avec un message de succès
    header("Location: ../pages/admin_dashboard.php?success=2");
    exit();
}
?>