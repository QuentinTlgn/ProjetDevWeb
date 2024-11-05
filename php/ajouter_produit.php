<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/admin_login.php");
    exit();
}

// Inclure le fichier de connexion à la base de données et le fichier de logs
include 'db.php'; // Assurez-vous que le chemin est correct
include 'log_functions.php'; // Inclure la fonction d'ajout de log

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    // Gestion du téléchargement de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];

        // Définir le chemin de destination pour l'image
        $uploadDir = '../images/produits/'; 

        // Vérifier si le dossier de destination existe
        if (!is_dir($uploadDir)) {
            die("Le dossier de destination $uploadDir n'existe pas.");
        }

        try {
            // Récupérer l'ID le plus élevé dans la table produits
            $stmt = $pdo->query("SELECT MAX(id) AS max_id FROM produits");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $idProduit = ($result['max_id'] ?? 0) + 1; // Incrémente l'ID le plus élevé, ou commence à 1 si aucune entrée

            // Générer le nouveau nom de fichier avec l'ID du produit
            $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION); // Récupérer l'extension du fichier
            $newImageName = $idProduit . '.' . $imageExtension; // Nouveau nom : ID + extension
            $uploadFilePath = $uploadDir . $newImageName; // Chemin complet avec le nouveau nom

            // Déplacer le fichier téléchargé avec le nouveau nom
            if (move_uploaded_file($imageTmpPath, $uploadFilePath)) {
                // Préparation et exécution de la requête pour insérer le produit avec l'ID généré
                $stmt = $pdo->prepare("INSERT INTO produits (id, titre, description) VALUES (:id, :titre, :description)");
                $stmt->execute(['id' => $idProduit, 'titre' => $titre, 'description' => $description]);

                // Préparation et exécution de la requête pour insérer l'image avec le nouveau nom
                $stmt = $pdo->prepare("INSERT INTO images_produits (idProduit, link) VALUES (:idProduit, :link)");
                $stmt->execute(['idProduit' => $idProduit, 'link' => $uploadDir . $newImageName]);

                // Ajouter une log pour l'ajout du produit (succès)
                ajouter_log($pdo, 'Ajout de produit', "Produit ID $idProduit - $titre ajouté par {$_SESSION['user_id']}");

                // Redirection vers le tableau de bord après l'ajout
                header("Location: ../pages/admin_dashboard.php?success=1");
                exit(); // Assurez-vous de quitter après la redirection
            } else {
                die("Erreur lors du téléchargement de l'image.");
            }
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    } else {
        die("Aucune image téléchargée ou une erreur s'est produite.");
    }
}
?>
