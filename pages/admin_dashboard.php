<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
    header("Location: admin_login.php");
    exit();
}

include('../php/db.php');
$config = include '../config.php';
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
    <link rel="stylesheet" type="text/css" href="/css/print.css" media="print">
    
    <link rel="icon" href="../images/favicon.ico" />
    <title>Tableau de bord Admin</title>
</head>
<body>

    <header>
        <nav class="topnav">
            <div class="logo-container"> 
            <?php
                $config = include '../config.php';
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
                <a href="/php/logout.php">Déconnexion</a>
            </div>
            <a href="/pages/admin_login.php" class="admin-login-btn">Administration</a>
        </nav>
    </header>

    <main>
        <h1>Bienvenue <?php echo $_SESSION['user_id']; ?> !</h1>

        <p>Contenu réservé aux administrateurs.</p>

        <!-- Section pour les boxes -->
        <section class="dashboard">
            <div class="box">
                <h2>Ajouter un produit</h2>
                <form action="../php/ajouter_produit.php" method="post" enctype="multipart/form-data">
                    <label for="titre">Titre du produit:</label>
                    <input type="text" id="titre" name="titre" required>
                        
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" required>
                        
                    <label for="image">Image du produit:</label>
                    <input type="file" id="image" name="image" accept="image/*" required> <!-- Changez le type en file -->
                        
                    <button type="submit">Ajouter Produit</button>
                </form>
                        <!-- Afficher le message de succès si présent -->
                <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                    <a class="success-message">Produit ajouté avec succès !</a>
                <?php endif; ?>
            </div>

            <div class="box">
                <h2>Liste des produits</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Récupérer les produits et leurs images
                        $sql = "SELECT p.id, p.titre, p.description, i.link AS image 
                                FROM produits p 
                                LEFT JOIN images_produits i ON p.id = i.idProduit";
                        $stmt = $pdo->query($sql);

                        if ($stmt->rowCount() > 0) {
                            // Afficher chaque produit
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td data-label='ID'>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td data-label='Titre'>" . htmlspecialchars($row['titre']) . "</td>";
                                echo "<td data-label='Description'>" . htmlspecialchars($row['description']) . "</td>";
                                echo "<td data-label='Actions'>
                                        <button class='edit-btn' data-id='" . $row['id'] . "' data-titre='" . htmlspecialchars($row['titre']) . "' data-description='" . htmlspecialchars($row['description']) . "'>Modifier</button>
                                        <button class='delete-btn' data-id='" . $row['id'] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce produit ?\");'>Supprimer</button>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Aucun produit trouvé.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php if (isset($_GET['success']) && $_GET['success'] == 2): ?>
                    <a class="success-message">Produit modifié avec succès !</a>
                <?php elseif (isset($_GET['success']) && $_GET['success'] == 3): ?>
                    <a class="success-message">Produit supprimé avec succès !</a>
                <?php endif; ?>
            </div>

            <div class="popup" id="popup">
                <div class="popup-content">
                    <button class="close-btn" id="closePopup">X</button>
                    <h2>Modifier le produit</h2>
                    <form action="../php/modifier_produit.php" method="post" id="editForm" enctype="multipart/form-data">
                        <input type="hidden" id="editId" name="id">

                        <label for="editTitre">Titre du produit :</label>
                        <input type="text" id="editTitre" name="titre" required>

                        <label for="editDescription">Description du produit :</label>
                        <input type="text" id="editDescription" name="description" required>

                        <label for="editImage">Image du produit :</label>
                        <input type="file" id="editImage" name="image" accept="image/*">

                        <button type="submit" name="modifier">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>

            <div class="box">
                <h2>Informations de contact</h2>
                <form action="../php/modifier_contact.php" method="post" id="editContactForm">
                    <!-- Champs pré-remplis avec les infos actuelles de contact -->
                    <label for="editAdresse">Adresse :</label>
                    <input type="text" id="editAdresse" name="adresse" value="" required>

                    <label for="editNom">Nom :</label>
                    <input type="text" id="editNom" name="nom" value="" required>

                    <label for="editMail">E-mail :</label>
                    <input type="email" id="editMail" name="mail" value="" required>

                    <label for="editTelephone">Téléphone :</label>
                    <input type="tel" id="editTelephone" name="telephone" value="" required>

                    <button type="submit" name="modifier_contact">Enregistrer les modifications</button>
                </form>
                <?php if (isset($_GET['success']) && $_GET['success'] == 4): ?>
                    <a class="success-message">Infos de contact modifiées avec succès !</a>
                <?php endif; ?>
            </div>

            <div class="box">
                <h2>Ajouter un admin</h2>
                <form action="../php/ajouter_utilisateur.php" method="post">
                    <label for="newUsername">Nom d'utilisateur:</label>
                    <input type="text" id="newUsername" name="username" required>
                    <label for="newPassword">Mot de passe:</label>
                    <input type="password" id="newPassword" name="password" required>
                    <button type="submit">Ajouter utilisateur</button>
                </form>
                <?php if (isset($_GET['success']) && $_GET['success'] == 5): ?>
                    <a class="success-message">Utilisateur ajouté avec succès !</a>
                <?php endif; ?>
            </div>

            <div class="box">
                <h2>Liste des admins</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Récupérer les utilisateurs
                        $sql = "SELECT username FROM admins";
                        $stmt = $pdo->query($sql);

                        if ($stmt->rowCount() > 0) {
                            // Afficher chaque utilisateur
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td data-label='Utilisateur'>" . htmlspecialchars($row['username']) . "</td>";
                                echo "<td data-label='Actions'>
                                        <button class='edit-user-btn' data-username='" . htmlspecialchars($row['username']) . "'>Modifier</button>
                                        <button class='delete-user-btn' data-username='" . htmlspecialchars($row['username']) . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\");'>Supprimer</button>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>Aucun utilisateur trouvé.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php if (isset($_GET['success']) && $_GET['success'] == 6): ?>
                    <a class="success-message">Utilisateur modifié avec succès !</a>
                <?php elseif (isset($_GET['success']) && $_GET['success'] == 7): ?>
                    <a class="success-message">Utilisateur supprimé avec succès !</a>
                <?php endif; ?>
            </div>
                <!-- Popup (lightbox) pour modifier un utilisateur -->
            <div class="popup" id="userPopup">
                <div class="popup-content">
                    <button class="close-btn" id="closeUserPopup">X</button>
                    <h2>Modifier l'admin</h2>
                    <form action="../php/modifier_utilisateur.php" method="post" id="editUserForm">
                        <input type="hidden" id="editUsername" name="oldUsername">

                        <label for="newUsername">Nouveau nom d'utilisateur :</label>
                        <input type="text" id="newEditUsername" name="newUsername" required>

                        <label for="newPassword">Nouveau mot de passe :</label>
                        <input type="password" id="newEditPassword" name="newPassword">

                        <button type="submit" name="modifier_utilisateur">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>

            <div class="box">
                <h2>Logs</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Récupérer les logs avec la date
                        $sql = "SELECT date, type, description FROM logs ORDER BY id DESC";  // Sélectionner la colonne date
                        $stmt = $pdo->query($sql);
                            
                        if ($stmt->rowCount() > 0) {
                            // Afficher chaque log
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td data-label='Date'>" . htmlspecialchars($row['date']) . "</td>";  // Afficher la date
                                echo "<td data-label='Type'>" . htmlspecialchars($row['type']) . "</td>";
                                echo "<td data-label='Description'>" . htmlspecialchars($row['description']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>Aucun log trouvé.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
                            
            <div class="box">
                <h2>Messages reçus</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Sujet</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Récupérer les messages
                        $sql = "SELECT id, nom, email, sujet FROM messages ORDER BY id DESC"; 
                        $stmt = $pdo->query($sql);

                        if ($stmt->rowCount() > 0) {
                            // Afficher chaque message
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td data-label='Nom'>" . htmlspecialchars($row['nom']) . "</td>";
                                echo "<td data-label='Email'>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td data-label='Sujet'>" . htmlspecialchars($row['sujet']) . "</td>";
                                echo "<td data-label='Actions'>
                                        <button class='view-message-btn' data-id='" . $row['id'] . "'>Voir le message</button>
                                        <button class='delete-message-btn' data-id='" . $row['id'] . "'>Supprimer</button>
                                        </td>"; 
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>Aucun message trouvé.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Popup pour afficher le message -->
            <div class="popup" id="messagePopup">
                <div class="popup-content">
                    <button class="close-btn" id="closeMessagePopup">X</button>
                    <h2>Message</h2>
                    <div id="messageContent">

                    </div>
                </div>
            </div>

            
            <div class="box">
                <h2>Contenu accueil</h2>
                <form action="../php/ajouter_accueil_content.php" method="post">
                    <label for="type">Type de contenu:</label>
                    <select id="type" name="type">
                        <option value="title1">Titre 1</option>
                        <option value="title2">Titre 2</option>
                        <option value="title3">Titre 3</option>
                        <option value="image">Image</option>
                        <option value="text">Texte</option>
                    </select>

                    <label for="content">Contenu:</label>
                    <textarea id="content" name="content" required></textarea>

                    <button type="submit" name="ajouter">Ajouter</button>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Contenu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Récupérer le contenu de l'accueil
                        $sql = "SELECT * FROM accueil_content";
                        $stmt = $pdo->query($sql);

                        if ($stmt->rowCount() > 0) {
                            // Afficher chaque élément de contenu
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td data-label='Type'>" . htmlspecialchars($row['type']) . "</td>";
                                echo "<td data-label='Contenu'>" . htmlspecialchars($row['content']) . "</td>";
                                echo "<td data-label='Actions'>
                                        <button class='delete-content-btn' data-id='" . $row['id'] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet élément ?\");'>Supprimer</button>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Aucun élément trouvé.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
        </section>
    </main>
    
    <footer>
        <div class="footer-text">&copy; 2024 Rue Des Potiers. Tous droits réservés.</div>
    </footer>
</body>

<script src="../js/burgerMenu.js"></script>
<script src="../js/admin_dashboard.js"></script>    
<?php include('../php/remplissage_auto_admin.php'); ?> 

<script>

</script>

</html>