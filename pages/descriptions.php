<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/policies.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/mediaQueries.css">
    
    <link rel="icon" href="favicon.ico" />
    <title>Descriptions</title>
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
                <a class="active" href="#">Descriptions</a>
                <a href="/pages/contact.php">Contact</a>
                <?php
                    session_start(); // Démarre la session
                    if (isset($_SESSION['user_id'])) { // Vérifie si l'utilisateur est connecté
                        echo '<a href="/php/logout.php">Déconnexion</a>'; // Lien de déconnexion avec la classe
                    }
                ?>
            </div>
        </nav>
    </header>
    
    <footer>
        <div class="footer-text">&copy; 2024 Quentin TAULEIGNE. Tous droits réservés.</div>
        <a href="/pages/admin_login.php" class="footer-link">Administration</a>
    </footer>
    
</body>

<script src="../js/burgerMenu.js"></script> 

</html>
