<?php
// Inclure le fichier de connexion à la base de données
include 'db.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $sujet = $_POST["sujet"];
    $message = $_POST["message"];

    // Insérer les données dans la base de données
    $sql = "INSERT INTO messages (nom, email, sujet, content) VALUES (:nom, :email, :sujet, :content)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':sujet', $sujet);
    $stmt->bindParam(':content', $message);

    try {
        $stmt->execute();
        // Redirection vers la page de succès
        header("Location: /pages/message_sent.php");
        exit(); // Arrêter l'exécution du script après la redirection
    } catch (PDOException $e) {
        // Afficher un message d'erreur
        echo "<p class='error-message'>Une erreur s'est produite lors de l'envoi du message</p>";
    }
}
?>