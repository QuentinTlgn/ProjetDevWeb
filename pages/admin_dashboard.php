<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
    header("Location: admin_login.php");
    exit();
}

include('../php/db.php');
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

            <!-- Popup (lightbox) pour modifier un produit -->
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

            <div class="box">Box 4</div>
        </section>
    </main>
    
    <footer>
        <div class="footer-text">&copy; 2024 Quentin TAULEIGNE. Tous droits réservés.</div>
    </footer>
</body>

<script src="../js/burgerMenu.js"></script>
<script src="../js/editProduct.js"></script>        
<?php include('../php/remplissage_auto_admin.php'); ?> 


</html>