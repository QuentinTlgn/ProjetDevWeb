<?php
$host = 'mysql-kskskzkz.alwaysdata.net'; // L'adresse du serveur
$dbname = 'kskskzkz_ruedespotiers'; // Nom de votre base de données
$user = 'kskskzkz'; // Nom d'utilisateur
$pass = 'ojuhuhudhfsuihdiudhsouj'; // Mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
