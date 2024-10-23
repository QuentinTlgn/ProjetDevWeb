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
    
    <link rel="icon" href="../images/favicon.ico" />
    <title>Rue Des Potiers - Descriptions</title>

</head>
<body>
    <header>
        <nav class="topnav">
            <div class="logo-container"> 
                <img src="../../images/logotype/logotype_white_subtext.png" alt="Logo"> 
            </div>
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
                        echo '<a href="/php/logout.php">Déconnexion</a>';
                    }
                ?>
            </div>
        </nav>
    </header>

    <main>
        <section>
            <h1>Nos Produits</h1>
        </section>

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

                    // URL de l'image resizer
                    $resizerUrl = 'http://kskskzkz.alwaysdata.net/php/img_resizer.php';
                    // URL de base pour les images
                    $baseUrl = 'http://kskskzkz.alwaysdata.net/'; 

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
                            // Remise en forme du lien de l'image
                            $formattedLink = str_replace('../', $baseUrl, $product['link']); 

                            // Construction de l'URL de l'image redimensionnée (taille normale)
                            $resizedImageUrl = $resizerUrl . '?imageUrl=' . urlencode($formattedLink) . '&width=200&height=150';

                            echo '      <a href="#lightbox' . $product['id'] . '">';
                            echo '          <img src="' . $resizedImageUrl . '" alt="Image du produit ' . htmlspecialchars($product['titre']) . '">';
                            echo '      </a>';
                            
                            // Lightbox HTML (taille originale - chargement différé)
                            echo '  <div id="lightbox' . $product['id'] . '" class="lightbox" style="display:none;">';
                            echo '      <a href="#" class="close">×</a>';
                            echo '      <img data-src="' . $formattedLink . '" alt="Image du produit en grand" class="lazy">'; // Utilisation de data-src
                            echo '  </div>';

                        } else {
                            echo '      <img src="../images/logo.png" alt="Image par défaut pour le produit">';
                        }
                        
                        echo '  </div>';
                        echo '</div>';
                    }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-text">© 2024 Rue Des Potiers. Tous droits réservés.</div>
        <a href="/pages/admin_login.php" class="footer-link">Administration</a>
    </footer>
    
</body>

<script src="../js/burgerMenu.js"></script>
<script src="../js/lazyLoadingProduits.js"></script>

</html>