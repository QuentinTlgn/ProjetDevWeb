
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