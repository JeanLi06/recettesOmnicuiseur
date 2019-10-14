-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 14, 2019 at 02:26 PM
-- Server version: 10.1.41-MariaDB-1~jessie
-- PHP Version: 5.6.40-0+deb8u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jeanl1235352`
--

-- --------------------------------------------------------

--
-- Table structure for table `recette`
--

CREATE TABLE `recette` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(128) NOT NULL,
  `photo` char(128) NOT NULL,
  `ingredients_list` varchar(16384) NOT NULL,
  `how_many_persons` tinyint(3) UNSIGNED NOT NULL,
  `cooking_time_minutes` tinyint(3) UNSIGNED NOT NULL,
  `cooking_instructions` text NOT NULL,
  `category` char(64) NOT NULL,
  `note` text NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recette`
--

INSERT INTO `recette` (`id`, `name`, `photo`, `ingredients_list`, `how_many_persons`, `cooking_time_minutes`, `cooking_instructions`, `category`, `note`, `creation_date`) VALUES
(2, 'Îles flottantes', 'f403f74d02a106a6706d2cde372fe05b.jpg', '6 œuf\r\n80 g de sucre\r\n1 sachet de sucre vanillé\r\n75 cl de lait\r\n24 cl d\'eau\r\n75 g de sucre', 6, 20, 'Réalisation d une crème anglaise a froid :\r\nMélangez dans l ordre 6 jaunes d’œuf,\r\n80 g de sucre,\r\n1 sachet de sucre vanillé,\r\n75 cl de lait\r\nDans la grande cocotte ajouter 24 cl d eau\r\nMettre la crème anglaise froide dans le plat à tarte\r\npuis dans la cocotte\r\nMontez des blancs en neige\r\n6 blancs ,75 g de sucre\r\nRéalisez des quenelles, posez les sur la crème anglaise.\r\nLaissez refroidir au frigo.\r\nAjoutez y un caramel ou pas.', 'Dessert', 'haut et bas maxi\r\nInverser la cocotte a 15 mn\r\nN\'ouvrez la cocotte 15 mn après la sonnerie cela permettra à la crème anglaise d être à bonne consistante\r\n', '2019-09-13 15:14:03'),
(3, 'Cabillaud en croûte crumble', '38ac8bc5c1b5191165efb7415e11dfb7.jpg', '800 g de filet cabillaud,\r\n100 g d’amandes concassées,\r\n2 cuillères à café de maïzena,\r\n4 cuillères à soupe de crème d’amande cuisine,\r\n2 cuillères à café bombées de purée d’amande,\r\n2 cuillères à café de sucre,\r\n2 gousses de cardamome (ou 1 cc rase en poudre),\r\n1 gousse d’ail,\r\n2 cm de gingembre frais râpé,\r\nle zeste d’une orange', 4, 25, 'Haut : maxi\r\nBas : maxi', 'Plat', '1. Coupez l’ail et disposez-le au fond du plat porcelaine. Déposez le poisson dessus.\r\n2. Dans un bol, mélangez les amandes, la maïzena, la crème d’amande cuisine, la purée d’amande,\r\nle sucre, la cardamome, le gingembre et le zeste orange.\r\n3. Étalez cette préparation sur le poisson et déposez-le dans le plat en porcelaine.\r\n4. Versez 10 cl d’eau au fond de la cocotte et posez le plat en porcelaine dedans.\r\n5. Fermez la cocotte et mettez en cuisson.', '2018-11-11 17:00:00'),
(4, 'Cake au chocolat d’Alain Ducasse', '2301fe2820e5a7eb03acd3e9567c9940.jpg', '200 gr de farine\r\n    85 gr de cacao en poudre non sucré\r\n    7 gr de levure chimique\r\n    125 gr d\' oeufs (environ 3 petits ou 2 gros œufs)\r\n    300 gr de sucre\r\n    140 gr d\' huile de tournesol\r\n    3/6125 gr de crème liquide entière\r\n    240 gr de lait entier', 8, 75, 'Tamiser le cacao, la farine et la levure chimique dans un cul de poule et réserver.\r\n        2. Mettre les œufs entiers, le sucre et l\'\'huile dans le bol de votre robot et fouetter 4 à 5\r\n        minutes.\r\n        3. Ajouter petit à petit le mélange cacao, farine et levure chimique en mélangeant.\r\n        4. Ajouter la crème liquide pour assouplir la pâte puis verser le lait et mélanger sans\r\n        trop travailler la pâte. La préparation doit être homogène.\r\n        5. Verser la pâte dans un grand moule à cake.\r\n        6. Verser 6 cuillères à soupe d\'\'eau dans le fond de la grande cocotte, déposer le plat à\r\n        cake et refermer la cocotte', 'Dessert', '', '2019-08-14 14:17:49'),
(30, 'Brownie au chocolat - haricots blancs', '5399696f204309fbfd2ba21179ac6aae.jpg', '- 400 g de haricots blancs cuits et égouttés\r\n- 65 g de farine\r\n- 170 g de chocolat noir (en pépites ou râpé)\r\n- 60 ml d\'huile de tournesol\r\n- 175 g de miel ou sirop d\'agave\r\n- 1 c.à café de levure\r\n- 1 pincée de sel.', 8, 30, 'Faire fondre le chocolat au bain marie ou au micro ondes par petites impulsions.\r\nAvec le mixeur plongeant, mixer les haricots blanc avec le miel et l\'huile.\r\nÀ l\'aide d\'une spatule incorporer la farine et la levure et la pincée de sel.', 'Dessert', 'Préparation : 10 mn avec les haricots déjà cuits\r\nGrille en position basse\r\n- 4 c.à soupe d\'eau\r\n\r\nHaut : Maxi 15 mn-Mini 25 mn\r\nBas : Maxi 15 mn-0 le reste du temps\r\nInversion de la cocotte à 15 mn', '2019-08-14 17:15:29'),
(31, 'Cake aux pommes et aux amandes', '3d8a675f058b023fa0a4c92f3cb6213d.jpg', '180 g de farine\r\n1 sachet de levure chimique\r\n2 œufs\r\n20 g de beurre\r\n2 pommes\r\n70 g d\'amandes effilées\r\n1 sachet de sucre vanille\r\n2 yaourts brassés\r\n2 CC d\' édulcorant liquide', 12, 50, 'Dans un saladier , battre les œufs avec les yaourts brassés, l’édulcorant\r\nliquide et le sucre vanillé .\r\nVerser le beurre fondu et mélanger .\r\nAjouter progressivement la farine tamisée et la levure .\r\nÉplucher les pommes et les couper en fines lamelles .\r\nLes ajouter dans la pâte .\r\nAjouter 50 g d\'amandes effilées et mélanger délicatement le tout .\r\nVerser la préparation dans un moule à cake .\r\nParsemer le restant d\'amandes effilées .\r\nPlacer le moule à cake dans la cocotte de base .\r\nVerser 120 ml d\'eau dans la cocotte .\r\nFermer la cocotte et mettre en cuisson .', 'Dessert', 'Inversion à 25 min\r\nHAUT ; Maxi 10 min puis Mini\r\nBAS ; Maxi 10 min puis Mini', '2019-09-03 12:04:17'),
(32, 'Croquettes de thon', '9f149e7aa6e9fd4ca510296c8dba3614.jpg', '- 150 grammes de farine \r\n- 1/2 sachet de levure\r\n- 2 œufs \r\n- une pincée de sel\r\n- 1 gousse d\'ail \r\n- 10 grammes de coriandre fraîche \r\n- 1/2 zeste de citron vert non traité + 1 cuillère à soupe de jus \r\n- 1 pincée de piment \r\n- 1 petite échalote \r\n- 2 petits oignons nouveaux\r\n- 250 grammes de thon émietté', 5, 15, '1. Dans un saladier, mélangez la farine avec la levure.\r\n2. Battez les œufs en omelette et incorporez-les au mélange farine / levure. \r\nSalez légèrement.\r\nAjoutez une cuillère à soupe d\'eau pour détendre la pâte si elle est trop\r\ncompacte (tout dépend de la taille de vos œufs). Attention, j\'en ai ajouté un peu trop je\r\npense, la pâte était au final un peu liquide et pas très maniable à la fin mais pas de\r\nproblème au niveau du goût.\r\n3. Dans le bol de votre mixeur, déposez la gousse d\'ail épluchée, la coriandre fraiche, le\r\nzeste du citron, le jus de citron, le piment, l\'échalote épluchée et les oignons nouveaux\r\népluchés et mixez l\'ensemble.\r\n4. Incorporez le contenu du bol du mixeur à la préparation et incorporez le thon émietté bien\r\négoutté.\r\n5. Procédez enfin à la cuisson des croquettes... SANS matière grasse!', 'Entrée', 'Placez la grille en position haute dans la grande cocotte contenant 5 cuillères à soupe\r\nd\'eau.\r\nDéposez une feuille de papier cuisson sur la grille, puis déposez des petits paquets\r\nde pâte  jusqu\'à épuisement de cette dernière. \r\nFermez la cocotte et mettez en cuisson pendant 25 minutes (Haut: maxi / Bas: maxi).\r\nInversez la cocotte au bout de 10 minutes de\r\ncuisson.\r\nAttendez 5 minutes avant d\'ouvrir la cocotte.', '2019-09-06 16:33:53'),
(47, 'Tian de butternut, tomates, oignon et chèvre', '9a53fb5226fb47935d125aedf9233696.jpg', '1 butternut\r\n4 tomates\r\n1 oignon\r\n1/3 de bûche de chêvre\r\nhuile d\'olive\r\n1/2 cuillère de miel\r\nsel', 4, 60, 'Coupez le Butternut en 2 et faites les cuire à l\'Omnicuiseur ou au four.\r\nA l\'Omnicuiseur, placez les 2 demis butternut sur la grille dans la cocotte avec 2 cuillères à soupe d\'eau. Haut et Bas maxi pendant 20 min.\r\nAu four, placez les 2 demis butternut sur une plaque et enfournez à 180°C pendant 30 min.\r\n\r\nLaissez refroidir, épluchez-les et coupez-les en rondelles.\r\n\r\nLavez les tomates, épluchez l\'oignon. Coupez-les en rondelles également. \r\n\r\nCoupez le chèvre en tranches aussi.\r\n\r\nDans un plat, intercalez les morceaux de butternut, de tomates, d\'oignon et de chèvre.\r\n\r\nRépartissez le miel en filet par dessus. Et arrosez le tout d\'un filet d\'huile.\r\n\r\nSalez à votre convenance.', 'Plat', 'Cuisson au four traditionnel:\r\nPréchauffez votre four à 180°C.\r\n\r\nEnfournez le plat 35-40 min.\r\n\r\nCuisson à l\'Omnicuiseur:\r\nPlacez 5 càs d\'eau au fond de la cocotte. Déposez le moule au fond de la cocotte. \r\n\r\nFermez la cocotte et mettez en cuisson selon les réglages suivant:\r\n40 min - Inversez à 20 min\r\nHaut: maxi 20 min puis mini\r\nBas: maxi 20 min puis min', '2019-09-05 10:19:11'),
(73, 'Foie gras au chocolat', 'afa4b2a1bee3cafe17033a9f7609c4f4.jpg', '1 lobe de foie gras (400 à 450 grammes)\r\n30 gr de cacao type Van Houten\r\nSel\r\nPiment d\'Espelette ou Poivre', 8, 40, 'Poser votre foie gras sur une planche que vous aurez préalablement enroulé de film étirable.\r\nSéparer les lobes du foie gras et le déveiner si ce n\'est pas déjà fait.\r\nSaler et poivrer toutes les morceaux de foie gras.\r\nVerser le cacao dans une assiette et rouler les morceaux de foie gras dedans.\r\nDisposer les morceaux de foie gras dans une terrine.\r\nBien tasser avec le dos d\'une cuillère.\r\nCuisson basse température du foie gras\r\nRefermer la verrine puis la mettre dans la cocotte de base.\r\nVerser 1 litre d\'eau froide dans la cocotte.\r\nRefermer la cocotte.', 'Entrée', 'Mettre en cuisson : 40 minutes\r\nHaut : 0\r\nBas : Maxi 15 minutes puis mini\r\nInversion à 20 minutes\r\nLe laisser refroidir hors de la cocotte avant de le mettre au réfrigérateur.\r\nLaisser le foie gras reposer au minimum 48 heures afin que les arômes se développent.\r\nSortir 30 minutes du réfrigérateur avant de servir.', '2019-10-12 22:06:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recette`
--
ALTER TABLE `recette`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
