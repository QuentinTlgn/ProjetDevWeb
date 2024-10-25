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

        <section>
            <h1>Section 2</h1>
            <h2>Section 2.1</h2>
            <h3>Section 2.1.1</h3>
            <p class="formatted-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eget eleifend dui, non molestie mi. Vestibulum aliquet mollis diam, vitae iaculis justo vulputate nec. Phasellus consequat egestas posuere. Ut ac lectus id orci mattis lobortis. Aliquam et urna aliquam, sollicitudin magna molestie, maximus dolor. Praesent lobortis consectetur pharetra. Aliquam imperdiet, quam quis viverra volutpat, lacus mi pulvinar mi, sed pretium sapien nulla ac arcu. Donec felis ligula, tincidunt quis fermentum vitae, posuere ut diam. Pellentesque fermentum nec ipsum eget accumsan. Ut a nibh sed arcu semper suscipit.

                Pellentesque eleifend lacus vitae lacus pellentesque, tempor porta turpis lobortis. Nunc in bibendum massa, vel ultrices lacus. Mauris pretium eu risus eget suscipit. In faucibus in mi eget egestas. Mauris ac venenatis orci. Mauris ornare eu purus sit amet vehicula. Nullam commodo ut lorem non pharetra. Nunc quis urna sit amet quam luctus finibus. Nullam non commodo massa, ullamcorper sollicitudin nisi. Praesent eget orci elementum urna faucibus dapibus id at augue. Curabitur porttitor ante odio, vel sollicitudin arcu commodo nec. Cras ut nibh a nulla ullamcorper scelerisque. Duis auctor fringilla viverra. Quisque nec tortor placerat, aliquet urna sit amet, vestibulum urna.

                Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi dapibus nibh nec justo lobortis finibus. Maecenas quis metus odio. Nunc eget nisi venenatis, vehicula leo lacinia, fermentum est. Etiam tellus augue, malesuada sit amet felis vel, pulvinar pretium purus. Mauris ligula sem, lobortis id dui et, rhoncus tristique ante. Duis bibendum purus at gravida malesuada. Vestibulum fringilla hendrerit lectus vel tempor. Vestibulum eget felis sed massa hendrerit sagittis.

                Sed felis velit, pharetra nec metus et, auctor efficitur nulla. Suspendisse pellentesque imperdiet leo, ac fringilla sapien ullamcorper dignissim. Morbi nec aliquet massa. Curabitur vel dui finibus, ultricies tortor vel, mollis dolor. In vehicula elit in lectus congue facilisis. Duis ac risus porttitor, facilisis urna sed, condimentum sem. Integer tincidunt aliquam leo sed gravida. Aenean aliquet tincidunt maximus.

                Sed fringilla nisl vitae tincidunt mattis. Nam hendrerit hendrerit finibus. Mauris efficitur massa in ornare sagittis. Quisque varius ultricies magna, id consectetur sem placerat non. Mauris scelerisque est fringilla justo iaculis viverra in at arcu. Maecenas sit amet auctor elit. Etiam ullamcorper ac leo non eleifend. Pellentesque consectetur convallis lectus, sit amet mattis elit fringilla sit amet. Maecenas vitae ornare odio, ac mollis metus. Praesent sit amet velit lacinia, iaculis justo vitae, venenatis lorem. Integer dapibus varius bibendum. Integer mi dolor, ultricies id est in, consequat lacinia ligula. Nam vehicula ac justo in mattis. 
            </p>
            <h3>Section 2.1.2</h3>
            <p class="formatted-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eget eleifend dui, non molestie mi. Vestibulum aliquet mollis diam, vitae iaculis justo vulputate nec. Phasellus consequat egestas posuere. Ut ac lectus id orci mattis lobortis. Aliquam et urna aliquam, sollicitudin magna molestie, maximus dolor. Praesent lobortis consectetur pharetra. Aliquam imperdiet, quam quis viverra volutpat, lacus mi pulvinar mi, sed pretium sapien nulla ac arcu. Donec felis ligula, tincidunt quis fermentum vitae, posuere ut diam. Pellentesque fermentum nec ipsum eget accumsan. Ut a nibh sed arcu semper suscipit.
                
                Pellentesque eleifend lacus vitae lacus pellentesque, tempor porta turpis lobortis. Nunc in bibendum massa, vel ultrices lacus. Mauris pretium eu risus eget suscipit. In faucibus in mi eget egestas. Mauris ac venenatis orci. Mauris ornare eu purus sit amet vehicula. Nullam commodo ut lorem non pharetra. Nunc quis urna sit amet quam luctus finibus. Nullam non commodo massa, ullamcorper sollicitudin nisi. Praesent eget orci elementum urna faucibus dapibus id at augue. Curabitur porttitor ante odio, vel sollicitudin arcu commodo nec. Cras ut nibh a nulla ullamcorper scelerisque. Duis auctor fringilla viverra. Quisque nec tortor placerat, aliquet urna sit amet, vestibulum urna.
                
                Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi dapibus nibh nec justo lobortis finibus. Maecenas quis metus odio. Nunc eget nisi venenatis, vehicula leo lacinia, fermentum est. Etiam tellus augue, malesuada sit amet felis vel, pulvinar pretium purus. Mauris ligula sem, lobortis id dui et, rhoncus tristique ante. Duis bibendum purus at gravida malesuada. Vestibulum fringilla hendrerit lectus vel tempor. Vestibulum eget felis sed massa hendrerit sagittis.
                
                Sed felis velit, pharetra nec metus et, auctor efficitur nulla. Suspendisse pellentesque imperdiet leo, ac fringilla sapien ullamcorper dignissim. Morbi nec aliquet massa. Curabitur vel dui finibus, ultricies tortor vel, mollis dolor. In vehicula elit in lectus congue facilisis. Duis ac risus porttitor, facilisis urna sed, condimentum sem. Integer tincidunt aliquam leo sed gravida. Aenean aliquet tincidunt maximus.
                
                Sed fringilla nisl vitae tincidunt mattis. Nam hendrerit hendrerit finibus. Mauris efficitur massa in ornare sagittis. Quisque varius ultricies magna, id consectetur sem placerat non. Mauris scelerisque est fringilla justo iaculis viverra in at arcu. Maecenas sit amet auctor elit. Etiam ullamcorper ac leo non eleifend. Pellentesque consectetur convallis lectus, sit amet mattis elit fringilla sit amet. Maecenas vitae ornare odio, ac mollis metus. Praesent sit amet velit lacinia, iaculis justo vitae, venenatis lorem. Integer dapibus varius bibendum. Integer mi dolor, ultricies id est in, consequat lacinia ligula. Nam vehicula ac justo in mattis. 
            </p>
        </section>
    </main>


    <footer>
        <div class="footer-text">&copy; 2024 Quentin TAULEIGNE. Tous droits réservés.</div>
        <a href="/pages/admin_login.php" class="footer-link">Administration</a>
    </footer>

</body>

<script src="../js/imageViewer.js"></script>
<script src="../js/burgerMenu.js"></script>    

</html>