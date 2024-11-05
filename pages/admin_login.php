<!DOCTYPE html>
<html lang="fr">
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
    <title>Rue Des Potiers - Administration</title>
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
                <a href="/pages/descriptions.php">Descriptions</a>
                <a href="/pages/contact.php">Contact</a>
            </div>
            <a href="/pages/admin_login.php" class="admin-login-btn">Administration</a>
        </nav>
    </header>

    <main>
        <h1>Authentification</h1>

        <?php
            // Inclusion du fichier de fonctions de log
            include '../php/log_functions.php'; 
            // Démarrage d'une session
            session_start(); 

            // Vérifier si l'utilisateur est déjà connecté
            if (isset($_SESSION['user_id'])) {
                // Si l'utilisateur est connecté, rediriger vers le tableau de bord
                header("Location: admin_dashboard.php");
                exit();
            }

            // Vérifier si le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Inclusion du fichier de connexion à la base de données
                include '../php/db.php'; 
            
                // Récupération des informations du formulaire
                $username = $_POST['login'];
                $password = $_POST['password'];
            
                // Préparation et exécution de la requête SQL pour récupérer les informations de l'administrateur
                $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->execute();
            
                // Vérification si l'utilisateur existe
                if ($stmt->rowCount() > 0) {
                    // Récupération des informations de l'administrateur
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Vérification du mot de passe
                    if ($password === $user['password']) {
                        // Authentification réussie
                        $_SESSION['user_id'] = $user['username'];

                        // Ajout d'un log
                        ajouter_log($pdo, 'Connexion', "{$_SESSION['user_id']} s'est connecté");

                        // Redirection vers la page du tableau de bord
                        header("Location: admin_dashboard.php");
                        exit();
                    } else {
                        // Affichage d'un message d'erreur
                        echo "<p style='color: red;'>Mot de passe ou utilisateur incorrect.</p>";
                    }
                } else {
                    // Affichage d'un message d'erreur
                    echo "<p style='color: red;'>Mot de passe ou utilisateur incorrect.</p>";
                }
            }
        ?>

        <form action="" method="POST">
            <label for="login">Login</label>
            <input type="text" id="login" name="login" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Se connecter</button>
        </form>
    </main>
    
    <footer>
        <div class="footer-text">&copy; 2024 Rue Des Potiers. Tous droits réservés.</div>
    </footer>
</body>

<script src="../js/burgerMenu.js"></script>    

</html>