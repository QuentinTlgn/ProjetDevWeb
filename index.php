<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Feuilles de styles pour le design du site et les politiques de style -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/policies.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/mediaQueries.css">
    <link rel="stylesheet" type="text/css" href="/css/print.css" media="print">

    <!-- Favicon du site -->
    <link rel="icon" href="../images/favicon.ico" />
    <title>Rue Des Potiers - Accueil</title>
</head>
<body>
    <header>
        <nav class="topnav">
            <div class="logo-container"> 
                <?php
                    // Récupère le logo depuis le fichier de configuration
                    $config = include 'config.php';
                    echo '<img src="../php/img_resizer.php?imageUrl=' . urlencode($config->url . '/images/logotype/logotype_white.png') . '&width=150&height=32" alt="Logo">';
                ?>
            </div>
            <div class="burger">
                <!-- Icône pour le menu burger -->
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="nav-center">
                <!-- Liens de navigation principaux -->
                <a class="active" href="#">Accueil</a>
                <a href="/pages/descriptions.php">Descriptions</a>
                <a href="/pages/contact.php">Contact</a>
                <?php
                    // Vérifie si l'utilisateur est connecté et affiche le lien de déconnexion si c'est le cas
                    session_start();
                    if (isset($_SESSION['user_id'])) {
                        echo '<a href="/php/logout.php">Déconnexion</a>';
                    }
                ?>
            </div>
            <!-- Lien vers la page d'administration -->
            <a href="/pages/admin_login.php" class="admin-login-btn">Administration</a> 
        </nav>
    </header>

    <main>
        <section>
            <!-- Titre principal de la page -->
            <h1>Rue des Potiers</h1>
        </section>

        <section id="image-viewer-section">
            <!-- Conteneur pour l'affichage des images du visionneur -->
            <div id="image-viewer"></div>
        </section>

        <?php
            // Inclut le fichier de configuration de la base de données
            require_once './php/db.php';

            try {
                // Récupère les contenus de la page d'accueil depuis la base de données
                $stmt = $pdo->query("SELECT type, content FROM accueil_content ORDER BY id ASC");
                $contentRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Parcourt chaque contenu et l'affiche selon son type
                foreach ($contentRows as $row) {
                    switch ($row['type']) {
                        case 'image':
                            // Construit l'URL redimensionnée pour les images
                            $imageUrl = htmlspecialchars($row['content']);
                            $resizedUrl = "https://ruedespotiers.kubel.tech/php/img_resizer.php?imageUrl=" . urlencode($imageUrl) . "&width=600&height=400";
                            echo '<img src="' . $resizedUrl . '" alt="Image">';
                            break;
                        case 'text':
                            // Affiche un texte formaté
                            echo '<p class="formatted-text">' . htmlspecialchars($row['content']) . '</p>';
                            break;
                        case 'title1':
                            // Affiche un titre de niveau 1
                            echo '<h1>' . htmlspecialchars($row['content']) . '</h1>';
                            break;
                        case 'title2':
                            // Affiche un titre de niveau 2
                            echo '<h2>' . htmlspecialchars($row['content']) . '</h2>';
                            break;
                        case 'title3':
                            // Affiche un titre de niveau 3
                            echo '<h3>' . htmlspecialchars($row['content']) . '</h3>';
                            break;
                    }
                }
            } catch (PDOException $e) {
                // Gère les erreurs de connexion à la base de données
                echo "Une erreur est survenue lors de la récupération du contenu de la page dans la base de données";
            }
        ?>
        <!-- Bouton qui redirige vers la page de descriptions -->
        <button onclick="location.href='./pages/descriptions.php'" class="button-63" role="button">Convaincu ? Venez voir nos créations !</button>
    </main>

    <footer>
        <!-- Texte du pied de page -->
        <div class="footer-text">&copy; 2024 Rue des Potiers. Tous droits réservés.</div>
    </footer>

</body>

<!-- Scripts pour le visionneur d'images et le menu burger -->
<script src="../js/imageViewer.js"></script>
<script src="../js/burgerMenu.js"></script>    

</html>
