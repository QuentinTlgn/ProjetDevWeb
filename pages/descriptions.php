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
    <title>Rue Des Potiers - Descriptions</title>

</head>
<body>
    <header>
        <nav class="topnav">
            <div class="logo-container"> 
            <?php
                // Inclusion du fichier de configuration
                $config = include '../config.php';
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
                <a class="active" href="#">Descriptions</a>
                <a href="/pages/contact.php">Contact</a>
                <?php
                    // Démarrage de la session
                    session_start(); 
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
        <section>
            <h1>Nos Créations</h1>
        </section>

        <!-- Section des produits -->
        <section class="product-section">
            <div class="product-list">
                <?php
                    // Inclusion du fichier de connexion à la base de données
                    include('../php/db.php');

                    // Requête SQL pour récupérer les produits et leurs images
                    $query = "
                        SELECT produits.id, produits.titre, produits.description, images_produits.link
                        FROM produits
                        LEFT JOIN images_produits ON produits.id = images_produits.idProduit
                    ";
                    // Exécution de la requête SQL
                    $stmt = $pdo->query($query);
                    // Récupération des résultats de la requête sous forme de tableau associatif
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // URL de l'image resizer
                    $resizerUrl = 'https://ruedespotiers.kubel.tech/php/img_resizer.php';
                    // URL de base pour les images
                    $baseUrl = 'https://ruedespotiers.kubel.tech/'; 

                    // Boucle pour afficher chaque produit
                    foreach ($products as $product) {
                        echo '<div class="product-card">';
                        echo '  <div class="product-info">';
                        // Affichage du titre du produit
                        echo '      <h2 class="product-title">' . htmlspecialchars($product['titre']) . '</h2>';
                        // Affichage de la description du produit
                        echo '      <p class="product-description">' . htmlspecialchars($product['description']) . '</p>';
                        echo '  </div>';
                        echo '  <div class="product-image">';
                        
                        // Vérification si un lien d'image est disponible
                        if (!empty($product['link'])) {
                            // Mise en forme du lien de l'image
                            $formattedLink = str_replace('../', $baseUrl, $product['link']); 

                            // Construction de l'URL de l'image redimensionnée (taille normale)
                            $resizedImageUrl = $resizerUrl . '?imageUrl=' . urlencode($formattedLink) . '&width=200&height=150';

                            echo '      <a href="#lightbox' . $product['id'] . '">';
                            // Affichage de l'image redimensionnée
                            echo '          <img src="' . $resizedImageUrl . '" alt="Image du produit ' . htmlspecialchars($product['titre']) . '">';
                            echo '      </a>';
                            
                            // Lightbox HTML (taille originale - chargement différé)
                            echo '  <div id="lightbox' . $product['id'] . '" class="lightbox" style="display:none;">';
                            echo '      <a href="#" class="close">×</a>';
                            // Utilisation de l'attribut data-src pour le chargement différé
                            echo '      <img data-src="' . $formattedLink . '" alt="Image du produit en grand" class="lazy">'; 
                            echo '  </div>';

                        } else {
                            // Affichage d'une image par défaut si aucun lien d'image n'est disponible
                            echo '      <img src="../images/logo.png" alt="Image par défaut pour le produit">';
                        }
                        
                        echo '  </div>';
                        echo '</div>';
                    }
                ?>
            </div>
        </section>
        <button onclick="location.href='/pages/contact.php'"class="button-63" role="button">Contactez nous pour passer commande !</button>
    </main>

    <footer>
        <div class="footer-text">© 2024 Rue Des Potiers. Tous droits réservés.</div>
    </footer>
    
</body>

<script src="../js/burgerMenu.js"></script>
<script src="../js/lazyLoadingProduits.js"></script>

</html>
