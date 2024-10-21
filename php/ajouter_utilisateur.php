<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    header("Location: admin_login.php");
    exit();
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password]);

        header("Location: ../pages/admin_dashboard.php?success=5"); // Message de succès pour l'ajout
        exit();
    } catch (PDOException $e) {
        // Gérer les erreurs (par exemple, si le nom d'utilisateur existe déjà)
        echo "Erreur: " . $e->getMessage();
    }
}
?>