<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/policies.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/mediaQueries.css">
    <link rel="stylesheet" type="text/css" href="/css/print.css" media="print">

    <link rel="icon" href="../images/favicon.ico" />
    <title>Rue Des Potiers - Accueil</title>
</head>
<body>
    <header>
        <nav class="topnav">
            <div class="logo-container"> 
            <?php
                $config = include 'config.php';
                echo '<img src="../php/img_resizer.php?imageUrl=' . urlencode($config->url . '/images/logotype/logotype_white.png') . '&width=150&height=32" alt="Logo">';
            ?>
            </div>
            <div class="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="nav-center">
                <a class="active" href="#">Accueil</a>
                <a href="/pages/descriptions.php">Descriptions</a>
                <a href="/pages/contact.php">Contact</a>
                <?php
                    session_start(); // Démarre la session
                    if (isset($_SESSION['user_id'])) { // Vérifie si l'utilisateur est connecté
                        echo '<a href="/php/logout.php">Déconnexion</a>'; // Lien de déconnexion avec la classe
                    }
                ?>
            </div>
            <a href="/pages/admin_login.php" class="admin-login-btn">Administration</a> 
        </nav>
    </header>

    <main>
        <section>
            <h1>Rue des Potiers</h1>
        </section>

        <section id="image-viewer-section">
            <div id="image-viewer"></div>
        </section>

        <?php
            // Inclure le fichier de configuration de la base de données
            require_once './php/db.php';

            try {
                // Récupérer le contenu de la table accueil_content trié par ID
                $stmt = $pdo->query("SELECT type, content FROM accueil_content ORDER BY id ASC");
                $contentRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Afficher le contenu en fonction du type
                foreach ($contentRows as $row) {
                    switch ($row['type']) {
                        case 'image':
                            echo '<img src="' . htmlspecialchars($row['content']) . '" alt="Image">';
                            break;
                        case 'text':
                            echo '<p class="formatted-text">' . htmlspecialchars($row['content']) . '</p>';
                            break;
                        case 'title1':
                            echo '<h1>' . htmlspecialchars($row['content']) . '</h1>';
                            break;
                        case 'title2':
                            echo '<h2>' . htmlspecialchars($row['content']) . '</h2>';
                            break;
                        case 'title3':
                            echo '<h3>' . htmlspecialchars($row['content']) . '</h3>';
                            break;
                    }
                }
            } catch (PDOException $e) {
                echo "Erreur de base de données : " . htmlspecialchars($e->getMessage());
            }
        ?>
        <!-- HTML !-->
        <button onclick="location.href='./pages/descriptions.php'"class="button-63" role="button">Convaincu ? Venez voir nos créations !</button>
    </main>

    <footer>
        <div class="footer-text">&copy; 2024 Rue des Potiers. Tous droits réservés.</div>>
    </footer>

</body>

<script src="../js/imageViewer.js"></script>
<script src="../js/burgerMenu.js"></script>    

</html>
