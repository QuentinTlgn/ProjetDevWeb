<?php
$host = 'localhost'; // L'adresse du serveur
$dbname = 'ruedespotiers'; // Nom de votre base de données
$user = 'ruedespotiersadm'; // Nom d'utilisateur
$pass = 'ladminderuedespotiersadm'; // Mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
