
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

CREATE OR REPLACE TABLE accueil_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(50),
    content VARCHAR(4096)
);


-- Remplissage de la table accueil_content
-- Titre H1 (1)
INSERT INTO accueil_content (type, content) VALUES 
('title1', 'Bienvenue à l\'atelier Rue des Potiers, où la terre prend vie');

-- Texte (2)
INSERT INTO accueil_content (type, content) VALUES 
('text', 'Bienvenue dans le monde fascinant de la poterie artisanale, où la terre brute se transforme en créations uniques et expressives. À l\'atelier Rue des Potiers, nous perpétuons un savoir-faire ancestral, mariant tradition et innovation pour donner vie à des céramiques qui racontent une histoire. Chaque pièce est le fruit d\'un long processus créatif, débutant par la sélection minutieuse des terres locales, véritables trésors de notre terroir. Le façonnage sur le tour, geste précis et patient, révèle la forme et l\'âme de chaque objet. La cuisson, étape cruciale, confère aux pièces leur résistance et leur caractère unique. Nos créations, qu\'elles soient utilitaires ou décoratives, témoignent d\'une passion pour la matière et d\'un respect pour les techniques traditionnelles. Nous vous invitons à découvrir un univers où la beauté se conjugue à la fonctionnalité, où l\'art s\'invite au quotidien. Laissez-vous charmer par la finesse des lignes, la richesse des textures et la chaleur des couleurs de nos céramiques, empreintes de l\'âme de l\'artisan.');

-- Image (3)
INSERT INTO accueil_content (type, content) VALUES 
('image', 'images/accueil/pottery_wheel.jpg');

-- Titre H2 (4)
INSERT INTO accueil_content (type, content) VALUES 
('title2', 'L\'art de la poterie, une tradition millénaire revisitée avec passion');

-- Texte (5)
INSERT INTO accueil_content (type, content) VALUES 
('text', 'La poterie, art millénaire, est un dialogue constant entre l\'homme et la terre. À l\'atelier Rue des Potiers, nous nous inscrivons dans cette tradition en créant des pièces uniques qui reflètent notre passion pour la matière et notre respect pour l\'environnement. Nous privilégions les terres locales, riches en nuances et en textures, pour façonner des céramiques qui s\'intègrent harmonieusement dans votre intérieur. Nos créations utilitaires, telles que les tasses, les bols, les assiettes, sont pensées pour allier esthétique et praticité. Leurs formes ergonomiques et leurs finitions soignées vous offrent une expérience sensorielle unique au quotidien. Nos pièces décoratives, quant à elles, apportent une touche d\'originalité et de poésie à votre espace de vie. Vases, sculptures, luminaires, autant de créations qui témoignent de notre créativité et de notre savoir-faire. La poterie est un art vivant, en constante évolution. Nous nous efforçons de repousser les limites de la création en explorant de nouvelles techniques et en intégrant des éléments naturels à nos pièces. La nature est notre source d\'inspiration infinie, et nous cherchons à retranscrire sa beauté et sa force dans nos céramiques.');

-- Image (6)
INSERT INTO accueil_content (type, content) VALUES 
('image', 'images/accueil/clay_pots.jpg');

-- Titre H3 (7)
INSERT INTO accueil_content (type, content) VALUES 
('title3', 'Terres locales et techniques traditionnelles, au cœur de notre démarche');

