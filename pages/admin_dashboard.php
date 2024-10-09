<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
    header("Location: admin_login.php");
    exit();
}
?>

<?php

// Inclure la connexion à la base de données
include('../php/db.php');

// Préparer une variable pour stocker le produit à modifier si sélectionné
$produitAModifier = null;

// Si un produit est sélectionné pour modification (paramètre GET 'id')
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations du produit
    $sql = "SELECT p.id, p.titre, p.description, i.link AS image 
            FROM produits p 
            LEFT JOIN images_produits i ON p.id = i.idProduit 
            WHERE p.id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $produitAModifier = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Si le formulaire de modification est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    // Mettre à jour les informations du produit
    $updateSQL = "UPDATE produits SET titre = ?, description = ? WHERE id = ?";
    $stmt = $pdo->prepare($updateSQL);
    $stmt->execute([$titre, $description, $id]);

    // Rediriger avec un message de succès
    header("Location: admin_dashboard.php?success=2");
    exit();
}
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
                                        <button class='delete-btn' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce produit ?\");'>Supprimer</button>
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
                    <form action="../php/modifier_produit.php" method="post" id="editForm">
                        <input type="hidden" id="editId" name="id">

                        <label for="editTitre">Titre du produit :</label>
                        <input type="text" id="editTitre" name="titre" required>

                        <label for="editDescription">Description du produit :</label>
                        <input type="text" id="editDescription" name="description" required>

                        <button type="submit" name="modifier">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>

            <div class="box">Box 3</div>
            <div class="box">Box 4</div>
        </section>
    </main>
    
    <footer>
        <div class="footer-text">&copy; 2024 Quentin TAULEIGNE. Tous droits réservés.</div>
    </footer>
</body>

<script src="../js/burgerMenu.js"></script>
<script src="../js/editProduct.js"></script>        

</html>