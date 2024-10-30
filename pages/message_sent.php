<?php
    $config = include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
        header('Cache-Control: max-age=604800'); // Cache-Control en PHP
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + (60*60*24*45)) . ' GMT'); // Expires en PHP 
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
                echo '<img src="../php/img_resizer.php?imageUrl=' . urlencode($config->url . '/images/logotype/logotype_white.png') . '&width=150&height=32" alt="Logo">';
            ?>
            </div>
            <div class="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="nav-center">
                <a href="/index.php">Accueil</a>
                <a href="/pages/descriptions.php">Descriptions</a>
                <a href="/pages/contact.php">Contact</a>
                <?php
                    if (isset($_SESSION['user_id'])) { // Vérifie si l'utilisateur est connecté
                        echo '<a href="/php/logout.php">Déconnexion</a>';
                    }
                ?>
            </div>
            <a href="/pages/admin_login.php" class="admin-login-btn">Administration</a>              
        </nav>
    </header>

    <main>
    <section class="messagesent-container">  <!-- Ajouter la classe flex-center -->
        <div class="confirmation-message">
            <h2>Votre message a bien été envoyé !</h2>
            <p>Merci de nous avoir contactés. Nous vous répondrons dans les plus brefs délais.</p>
            <a href="../index.php" class="button-63">Retour à l'accueil</a> 
        </div>
    </section>
    </main>
    
    <footer>
        <div class="footer-text">© 2024 Rue Des Potiers. Tous droits réservés.</div>
    </footer>

</body>

<script src="../js/burgerMenu.js"></script> 

</html>