-- Texte (8) 
INSERT INTO accueil_content (type, content) VALUES 
('text', 'L\'atelier Rue des Potiers est un lieu de création et de partage, où la passion de la terre se transmet de génération en génération. Nous vous invitons à découvrir notre univers à travers nos collections de céramiques, mais aussi à travers des ateliers et des démonstrations. Nous organisons régulièrement des stages de poterie pour tous les niveaux, du débutant au confirmé. Vous pourrez ainsi vous initier aux techniques de façonnage, de décoration et de cuisson, et créer vos propres pièces uniques. Nos ateliers sont des moments de convivialité et d\'échange, où vous pourrez partager votre passion avec d\'autres amateurs de poterie. Nous proposons également des visites guidées de notre atelier, pour vous faire découvrir les différentes étapes de la création d\'une céramique, de la terre brute à la pièce finie. Vous pourrez observer le travail de l\'artisan, poser vos questions et admirer nos collections. L\'atelier Rue des Potiers est un lieu ouvert à tous, où la passion de la terre se partage sans limites. Que vous soyez un amateur d\'art, un passionné de céramique ou simplement curieux de découvrir un savoir-faire ancestral, nous vous accueillons avec plaisir dans notre univers.');

-- Image (9)
INSERT INTO accueil_content (type, content) VALUES 
('image', 'images/accueil/artisan_working.jpg');

-- Titre H1 (10)
INSERT INTO accueil_content (type, content) VALUES 
('title1', 'La passion de la terre, un héritage ancestral');

-- Texte (10.1)
INSERT INTO accueil_content (type, content) VALUES
('text', 'Depuis des générations, l\'atelier Rue des Potiers perpétue un savoir-faire ancestral, transmis de maître à apprenti. La passion de la terre est ancrée dans notre ADN, et nous nous efforçons de préserver les techniques traditionnelles tout en les adaptant aux besoins et aux goûts d\'aujourd\'hui. Notre atelier est un lieu de transmission, où l\'amour du métier et le respect de la matière se conjuguent pour donner vie à des céramiques authentiques et durables. Nous puisons notre inspiration dans les formes et les motifs traditionnels, tout en laissant libre cours à notre créativité pour proposer des pièces uniques et originales. La terre est notre matière première, notre source d\'inspiration, notre lien avec la nature. Nous la travaillons avec respect, en utilisant des techniques ancestrales qui ont fait leurs preuves au fil des siècles. Le façonnage sur le tour, la cuisson au four à bois, l\'émaillage à la main, autant d\'étapes qui confèrent à nos céramiques leur caractère unique et leur charme intemporel.');

-- Titre H2 (11)
INSERT INTO accueil_content (type, content) VALUES 
('title2', 'Des pièces uniques, façonnées avec amour et respect de la matière');

-- Texte (11.1)
INSERT INTO accueil_content (type, content) VALUES
('text', 'Chaque pièce qui sort de notre atelier est unique, fruit d\'un dialogue intime entre l\'artisan et la terre. Nous ne produisons pas en série, mais nous créons des objets singuliers, porteurs d\'une histoire et d\'une émotion. La terre est une matière vivante, qui se laisse modeler et transformer à la main. Nous laissons libre cours à notre intuition et à notre créativité pour donner forme à des pièces qui reflètent notre sensibilité et notre vision du monde. Nous accordons une grande importance à la qualité des matériaux que nous utilisons. Nous sélectionnons avec soin les terres locales, les pigments naturels et les émaux traditionnels pour garantir la beauté et la durabilité de nos créations. Chaque étape du processus de fabrication est réalisée avec minutie et attention, du façonnage à la cuisson en passant par la décoration. Nos céramiques sont le fruit d\'un travail artisanal passionné, où chaque détail compte.');

-- Titre H3 (12)
INSERT INTO accueil_content (type, content) VALUES 
('title3', 'Céramiques utilitaires et décoratives, pour un art de vivre au quotidien');

