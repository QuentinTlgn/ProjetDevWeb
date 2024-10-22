<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/admin_login.php");
    exit();
}

// Inclure la connexion à la base de données et les fonctions de logs
include('../php/db.php');
include('../php/log_functions.php');

// Si le formulaire de modification est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    // Mettre à jour les informations du produit
    $updateSQL = "UPDATE produits SET titre = ?, description = ? WHERE id = ?";
    $stmt = $pdo->prepare($updateSQL);
    $stmt->execute([$titre, $description, $id]);

    try {
        // Ajouter un log pour la mise à jour des produits
        ajouter_log($pdo, 'Modification Produit', "{$_SESSION['user_id']} a modifié le produit avec l'ID $id.");

        // Vérifier si une nouvelle image a été uploadée
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Chemin vers le dossier où les images sont stockées
            $targetDir = "../images/produits/";
            $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $targetFile = $targetDir . "pot" . $id . "." . $imageFileType; // Renomme l'image selon l'ID du produit

            // Vérifier si l'image est bien un fichier valide
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check !== false) {
                // Déplacer le fichier uploadé vers le répertoire de destination
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    // Mettre à jour le lien de l'image dans la base de données
                    $updateImageSQL = "UPDATE images_produits SET link = ? WHERE idProduit = ?";
                    $stmt = $pdo->prepare($updateImageSQL);
                    $stmt->execute([$targetFile, $id]);
                }
            }
        }

        // Rediriger avec un message de succès
        header("Location: ../pages/admin_dashboard.php?success=2");
        exit();
    } catch (PDOException $e) {
        // Gérer les erreurs (facultatif)
        echo "Erreur lors de la mise à jour du produit: " . $e->getMessage();
    }
}
?>
