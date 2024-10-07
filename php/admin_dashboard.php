<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
    header("Location: administration.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/policies.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/mediaQueries.css">
    
    <link rel="icon" href="favicon.ico" />
    <title>Tableau de bord Admin</title>
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
                <a href="../index.html">Accueil</a>
                <a href="#">Descriptions</a>
                <a href="/html/contact.html">Contact</a>
            </div>
        </nav>
    </header>

    <main>
        <h1>Bienvenue sur le tableau de bord, <?php echo $_SESSION['user_id']; ?> !</h1>

        <p>Contenu réservé aux administrateurs.</p>
        
        <form action="logout.php" method="POST">
            <button type="submit">Se déconnecter</button>
        </form>
    </main>
    
    <footer>
        <div class="footer-text">&copy; 2024 Quentin TAULEIGNE. Tous droits réservés.</div>
        <a href="/php/administration.php" class="footer-link">Administration</a>
    </footer>
</body>

<script src="../js/burgerMenu.js"></script>    

</html>
