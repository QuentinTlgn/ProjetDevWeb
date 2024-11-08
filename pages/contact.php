<?php
session_start(); // Démarre la session

// Inclure le fichier de connexion à la base de données
include '../php/db.php';
$config = include '../config.php';

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
    <?php
        // Définition de l'en-tête Cache-Control pour une durée de validité de 604800 secondes (1 semaine)
        header('Cache-Control: max-age=604800'); 
        // Définition de l'en-tête Expires pour une date d'expiration dans 45 jours
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + (60*60*24*45)) . ' GMT'); 
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/policies.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/mediaQueries.css">
    <link rel="stylesheet" type="text/css" href="/css/print.css" media="print">
    
    <link rel="icon" href="../images/favicon.ico" />
    <title>Rue Des Potiers - Contact</title>
</head>
<body>
    <header>
        <nav class="topnav">
            <div class="logo-container"> 
            <?php
                // Affichage du logo redimensionné à l'aide de php/img_resizer.php
                echo '<img src="../php/img_resizer.php?imageUrl=' . urlencode($config->url . '/images/logotype/logotype_white.png') . '&width=150&height=32" alt="Logo">';
            ?>
            </div>
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
                    // Affichage du lien de déconnexion si l'utilisateur est connecté
                    if (isset($_SESSION['user_id'])) { 
                        echo '<a href="/php/logout.php">Déconnexion</a>';
                    }
                ?>
            </div>
            <a href="/pages/admin_login.php" class="admin-login-btn">Administration</a>              
        </nav>
    </header>

    <main>
        <section class="contact-container"> 
            <div class="contact-info">
                <?php
                    // Affichage du logo redimensionné à l'aide de php/img_resizer.php
                    echo '<img src="../php/img_resizer.php?imageUrl=' . urlencode($config->url . '/images/logotype/logotype_black_subtext.png') . '&width=425&height=90" alt="Logo">';
                ?>
                <p><?php echo $mail; ?></p>
                <p><?php echo $telephone; ?></p>

                <h2>Atelier</h2>
                <h3><?php echo $adresse; ?></h3>
            </div>

            <div class="separator"></div>

            <div class="contact-form">
                <h2>Laissez un message</h2>
                <form action="../php/send_message.php" method="post"> 
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" required>

                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>

                    <label for="sujet">Sujet *</label>
                    <input type="text" id="sujet" name="sujet" required>
                    
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <button type="submit" class="button-63">Envoyer</button>
                </form>
            </div>
        </section>
    </main>
    
    <footer>
        <div class="footer-text">© 2024 Rue Des Potiers. Tous droits réservés.</div>
    </footer>

</body>

<script src="../js/burgerMenu.js"></script> 

</html>