-- Texte (12.1)
INSERT INTO accueil_content (type, content) VALUES
('text', 'Nos créations céramiques s\'intègrent harmonieusement dans votre quotidien, que ce soit pour un usage utilitaire ou décoratif. Nous proposons une large gamme de pièces, des plus simples aux plus sophistiquées, pour répondre à tous vos besoins et à toutes vos envies. Nos céramiques utilitaires, telles que les tasses, les bols, les assiettes, les plats, sont conçues pour être à la fois belles et pratiques. Elles sont agréables à utiliser au quotidien, et leur esthétique raffinée apporte une touche d\'élégance à votre table. Nos céramiques décoratives, telles que les vases, les sculptures, les luminaires, sont de véritables œuvres d\'art qui embellissent votre intérieur. Elles apportent une touche de poésie et d\'originalité à votre espace de vie, et témoignent de votre goût pour l\'artisanat et la beauté. Que vous recherchiez des pièces fonctionnelles ou des objets d\'art, vous trouverez chez nous des céramiques qui vous ressemblent et qui vous accompagneront au fil des jours.');

-- Titre H1 (13)
INSERT INTO accueil_content (type, content) VALUES 
('title1', 'Créations artisanales en céramique, entre tradition et innovation');

-- Texte (13.1)
INSERT INTO accueil_content (type, content) VALUES
('text', 'À l\'atelier Rue des Potiers, nous sommes attachés à la tradition, mais nous n\'hésitons pas à explorer de nouvelles voies pour enrichir notre savoir-faire et proposer des créations originales. Nous expérimentons sans cesse de nouvelles techniques, de nouveaux matériaux, de nouvelles formes pour repousser les limites de la céramique et créer des pièces uniques et audacieuses. Nous nous inspirons des tendances actuelles tout en restant fidèles à notre ADN artisanal. Nous cherchons à créer des céramiques qui s\'inscrivent dans leur époque, tout en conservant un caractère intemporel. La tradition et l\'innovation se nourrissent mutuellement pour donner vie à des pièces qui allient esthétique, fonctionnalité et originalité. Nous sommes convaincus que la céramique est un art vivant, en constante évolution, et nous sommes fiers de contribuer à son renouveau.');

-- Titre H2 (14)
INSERT INTO accueil_content (type, content) VALUES 
('title2', 'Découvrez notre savoir-faire, un héritage transmis de génération en génération');

-- Texte (14.1)
INSERT INTO accueil_content (type, content) VALUES
('text', 'Notre savoir-faire est le fruit d\'un long héritage, transmis de génération en génération. Nous sommes fiers de perpétuer la tradition de la poterie artisanale, et de partager notre passion avec le plus grand nombre. Nous vous invitons à découvrir les secrets de notre métier à travers nos ateliers et nos démonstrations. Vous pourrez observer les différentes étapes de la création d\'une céramique, du façonnage à la cuisson en passant par la décoration. Vous pourrez également vous initier aux techniques de la poterie lors de nos stages, et créer vos propres pièces uniques sous la guidance de nos artisans expérimentés. Nous sommes convaincus que la transmission du savoir-faire est essentielle pour préserver la richesse de notre patrimoine artisanal. C\'est pourquoi nous ouvrons les portes de notre atelier à tous ceux qui souhaitent découvrir le monde fascinant de la céramique.');

-- Titre H3 (15)
INSERT INTO accueil_content (type, content) VALUES 
('title3', 'L\'authenticité au cœur de nos créations, reflets de l\'âme de l\'artisan'); 

-- Texte (15.1)
INSERT INTO accueil_content (type, content) VALUES
('text', 'Chaque céramique que nous créons est empreinte d\'authenticité, reflet de notre passion et de notre savoir-faire. Nous mettons tout notre cœur et toute notre âme dans notre travail, et nous sommes fiers de proposer des pièces uniques qui témoignent de notre engagement pour l\'artisanat de qualité. Nos céramiques sont le fruit d\'un travail manuel, réalisé avec des techniques ancestrales et des matériaux naturels. Elles sont exemptes de toute production industrielle, et portent la marque de l\'artisan qui les a façonnées. Lorsque vous choisissez une céramique de l\'atelier Rue des Potiers, vous choisissez une pièce unique, chargée d\'histoire et d\'émotion. Vous choisissez un objet qui vous accompagnera au fil des jours, et qui vous rappellera la beauté et la valeur du travail artisanal.');
