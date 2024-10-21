<!DOCTYPE html>
<html lang="fr">
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
    <title>Rue Des Potiers - Administration</title>
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
            </div>
        </nav>
    </header>

    <main>
        <h1>Authentification</h1>

        <?php
            session_start(); // Démarre une session

            // Vérifier si l'utilisateur est déjà connecté
            if (isset($_SESSION['user_id'])) {
                // Si l'utilisateur est connecté, rediriger vers le tableau de bord
                header("Location: admin_dashboard.php");
                exit();
            }

            // Vérifiez si le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include '../php/db.php'; // Inclut le fichier de connexion à la base de données
            
                $username = $_POST['login'];
                $password = $_POST['password'];
            
                // Préparez et exécutez la requête
                $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->execute();
            
                // Vérifiez si l'utilisateur existe
                if ($stmt->rowCount() > 0) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Vérifiez le mot de passe
                    if ($password === $user['password']) {
                        // Authentification réussie
                        $_SESSION['user_id'] = $user['username'];
                    
                        // Redirection vers une page protégée
                        header("Location: admin_dashboard.php"); // Remplacez par la page cible
                        exit(); // Assure-toi que le script s'arrête après la redirection
                    } else {
                         echo "<p style='color: red;'>Mot de passe ou utilisateur incorrect.</p>";
                    }
                } else {
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
