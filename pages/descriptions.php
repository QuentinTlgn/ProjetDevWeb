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
    <title>Rue Des Potiers - Descriptions</title>
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

    <main>
        <h1>Nos Produits</h1>

        <!-- Section des produits -->
        <section class="product-section">
            <div class="product-list">
                <?php
                    // Inclusion de la connexion à la base de données
                    include('../php/db.php');

                    // Récupération des produits et leurs images depuis la base de données
                    $query = "
                        SELECT produits.id, produits.titre, produits.description, images_produits.link
                        FROM produits
                        LEFT JOIN images_produits ON produits.id = images_produits.idProduit
                    ";
                    $stmt = $pdo->query($query);
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Boucle pour afficher chaque produit
                    foreach ($products as $product) {
                        echo '<div class="product-card">';
                        echo '  <div class="product-info">';
                        echo '      <h2 class="product-title">' . htmlspecialchars($product['titre']) . '</h2>';
                        echo '      <p class="product-description">' . htmlspecialchars($product['description']) . '</p>';
                        echo '  </div>';
                        echo '  <div class="product-image">';
                        
                        // Vérifie si un lien d'image est disponible
                        if (!empty($product['link'])) {
                            echo '      <img src="../' . htmlspecialchars($product['link']) . '" alt="Image du produit ' . htmlspecialchars($product['titre']) . '">';
                        } else {
                            echo '      <img src="../images/default.jpg" alt="Image par défaut pour le produit">';
                        }
                        
                        echo '  </div>';
                        echo '</div>';
                    }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-text">&copy; 2024 Quentin TAULEIGNE. Tous droits réservés.</div>
        <a href="/pages/admin_login.php" class="footer-link">Administration</a>
    </footer>
    
</body>

<script src="../js/burgerMenu.js"></script> 

</html>
