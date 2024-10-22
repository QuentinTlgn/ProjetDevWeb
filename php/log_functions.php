<?php
// Fonction pour ajouter une log dans la table "logs"
function ajouter_log($pdo, $type, $description) {
    try {
        // Préparer et exécuter la requête pour insérer la log
        $sql = "INSERT INTO logs (type, description) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$type, $description]);
    } catch (PDOException $e) {
        // Si une erreur se produit, afficher un message ou gérer l'erreur
        echo "Erreur lors de l'ajout de la log: " . $e->getMessage();
    }
}
?>
