<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/administration.php");
    exit();
}

// Inclure la connexion à la base de données
include('../php/db.php');

// Vérifier si un ID de produit est passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer l'image associée au produit
    $sqlImage = "DELETE FROM images_produits WHERE idProduit = ?";
    $stmt = $pdo->prepare($sqlImage);
    $stmt->execute([$id]);

    // Supprimer l'entrée du produit
    $sql = "DELETE FROM produits WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Rediriger avec un message de succès
    header("Location: ../pages/admin_dashboard.php?success=3");
    exit();
}
?>
