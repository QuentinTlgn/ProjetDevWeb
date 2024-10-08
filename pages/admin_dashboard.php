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
    
    <link rel="icon" href="../images/favicon.ico" />
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
                <a href="../index.php">Accueil</a>
                <a href="/pages/descriptions.php">Descriptions</a>
                <a href="/pages/contact.php">Contact</a>
                <a href="/php/logout.php">Déconnexion</a>
            </div>
        </nav>
    </header>

    <main>
        <h1>Bienvenue sur le tableau de bord, <?php echo $_SESSION['user_id']; ?> !</h1>

        <p>Contenu réservé aux administrateurs.</p>

        <!-- Afficher le message de succès si présent -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="success-message">Produit ajouté avec succès !</div>
        <?php endif; ?>

        <!-- Section pour les boxes -->
        <section class="dashboard">
            <div class="box">
                <h2>Ajouter un produit</h2>
                <form action="../php/ajouter_produit.php" method="post" enctype="multipart/form-data"> <!-- Ajoutez enctype -->
                    <label for="titre">Titre du produit:</label>
                    <input type="text" id="titre" name="titre" required>
                        
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" required>
                        
                    <label for="image">Image du produit:</label>
                    <input type="file" id="image" name="image" accept="image/*" required> <!-- Changez le type en file -->
                        
                    <button type="submit">Ajouter Produit</button>
                </form>
            </div>
            <div class="box">Box 2</div>
            <div class="box">Box 3</div>
            <div class="box">Box 4</div>
        </section>
    </main>
    
    <footer>
        <div class="footer-text">&copy; 2024 Quentin TAULEIGNE. Tous droits réservés.</div>
    </footer>
</body>

<script src="../js/burgerMenu.js"></script>    

</html>