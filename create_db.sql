-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-kskskzkz.alwaysdata.net
-- Generation Time: Nov 07, 2024 at 10:37 PM
-- Server version: 10.11.8-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kskskzkz_ruedespotiers`
--

-- --------------------------------------------------------

--
-- Table structure for table `accueil_content`
--

CREATE TABLE `accueil_content` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `content` varchar(4096) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accueil_content`
--

INSERT INTO `accueil_content` (`id`, `type`, `content`) VALUES
(31, 'title1', 'Bienvenue à l\'atelier Rue des Potiers, où la terre prend vie'),
(32, 'text', 'Bienvenue dans le monde fascinant de la poterie artisanale, où la terre brute se transforme en créations uniques et expressives. À l\'atelier Rue des Potiers, nous perpétuons un savoir-faire ancestral, mariant tradition et innovation pour donner vie à des céramiques qui racontent une histoire. Chaque pièce est le fruit d\'un long processus créatif, débutant par la sélection minutieuse des terres locales, véritables trésors de notre terroir. Le façonnage sur le tour, geste précis et patient, révèle la forme et l\'âme de chaque objet. La cuisson, étape cruciale, confère aux pièces leur résistance et leur caractère unique. Nos créations, qu\'elles soient utilitaires ou décoratives, témoignent d\'une passion pour la matière et d\'un respect pour les techniques traditionnelles. Nous vous invitons à découvrir un univers où la beauté se conjugue à la fonctionnalité, où l\'art s\'invite au quotidien. Laissez-vous charmer par la finesse des lignes, la richesse des textures et la chaleur des couleurs de nos céramiques, empreintes de l\'âme de l\'artisan.'),
(34, 'title2', 'L\'art de la poterie, une tradition millénaire revisitée avec passion'),
(35, 'text', 'La poterie, art millénaire, est un dialogue constant entre l\'homme et la terre. À l\'atelier Rue des Potiers, nous nous inscrivons dans cette tradition en créant des pièces uniques qui reflètent notre passion pour la matière et notre respect pour l\'environnement. Nous privilégions les terres locales, riches en nuances et en textures, pour façonner des céramiques qui s\'intègrent harmonieusement dans votre intérieur. Nos créations utilitaires, telles que les tasses, les bols, les assiettes, sont pensées pour allier esthétique et praticité. Leurs formes ergonomiques et leurs finitions soignées vous offrent une expérience sensorielle unique au quotidien. Nos pièces décoratives, quant à elles, apportent une touche d\'originalité et de poésie à votre espace de vie. Vases, sculptures, luminaires, autant de créations qui témoignent de notre créativité et de notre savoir-faire. La poterie est un art vivant, en constante évolution. Nous nous efforçons de repousser les limites de la création en explorant de nouvelles techniques et en intégrant des éléments naturels à nos pièces. La nature est notre source d\'inspiration infinie, et nous cherchons à retranscrire sa beauté et sa force dans nos céramiques.'),
(37, 'title3', 'Terres locales et techniques traditionnelles, au cœur de notre démarche'),
(38, 'text', 'L\'atelier Rue des Potiers est un lieu de création et de partage, où la passion de la terre se transmet de génération en génération. Nous vous invitons à découvrir notre univers à travers nos collections de céramiques, mais aussi à travers des ateliers et des démonstrations. Nous organisons régulièrement des stages de poterie pour tous les niveaux, du débutant au confirmé. Vous pourrez ainsi vous initier aux techniques de façonnage, de décoration et de cuisson, et créer vos propres pièces uniques. Nos ateliers sont des moments de convivialité et d\'échange, où vous pourrez partager votre passion avec d\'autres amateurs de poterie. Nous proposons également des visites guidées de notre atelier, pour vous faire découvrir les différentes étapes de la création d\'une céramique, de la terre brute à la pièce finie. Vous pourrez observer le travail de l\'artisan, poser vos questions et admirer nos collections. L\'atelier Rue des Potiers est un lieu ouvert à tous, où la passion de la terre se partage sans limites. Que vous soyez un amateur d\'art, un passionné de céramique ou simplement curieux de découvrir un savoir-faire ancestral, nous vous accueillons avec plaisir dans notre univers.'),
(40, 'title1', 'La passion de la terre, un héritage ancestral'),
(41, 'text', 'Depuis des générations, l\'atelier Rue des Potiers perpétue un savoir-faire ancestral, transmis de maître à apprenti. La passion de la terre est ancrée dans notre ADN, et nous nous efforçons de préserver les techniques traditionnelles tout en les adaptant aux besoins et aux goûts d\'aujourd\'hui. Notre atelier est un lieu de transmission, où l\'amour du métier et le respect de la matière se conjuguent pour donner vie à des céramiques authentiques et durables. Nous puisons notre inspiration dans les formes et les motifs traditionnels, tout en laissant libre cours à notre créativité pour proposer des pièces uniques et originales. La terre est notre matière première, notre source d\'inspiration, notre lien avec la nature. Nous la travaillons avec respect, en utilisant des techniques ancestrales qui ont fait leurs preuves au fil des siècles. Le façonnage sur le tour, la cuisson au four à bois, l\'émaillage à la main, autant d\'étapes qui confèrent à nos céramiques leur caractère unique et leur charme intemporel.'),
(42, 'title2', 'Des pièces uniques, façonnées avec amour et respect de la matière'),
(43, 'text', 'Chaque pièce qui sort de notre atelier est unique, fruit d\'un dialogue intime entre l\'artisan et la terre. Nous ne produisons pas en série, mais nous créons des objets singuliers, porteurs d\'une histoire et d\'une émotion. La terre est une matière vivante, qui se laisse modeler et transformer à la main. Nous laissons libre cours à notre intuition et à notre créativité pour donner forme à des pièces qui reflètent notre sensibilité et notre vision du monde. Nous accordons une grande importance à la qualité des matériaux que nous utilisons. Nous sélectionnons avec soin les terres locales, les pigments naturels et les émaux traditionnels pour garantir la beauté et la durabilité de nos créations. Chaque étape du processus de fabrication est réalisée avec minutie et attention, du façonnage à la cuisson en passant par la décoration. Nos céramiques sont le fruit d\'un travail artisanal passionné, où chaque détail compte.'),
(44, 'title3', 'Céramiques utilitaires et décoratives, pour un art de vivre au quotidien'),
(45, 'text', 'Nos créations céramiques s\'intègrent harmonieusement dans votre quotidien, que ce soit pour un usage utilitaire ou décoratif. Nous proposons une large gamme de pièces, des plus simples aux plus sophistiquées, pour répondre à tous vos besoins et à toutes vos envies. Nos céramiques utilitaires, telles que les tasses, les bols, les assiettes, les plats, sont conçues pour être à la fois belles et pratiques. Elles sont agréables à utiliser au quotidien, et leur esthétique raffinée apporte une touche d\'élégance à votre table. Nos céramiques décoratives, telles que les vases, les sculptures, les luminaires, sont de véritables œuvres d\'art qui embellissent votre intérieur. Elles apportent une touche de poésie et d\'originalité à votre espace de vie, et témoignent de votre goût pour l\'artisanat et la beauté. Que vous recherchiez des pièces fonctionnelles ou des objets d\'art, vous trouverez chez nous des céramiques qui vous ressemblent et qui vous accompagneront au fil des jours.'),
(46, 'image', 'https://ruedespotiers.kubel.tech/images/pot_gris.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`) VALUES
('admin', 'admin3il');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `champ` varchar(20) NOT NULL,
  `valeur` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`champ`, `valeur`) VALUES
