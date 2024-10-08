<?php
session_start(); // Démarre la session

// Inclure le fichier de connexion à la base de données
include '../php/db.php';

// Récupération des données depuis la base de données
$sql = "SELECT champ, valeur FROM contacts";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); // Utilise FETCH_KEY_PAIR pour obtenir un tableau associatif clé => valeur

// Initialisation des variables avec les données récupérées
$adresse = isset($contacts['adresse']) ? $contacts['adresse'] : '';
$nom = isset($contacts['nom']) ? $contacts['nom'] : '';
$mail = isset($contacts['mail']) ? $contacts['mail'] : '';
$telephone = isset($contacts['telephone']) ? $contacts['telephone'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/policies.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/mediaQueries.css">
    
    <link rel="icon" href="../images/favicon.ico" />
    <title>Rue Des Potiers - Contact</title>
</head>
<body>
    <header>
        <nav class="topnav">
            <div class="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="nav-center">
                <a href="../index.php">Accueil</a>
                <a href="/pages/descriptions.php">Descriptions</a>
                <a class="active" href="#">Contact</a>
                <?php
                    if (isset($_SESSION['user_id'])) { // Vérifie si l'utilisateur est connecté
                        echo '<a href="/php/logout.php">Déconnexion</a>';
                    }
                ?>
            </div>
        </nav>
    </header>

    <main>
        <section>
            <h1>Nous contacter</h1>
        </section>
        
        <section>
            <h3>Courrier</h3>
            <p class="formatted-text"><?php echo $nom; ?>

                <?php echo $adresse; ?>
            </p>
        </section>

        <section>
            <h3>Mail</h3>
            <a href="mailto:<?php echo $mail; ?>" class="formatted-text"><?php echo $mail; ?></a>
        </section>

        <section>
            <h3>Téléphone</h3>
            <a href="tel:<?php echo $telephone; ?>" class="formatted-text"><?php echo $telephone; ?></a>
        </section>
    </main>
    
    <footer>
        <div class="footer-text">&copy; 2024 Quentin TAULEIGNE. Tous droits réservés.</div>
        <a href="/pages/admin_login.php" class="footer-link">Administration</a>
    </footer>

</body>

<script src="../js/burgerMenu.js"></script> 

</html>
