<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
    header("Location: administration.php");
    exit();
}

// Inclure le fichier de connexion à la base de données
include 'db.php'; // Assurez-vous que le chemin est correct

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
        $uploadDir = __DIR__ . '/../images/produits/'; // Utilisez __DIR__ pour obtenir le chemin absolu
        $uploadFilePath = $uploadDir . basename($imageName);

        // Vérifier si le dossier de destination existe
        if (!is_dir($uploadDir)) {
            die("Le dossier de destination n'existe pas.");
        }

        // Déplacer le fichier téléchargé vers le dossier de destination
        if (move_uploaded_file($imageTmpPath, $uploadFilePath)) {
            try {
                // Récupérer l'ID le plus élevé dans la table produits
                $stmt = $pdo->query("SELECT MAX(id) AS max_id FROM produits");
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $idProduit = ($result['max_id'] ?? 0) + 1; // Incrémente l'ID le plus élevé, ou commence à 1 si aucune entrée

                // Préparation et exécution de la requête pour insérer le produit avec l'ID généré
                $stmt = $pdo->prepare("INSERT INTO produits (id, titre, description) VALUES (:id, :titre, :description)");
                $stmt->execute(['id' => $idProduit, 'titre' => $titre, 'description' => $description]);

                // Préparation et exécution de la requête pour insérer l'image
                $stmt = $pdo->prepare("INSERT INTO images_produits (idProduit, link) VALUES (:idProduit, :link)");
                $stmt->execute(['idProduit' => $idProduit, 'link' => $imageName]); // On enregistre seulement le nom de fichier

                // Redirection vers le tableau de bord après l'ajout
                header("Location: ../pages/admin_dashboard.php?success=1");
                exit(); // Assurez-vous de quitter après la redirection
            } catch (PDOException $e) {
                // Gérer les erreurs
                echo "Erreur: " . $e->getMessage();
            }
        } else {
            die("Erreur lors du téléchargement de l'image.");
        }
    } else {
        die("Aucune image téléchargée ou une erreur s'est produite.");
    }
}
?>