('adresse', '3 rue des Potiers, 12000 Rodez'),
('mail', 'contact@ruedespotiers.fr'),
('nom', 'Paul Tiers'),
('telephone', '06 39 98 12 12');

-- --------------------------------------------------------

--
-- Table structure for table `images_produits`
--

CREATE TABLE `images_produits` (
  `idProduit` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images_produits`
--

INSERT INTO `images_produits` (`idProduit`, `link`) VALUES
(3, '../images/produits/pot3.jpg'),
(1, '../images/produits/pot1.jpg'),
(2, '../images/produits/pot2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `type`, `description`, `date`) VALUES
(1, 'Ajout utilisateur', 'L\'utilisateur Test a été ajouté par l\'admin admin', '2024-10-22 09:26:38'),
(2, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-22 09:46:38'),
(3, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-22 09:48:25'),
(4, 'Connexion', 'admin s\'est connecté', '2024-10-22 09:48:30'),
(5, 'Suppression Administrateur', 'admin a supprimé l\'administrateur \'molyadm\'.', '2024-10-22 09:48:40'),
(6, 'Ajout utilisateur', 'L\'utilisateur molyadm a été ajouté par admin', '2024-10-22 09:48:48'),
(7, 'Modification Contact', 'admin a modifié les informations de contact.', '2024-10-22 09:49:09'),
(8, 'Modification Contact', 'admin a modifié les informations de contact.', '2024-10-22 09:49:14'),
(9, 'Ajout utilisateur', 'L\'utilisateur Test a été ajouté par admin', '2024-10-22 09:50:02'),
(10, 'Suppression Administrateur', 'admin a supprimé l\'administrateur \'Test\'.', '2024-10-22 09:50:07'),
(11, 'Modification Produit', 'admin a modifié le produit avec l\'ID 3.', '2024-10-22 09:50:33'),
(12, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-22 09:52:21'),
(13, 'Connexion', 'admin s\'est connecté', '2024-10-22 09:52:30'),
(14, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-22 09:57:38'),
(15, 'Connexion', 'admin s\'est connecté', '2024-10-22 09:57:45'),
(16, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-22 10:13:33'),
(17, 'Connexion', 'admin s\'est connecté', '2024-10-22 10:15:42'),
(18, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-22 10:25:46'),
(19, 'Connexion', 'admin s\'est connecté', '2024-10-22 10:25:59'),
(20, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-22 10:26:26'),
(21, 'Connexion', 'admin s\'est connecté', '2024-10-22 10:26:41'),
(22, 'Ajout administrateur', 'L\'utilisateur fgvvvf a été ajouté par admin', '2024-10-22 10:27:28'),
(23, 'Suppression Administrateur', 'admin a supprimé l\'administrateur \'fgvvvf\'.', '2024-10-22 10:27:36'),
(24, 'Connexion', 'admin s\'est connecté', '2024-10-22 10:30:13'),
(25, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-22 10:30:38'),
(26, 'Suppression Produit', 'admin a supprimé le produit avec l\'ID 1.', '2024-10-22 10:32:15'),
(27, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-22 10:33:09'),
(28, 'Connexion', 'admin s\'est connecté', '2024-10-22 10:33:44'),
(29, 'Suppression Produit', 'admin a supprimé le produit avec l\'ID 2.', '2024-10-22 10:33:50'),
(30, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-22 10:34:58'),
(31, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-22 10:37:02'),
(32, 'Connexion', 'admin s\'est connecté', '2024-10-22 10:43:12'),
(33, 'Connexion', 'admin s\'est connecté', '2024-10-22 11:03:56'),
(34, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-22 11:04:04'),
(35, 'Connexion', 'admin s\'est connecté', '2024-10-23 13:33:55'),
(36, 'Connexion', 'admin s\'est connecté', '2024-10-25 08:59:19'),
(37, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-25 10:19:42'),
(38, 'Connexion', 'admin s\'est connecté', '2024-10-25 10:20:03'),
(39, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-25 10:23:38'),
(40, 'Connexion', 'admin s\'est connecté', '2024-10-25 10:44:42'),
(41, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-25 11:25:42'),
(42, 'Connexion', 'admin s\'est connecté', '2024-10-27 18:18:21'),
(43, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-27 18:19:14'),
(44, 'Connexion', 'admin s\'est connecté', '2024-10-28 08:35:56'),
(45, 'Connexion', 'admin s\'est connecté', '2024-10-28 09:23:48'),
(46, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-28 09:24:20'),
(47, 'Connexion', 'admin s\'est connecté', '2024-10-29 15:23:21'),
(48, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-29 16:16:31'),
(49, 'Connexion', 'admin s\'est connecté', '2024-10-29 22:52:50'),
(50, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-29 22:57:00'),
(51, 'Connexion', 'admin s\'est connecté', '2024-10-29 22:57:05'),
(52, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-29 22:58:52'),
(53, 'Connexion', 'admin s\'est connecté', '2024-10-29 23:04:15'),
(54, 'Déconnexion', 'admin s\'est déconnecté.', '2024-10-29 23:04:28'),
(55, 'Connexion', 'admin s\'est connecté', '2024-10-30 16:29:51'),
(56, 'Suppression message', 'admin a supprimé le message avec l\'ID .', '2024-10-30 16:50:14'),
(57, 'Connexion', 'admin s\'est connecté', '2024-11-05 08:40:40'),
(58, 'Suppression Message', 'admin a supprimé le message avec l\'ID 5.', '2024-11-05 08:41:05'),
(59, 'Déconnexion', 'admin s\'est déconnecté.', '2024-11-05 08:44:52'),
(60, 'Connexion', 'admin s\'est connecté', '2024-11-05 09:16:49'),
(61, 'Connexion', 'admin s\'est connecté', '2024-11-05 09:51:59'),
(62, 'Connexion', 'admin s\'est connecté', '2024-11-05 10:01:34'),
(63, 'Déconnexion', 'admin s\'est déconnecté.', '2024-11-05 10:45:15'),
(64, 'Connexion', 'admin s\'est connecté', '2024-11-05 10:45:20'),
(65, 'Connexion', 'admin s\'est connecté', '2024-11-05 10:46:53'),
(66, 'Connexion', 'admin s\'est connecté', '2024-11-05 10:48:38'),
(67, 'Déconnexion', 'admin s\'est déconnecté.', '2024-11-05 10:50:48'),
(68, 'Connexion', 'admin s\'est connecté', '2024-11-05 10:50:52'),
(69, 'Connexion', 'admin s\'est connecté', '2024-11-05 10:51:40'),
(70, 'Ajout contenu accueil', 'Contenu avec ID 46 - title1 ajouté par ', '2024-11-05 10:54:19'),
(71, 'Ajout contenu accueil', 'Contenu avec ID 47 - title1 ajouté par ', '2024-11-05 10:54:24'),
(72, 'Supprimer contenu accueil', 'Contenu avec ID 46 supprimé par ', '2024-11-05 10:54:50'),
(73, 'Supprimer contenu accueil', 'Contenu avec ID 47 supprimé par ', '2024-11-05 10:56:14'),
(74, 'Ajout contenu accueil', 'Contenu avec ID 46 - title1 ajouté par ', '2024-11-05 10:56:28'),
(75, 'Supprimer contenu accueil', 'Contenu avec ID 46 supprimé par ', '2024-11-05 10:57:09'),
(76, 'Ajout contenu accueil', 'Contenu avec ID 46 - title1 ajouté par ', '2024-11-05 10:58:22'),
(77, 'Ajout contenu accueil', 'Contenu avec ID 47 - title1 ajouté par ', '2024-11-05 10:59:01'),
(78, 'Ajout contenu accueil', 'Contenu avec ID 48 - title1 ajouté par ', '2024-11-05 11:01:50'),
(79, 'Supprimer contenu accueil', 'Contenu avec ID 48 supprimé par ', '2024-11-05 11:02:01'),
(80, 'Supprimer contenu accueil', 'Contenu avec ID 47 supprimé par ', '2024-11-05 11:02:09'),
(81, 'Supprimer contenu accueil', 'Contenu avec ID 46 supprimé par ', '2024-11-05 11:02:36'),
(82, 'Ajout contenu accueil', 'Contenu avec ID 46 - title1 ajouté par ', '2024-11-05 11:02:48'),
(83, 'Ajout contenu accueil', 'Contenu avec ID 47 - title1 ajouté par ', '2024-11-05 11:02:51'),
(84, 'Ajout contenu accueil', 'Contenu avec ID 48 - title1 ajouté par ', '2024-11-05 11:02:54'),
(85, 'Supprimer contenu accueil', 'Contenu avec ID 46 supprimé par ', '2024-11-05 11:03:17'),
(86, 'Supprimer contenu accueil', 'Contenu avec ID 47 supprimé par ', '2024-11-05 11:03:22'),
(87, 'Supprimer contenu accueil', 'Contenu avec ID 48 supprimé par ', '2024-11-05 11:03:28'),
(88, 'Ajout contenu accueil', 'Contenu avec ID 46 - title1 ajouté par ', '2024-11-05 11:03:53'),
(89, 'Supprimer contenu accueil', 'Contenu avec ID 46 supprimé par ', '2024-11-05 11:08:22'),
(90, 'Déconnexion', 'admin s\'est déconnecté.', '2024-11-05 11:09:02'),
(91, 'Connexion', 'admin s\'est connecté', '2024-11-05 11:09:45'),
(92, 'Ajout de produit', 'Produit ID 4 - test ajouté par admin', '2024-11-05 11:23:31'),
(93, 'Ajout contenu accueil', 'Contenu avec ID 46 - title1 ajouté par admin', '2024-11-05 11:24:42'),
(94, 'Supprimer contenu accueil', 'Contenu avec ID 46 supprimé par admin', '2024-11-05 11:25:56'),
(95, 'Ajout contenu accueil', 'Contenu avec ID 46 - title1 ajouté par admin', '2024-11-05 11:26:03'),
(96, 'Ajout contenu accueil', 'Contenu avec ID 47 - title1 ajouté par admin', '2024-11-05 11:26:10'),
(97, 'Supprimer contenu accueil', 'Contenu avec ID 47 supprimé par admin', '2024-11-05 11:26:17'),
(98, 'Supprimer contenu accueil', 'Contenu avec ID 46 supprimé par admin', '2024-11-05 11:26:20'),
(99, 'Ajout contenu accueil', 'Contenu avec ID 46 - title1 ajouté par admin', '2024-11-05 11:27:47'),
(100, 'Supprimer contenu accueil', 'Contenu avec ID 46 supprimé par admin', '2024-11-05 11:27:57'),
(101, 'Ajout contenu accueil', 'Contenu avec ID 46 - title1 ajouté par admin', '2024-11-05 11:28:04'),
(102, 'Supprimer contenu accueil', 'Contenu avec ID 46 supprimé par admin', '2024-11-05 11:28:11'),
(103, 'Supprimer contenu accueil', 'Contenu avec ID 33 supprimé par admin', '2024-11-05 11:28:23'),
(104, 'Supprimer contenu accueil', 'Contenu avec ID 36 supprimé par admin', '2024-11-05 11:28:28'),
(105, 'Supprimer contenu accueil', 'Contenu avec ID 39 supprimé par admin', '2024-11-05 11:28:38'),
(106, 'Ajout contenu accueil', 'Contenu avec ID 46 - image ajouté par admin', '2024-11-05 11:29:21'),
(107, 'Modification contenu accueil', 'Contenu avec ID  modifié par admin', '2024-11-05 11:30:57'),
(108, 'Modification contenu accueil', 'Contenu avec ID  modifié par admin', '2024-11-05 11:31:15'),
(109, 'Modification contenu accueil', 'Contenu avec ID  modifié par admin', '2024-11-05 11:31:53'),
(110, 'Modification contenu accueil', 'Contenu avec ID  modifié par admin', '2024-11-05 11:34:09'),
(111, 'Modification contenu accueil', 'Contenu avec ID  modifié par admin', '2024-11-05 11:35:30'),
(112, 'Modification contenu accueil', 'Contenu avec ID  modifié par admin', '2024-11-05 11:41:08'),
(113, 'Modification contenu accueil', 'Contenu avec ID  modifié par admin', '2024-11-05 11:41:57'),
(114, 'Supprimer contenu accueil', 'Contenu avec ID 46 supprimé par admin', '2024-11-05 11:48:03'),
(115, 'Ajout contenu accueil', 'Contenu avec ID 46 - image ajouté par admin', '2024-11-05 11:48:32'),
(116, 'Suppression Produit', 'admin a supprimé le produit avec l\'ID 4.', '2024-11-05 11:50:21'),
(117, 'Ajout de produit', 'Produit ID 4 - test ajouté par admin', '2024-11-05 11:50:41'),
(118, 'Suppression Produit', 'admin a supprimé le produit avec l\'ID 4.', '2024-11-05 11:51:03'),
(119, 'Suppression Administrateur', 'admin a supprimé l\'administrateur \'molyadm\'.', '2024-11-05 11:54:55'),
(120, 'Connexion', 'admin s\'est connecté', '2024-11-06 10:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sujet` varchar(200) DEFAULT NULL,
  `content` varchar(4096) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `nom`, `email`, `sujet`, `content`) VALUES
(6, 'test', 'test@ruedespotiers.fr', 'Test quentin', 'salut'),
(7, 'mesure', 'test@ruedespotiers.fr', 'pour mesure', 'je fais les mesures'),
(8, 'r', 'r@d', 'r', 'quentin !!!');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `titre` varchar(30) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `titre`, `description`) VALUES
(1, 'Pot en terre cuite', 'Un pot artisanal en terre cuite, idéal pour vos plantes d\'intérieur et d\'extérieur.'),
(2, 'Pot décoratif en céramique', 'Un pot en céramique au design moderne pour embellir votre maison.'),
(3, 'Pot de jardinage en plastique', 'Un pot léger et durable en plastique recyclé, parfait pour les terrasses et balcons.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accueil_content`
--
ALTER TABLE `accueil_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`champ`);

--
-- Indexes for table `images_produits`
--
ALTER TABLE `images_produits`
  ADD KEY `idProduit` (`idProduit`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accueil_content`
--
ALTER TABLE `accueil_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images_produits`
--
ALTER TABLE `images_produits`
  ADD CONSTRAINT `images_produits_ibfk_1` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
