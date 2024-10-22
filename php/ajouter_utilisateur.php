<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: admin_login.php");
    exit();
}

include('db.php'); // Connexion à la base de données
include('log_functions.php'); // Inclusion du fichier contenant la fonction ajouter_log()

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Ajouter l'admin dans la table admins
        $sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password]);

        // Ajouter une log après l'ajout réussi de l'utilisateur
        ajouter_log($pdo, "Ajout administrateur", "L'utilisateur $username a été ajouté par " . $_SESSION['user_id']);

        // Rediriger avec un message de succès
        header("Location: ../pages/admin_dashboard.php?success=5");
        exit();
    } catch (PDOException $e) {
        // Gérer les erreurs (par exemple, si le nom d'utilisateur existe déjà)
        echo "Erreur: " . $e->getMessage();
    }
}
?>
