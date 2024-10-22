
#Création de la database et utilisateur

# Utilisateur externe
CREATE OR REPLACE USER ruedespotiersadm@'%' IDENTIFIED BY 'ladminderuedespotiersadm';

# Utilisateur local
CREATE OR REPLACE USER ruedespotiersadm@'localhost' IDENTIFIED BY 'ladminderuedespotiersadm';

CREATE OR REPLACE DATABASE ruedespotiers;
USE ruedespotiers;

GRANT ALL PRIVILEGES
ON ruedespotiers.*
TO 'ruedespotiersadm'@'%'
WITH GRANT OPTION;

GRANT ALL PRIVILEGES
ON ruedespotiers.*
TO 'ruedespotiersadm'@'localhost'
WITH GRANT OPTION;

#Création de la table contenant les utilisateurs admins
CREATE OR REPLACE TABLE admins (username VARCHAR(50), password VARCHAR(50));
INSERT INTO admins VALUES ('admin', 'admin3il');

#Création de la table contenant les infos de contact
CREATE OR REPLACE TABLE contacts (champ VARCHAR(20) PRIMARY KEY NOT NULL, valeur VARCHAR(100));
INSERT INTO contacts VALUES ('adresse', '3 rue des Potiers, 12000 Rodez');
INSERT INTO contacts VALUES ('nom','Paul Tiers');
INSERT INTO contacts VALUES ('mail','contact@ruedespotiers.fr');
INSERT INTO contacts VALUES ('telephone','06 39 98 12 12');

#Création de la table qui contiendra les produits
CREATE OR REPLACE TABLE produits (id INT PRIMARY KEY NOT NULL, titre VARCHAR(30), description VARCHAR(512));

#Création de la table qui contiendra les images
CREATE OR REPLACE TABLE images_produits (idProduit INT, link VARCHAR(255), FOREIGN KEY (idProduit) REFERENCES produits(id));

#Remplissage des tables produits
-- Insertion des produits dans la table 'produits'
INSERT INTO produits (id, titre, description) VALUES
(1, 'Pot en terre cuite', 'Un pot artisanal en terre cuite, idéal pour vos plantes d\'intérieur et d\'extérieur.'),
(2, 'Pot décoratif en céramique', 'Un pot en céramique au design moderne pour embellir votre maison.'),
(3, 'Pot de jardinage en plastique', 'Un pot léger et durable en plastique recyclé, parfait pour les balcons et terrasses.');

-- Insertion des images associées dans la table 'images_produits'
INSERT INTO images_produits (idProduit, link) VALUES
(1, '../images/produits/pot1.jpg'),
(2, '../images/produits/pot2.jpg'),
(3, '../images/produits/pot3.jpg');

CREATE OR REPLACE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(50),
    description VARCHAR(512),
    date DATETIME DEFAULT CURRENT_TIMESTAMP
);