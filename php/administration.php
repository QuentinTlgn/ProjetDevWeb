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
    <title>Administration</title>
</head>
<body>
    <header>
        <nav class="topnav">
            <a href="/index.html">Accueil</a>
            <a href="/html/descriptions.html">Descriptions</a>
            <a href="/html/contact.html">Contact</a>
        </nav>
    </header>

    <main>
        <h1>Authentification</h1>

        <?php
        session_start(); // Démarre une session

        // Vérifiez si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'db.php'; // Inclut le fichier de connexion à la base de données

            $username = $_POST['login'];
            $password = $_POST['password'];

            // Préparez et exécutez la requête
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            // Vérifiez si l'utilisateur existe
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Vérifiez le mot de passe
                if ($password === $user['password']) {
                    // Authentification réussie
                    $_SESSION['user_id'] = $user['username'];
                    echo "<p>Bienvenue, $username !</p>";
                } else {
                     echo "<p style='color: red;'>Mot de passe incorrect.</p>";
                }
            } else {
                echo "<p style='color: red;'>Utilisateur non trouvé.</p>";
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
        <div class="footer-text">&copy; 2024 Quentin TAULEIGNE. Tous droits réservés.</div>
        <a href="/php/administration.php" class="footer-link">Administration</a>
    </footer>
</body>
</html>
