-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 05 nov. 2022 à 06:52
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rafitu`
--

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `ascii_name` varchar(200) DEFAULT NULL,
  `alternatenames` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `feature_class` varchar(1) DEFAULT NULL,
  `feature_code` varchar(10) DEFAULT NULL,
  `country_code` varchar(2) DEFAULT NULL,
  `cc2` varchar(200) DEFAULT NULL,
  `admin1_code` varchar(20) DEFAULT NULL,
  `admin2_code` varchar(80) DEFAULT NULL,
  `admin3_code` varchar(20) DEFAULT NULL,
  `admin4_code` varchar(20) DEFAULT NULL,
  `population` bigint(20) UNSIGNED DEFAULT NULL,
  `elevation` int(11) DEFAULT NULL,
  `dem` varchar(100) DEFAULT NULL,
  `timezone` varchar(40) DEFAULT NULL,
  `modification_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_City_Name` (`name`),
  KEY `IDX_City_Ascii_Name` (`ascii_name`),
  KEY `IDX_City_Country_Code` (`country_code`),
  KEY `IDX_City_Country_Code_2` (`cc2`),
  KEY `IDX_City_TimeZone` (`timezone`)
) ENGINE=InnoDB AUTO_INCREMENT=1249401 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` int(3) NOT NULL,
  `alpha2` varchar(2) NOT NULL,
  `alpha3` varchar(3) NOT NULL,
  `name_en` varchar(150) NOT NULL,
  `name_fr` varchar(150) NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_Country_Code` (`code`),
  UNIQUE KEY `U_Country_Name` (`name_en`),
  UNIQUE KEY `U_Country_Alpha2` (`alpha2`),
  UNIQUE KEY `U_Country_Alpha3` (`alpha3`),
  KEY `IDX_Country_Name_FR` (`name_fr`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`id`, `code`, `alpha2`, `alpha3`, `name_en`, `name_fr`, `is_active`) VALUES
(1, 4, 'AF', 'AFG', 'Afghanistan', 'Afghanistan', 1),
(2, 8, 'AL', 'ALB', 'Albania', 'Albanie', 1),
(3, 10, 'AQ', 'ATA', 'Antarctica', 'Antarctique', 1),
(4, 12, 'DZ', 'DZA', 'Algeria', 'Algérie', 1),
(5, 16, 'AS', 'ASM', 'American Samoa', 'Samoa Américaines', 1),
(6, 20, 'AD', 'AND', 'Andorra', 'Andorre', 1),
(7, 24, 'AO', 'AGO', 'Angola', 'Angola', 1),
(8, 28, 'AG', 'ATG', 'Antigua and Barbuda', 'Antigua-et-Barbuda', 1),
(9, 31, 'AZ', 'AZE', 'Azerbaijan', 'Azerbaïdjan', 1),
(10, 32, 'AR', 'ARG', 'Argentina', 'Argentine', 1),
(11, 36, 'AU', 'AUS', 'Australia', 'Australie', 1),
(12, 40, 'AT', 'AUT', 'Austria', 'Autriche', 1),
(13, 44, 'BS', 'BHS', 'Bahamas', 'Bahamas', 1),
(14, 48, 'BH', 'BHR', 'Bahrain', 'Bahreïn', 1),
(15, 50, 'BD', 'BGD', 'Bangladesh', 'Bangladesh', 1),
(16, 51, 'AM', 'ARM', 'Armenia', 'Arménie', 1),
(17, 52, 'BB', 'BRB', 'Barbados', 'Barbade', 1),
(18, 56, 'BE', 'BEL', 'Belgium', 'Belgique', 1),
(19, 60, 'BM', 'BMU', 'Bermuda', 'Bermudes', 1),
(20, 64, 'BT', 'BTN', 'Bhutan', 'Bhoutan', 1),
(21, 68, 'BO', 'BOL', 'Bolivia', 'Bolivie', 1),
(22, 70, 'BA', 'BIH', 'Bosnia and Herzegovina', 'Bosnie-Herzégovine', 1),
(23, 72, 'BW', 'BWA', 'Botswana', 'Botswana', 1),
(24, 74, 'BV', 'BVT', 'Bouvet Island', 'Île Bouvet', 1),
(25, 76, 'BR', 'BRA', 'Brazil', 'Brésil', 1),
(26, 84, 'BZ', 'BLZ', 'Belize', 'Belize', 1),
(27, 86, 'IO', 'IOT', 'British Indian Ocean Territory', 'Territoire Britannique de l\'Océan Indien', 1),
(28, 90, 'SB', 'SLB', 'Solomon Islands', 'Îles Salomon', 1),
(29, 92, 'VG', 'VGB', 'British Virgin Islands', 'Îles Vierges Britanniques', 1),
(30, 96, 'BN', 'BRN', 'Brunei Darussalam', 'Brunéi Darussalam', 1),
(31, 100, 'BG', 'BGR', 'Bulgaria', 'Bulgarie', 1),
(32, 104, 'MM', 'MMR', 'Myanmar', 'Myanmar', 1),
(33, 108, 'BI', 'BDI', 'Burundi', 'Burundi', 1),
(34, 112, 'BY', 'BLR', 'Belarus', 'Bélarus', 1),
(35, 116, 'KH', 'KHM', 'Cambodia', 'Cambodge', 1),
(36, 120, 'CM', 'CMR', 'Cameroon', 'Cameroun', 1),
(37, 124, 'CA', 'CAN', 'Canada', 'Canada', 1),
(38, 132, 'CV', 'CPV', 'Cape Verde', 'Cap-vert', 1),
(39, 136, 'KY', 'CYM', 'Cayman Islands', 'Îles Caïmanes', 1),
(40, 140, 'CF', 'CAF', 'Central African', 'République Centrafricaine', 1),
(41, 144, 'LK', 'LKA', 'Sri Lanka', 'Sri Lanka', 1),
(42, 148, 'TD', 'TCD', 'Chad', 'Tchad', 1),
(43, 152, 'CL', 'CHL', 'Chile', 'Chili', 1),
(44, 156, 'CN', 'CHN', 'China', 'Chine', 1),
(45, 158, 'TW', 'TWN', 'Taiwan', 'Taïwan', 1),
(46, 162, 'CX', 'CXR', 'Christmas Island', 'Île Christmas', 1),
(47, 166, 'CC', 'CCK', 'Cocos (Keeling) Islands', 'Îles Cocos (Keeling)', 1),
(48, 170, 'CO', 'COL', 'Colombia', 'Colombie', 1),
(49, 174, 'KM', 'COM', 'Comoros', 'Comores', 1),
(50, 175, 'YT', 'MYT', 'Mayotte', 'Mayotte', 1),
(51, 178, 'CG', 'COG', 'Republic of the Congo', 'République du Congo', 1),
(52, 180, 'CD', 'COD', 'The Democratic Republic Of The Congo', 'République Démocratique du Congo', 1),
(53, 184, 'CK', 'COK', 'Cook Islands', 'Îles Cook', 1),
(54, 188, 'CR', 'CRI', 'Costa Rica', 'Costa Rica', 1),
(55, 191, 'HR', 'HRV', 'Croatia', 'Croatie', 1),
(56, 192, 'CU', 'CUB', 'Cuba', 'Cuba', 1),
(57, 196, 'CY', 'CYP', 'Cyprus', 'Chypre', 1),
(58, 203, 'CZ', 'CZE', 'Czech Republic', 'République Tchèque', 1),
(59, 204, 'BJ', 'BEN', 'Benin', 'Bénin', 1),
(60, 208, 'DK', 'DNK', 'Denmark', 'Danemark', 1),
(61, 212, 'DM', 'DMA', 'Dominica', 'Dominique', 1),
(62, 214, 'DO', 'DOM', 'Dominican Republic', 'République Dominicaine', 1),
(63, 218, 'EC', 'ECU', 'Ecuador', 'Équateur', 1),
(64, 222, 'SV', 'SLV', 'El Salvador', 'El Salvador', 1),
(65, 226, 'GQ', 'GNQ', 'Equatorial Guinea', 'Guinée Équatoriale', 1),
(66, 231, 'ET', 'ETH', 'Ethiopia', 'Éthiopie', 1),
(67, 232, 'ER', 'ERI', 'Eritrea', 'Érythrée', 1),
(68, 233, 'EE', 'EST', 'Estonia', 'Estonie', 1),
(69, 234, 'FO', 'FRO', 'Faroe Islands', 'Îles Féroé', 1),
(70, 238, 'FK', 'FLK', 'Falkland Islands', 'Îles (malvinas) Falkland', 1),
(71, 239, 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', 'Géorgie du Sud et les Îles Sandwich du Sud', 1),
(72, 242, 'FJ', 'FJI', 'Fiji', 'Fidji', 1),
(73, 246, 'FI', 'FIN', 'Finland', 'Finlande', 1),
(74, 248, 'AX', 'ALA', 'Åland Islands', 'Îles Åland', 1),
(75, 250, 'FR', 'FRA', 'France', 'France', 1),
(76, 254, 'GF', 'GUF', 'French Guiana', 'Guyane Française', 1),
(77, 258, 'PF', 'PYF', 'French Polynesia', 'Polynésie Française', 1),
(78, 260, 'TF', 'ATF', 'French Southern Territories', 'Terres Australes Françaises', 1),
(79, 262, 'DJ', 'DJI', 'Djibouti', 'Djibouti', 1),
(80, 266, 'GA', 'GAB', 'Gabon', 'Gabon', 1),
(81, 268, 'GE', 'GEO', 'Georgia', 'Géorgie', 1),
(82, 270, 'GM', 'GMB', 'Gambia', 'Gambie', 1),
(83, 275, 'PS', 'PSE', 'Occupied Palestinian Territory', 'Territoire Palestinien Occupé', 1),
(84, 276, 'DE', 'DEU', 'Germany', 'Allemagne', 1),
(85, 288, 'GH', 'GHA', 'Ghana', 'Ghana', 1),
(86, 292, 'GI', 'GIB', 'Gibraltar', 'Gibraltar', 1),
(87, 296, 'KI', 'KIR', 'Kiribati', 'Kiribati', 1),
(88, 300, 'GR', 'GRC', 'Greece', 'Grèce', 1),
(89, 304, 'GL', 'GRL', 'Greenland', 'Groenland', 1),
(90, 308, 'GD', 'GRD', 'Grenada', 'Grenade', 1),
(91, 312, 'GP', 'GLP', 'Guadeloupe', 'Guadeloupe', 1),
(92, 316, 'GU', 'GUM', 'Guam', 'Guam', 1),
(93, 320, 'GT', 'GTM', 'Guatemala', 'Guatemala', 1),
(94, 324, 'GN', 'GIN', 'Guinea', 'Guinée', 1),
(95, 328, 'GY', 'GUY', 'Guyana', 'Guyana', 1),
(96, 332, 'HT', 'HTI', 'Haiti', 'Haïti', 1),
(97, 334, 'HM', 'HMD', 'Heard Island and McDonald Islands', 'Îles Heard et Mcdonald', 1),
(98, 336, 'VA', 'VAT', 'Vatican City State', 'Saint-Siège (état de la Cité du Vatican)', 1),
(99, 340, 'HN', 'HND', 'Honduras', 'Honduras', 1),
(100, 344, 'HK', 'HKG', 'Hong Kong', 'Hong-Kong', 1),
(101, 348, 'HU', 'HUN', 'Hungary', 'Hongrie', 1),
(102, 352, 'IS', 'ISL', 'Iceland', 'Islande', 1),
(103, 356, 'IN', 'IND', 'India', 'Inde', 1),
(104, 360, 'ID', 'IDN', 'Indonesia', 'Indonésie', 1),
(105, 364, 'IR', 'IRN', 'Islamic Republic of Iran', 'République Islamique d\'Iran', 1),
(106, 368, 'IQ', 'IRQ', 'Iraq', 'Iraq', 1),
(107, 372, 'IE', 'IRL', 'Ireland', 'Irlande', 1),
(108, 376, 'IL', 'ISR', 'Israel', 'Israël', 1),
(109, 380, 'IT', 'ITA', 'Italy', 'Italie', 1),
(110, 384, 'CI', 'CIV', 'Côte d\'Ivoire', 'Côte d\'Ivoire', 1),
(111, 388, 'JM', 'JAM', 'Jamaica', 'Jamaïque', 1),
(112, 392, 'JP', 'JPN', 'Japan', 'Japon', 1),
(113, 398, 'KZ', 'KAZ', 'Kazakhstan', 'Kazakhstan', 1),
(114, 400, 'JO', 'JOR', 'Jordan', 'Jordanie', 1),
(115, 404, 'KE', 'KEN', 'Kenya', 'Kenya', 1),
(116, 408, 'KP', 'PRK', 'Democratic People\'s Republic of Korea', 'République Populaire Démocratique de Corée', 1),
(117, 410, 'KR', 'KOR', 'Republic of Korea', 'République de Corée', 1),
(118, 414, 'KW', 'KWT', 'Kuwait', 'Koweït', 1),
(119, 417, 'KG', 'KGZ', 'Kyrgyzstan', 'Kirghizistan', 1),
(120, 418, 'LA', 'LAO', 'Lao People\'s Democratic Republic', 'République Démocratique Populaire Lao', 1),
(121, 422, 'LB', 'LBN', 'Lebanon', 'Liban', 1),
(122, 426, 'LS', 'LSO', 'Lesotho', 'Lesotho', 1),
(123, 428, 'LV', 'LVA', 'Latvia', 'Lettonie', 1),
(124, 430, 'LR', 'LBR', 'Liberia', 'Libéria', 1),
(125, 434, 'LY', 'LBY', 'Libyan Arab Jamahiriya', 'Jamahiriya Arabe Libyenne', 1),
(126, 438, 'LI', 'LIE', 'Liechtenstein', 'Liechtenstein', 1),
(127, 440, 'LT', 'LTU', 'Lithuania', 'Lituanie', 1),
(128, 442, 'LU', 'LUX', 'Luxembourg', 'Luxembourg', 1),
(129, 446, 'MO', 'MAC', 'Macao', 'Macao', 1),
(130, 450, 'MG', 'MDG', 'Madagascar', 'Madagascar', 1),
(131, 454, 'MW', 'MWI', 'Malawi', 'Malawi', 1),
(132, 458, 'MY', 'MYS', 'Malaysia', 'Malaisie', 1),
(133, 462, 'MV', 'MDV', 'Maldives', 'Maldives', 1),
(134, 466, 'ML', 'MLI', 'Mali', 'Mali', 1),
(135, 470, 'MT', 'MLT', 'Malta', 'Malte', 1),
(136, 474, 'MQ', 'MTQ', 'Martinique', 'Martinique', 1),
(137, 478, 'MR', 'MRT', 'Mauritania', 'Mauritanie', 1),
(138, 480, 'MU', 'MUS', 'Mauritius', 'Maurice', 1),
(139, 484, 'MX', 'MEX', 'Mexico', 'Mexique', 1),
(140, 492, 'MC', 'MCO', 'Monaco', 'Monaco', 1),
(141, 496, 'MN', 'MNG', 'Mongolia', 'Mongolie', 1),
(142, 498, 'MD', 'MDA', 'Republic of Moldova', 'République de Moldova', 1),
(143, 500, 'MS', 'MSR', 'Montserrat', 'Montserrat', 1),
(144, 504, 'MA', 'MAR', 'Morocco', 'Maroc', 1),
(145, 508, 'MZ', 'MOZ', 'Mozambique', 'Mozambique', 1),
(146, 512, 'OM', 'OMN', 'Oman', 'Oman', 1),
(147, 516, 'NA', 'NAM', 'Namibia', 'Namibie', 1),
(148, 520, 'NR', 'NRU', 'Nauru', 'Nauru', 1),
(149, 524, 'NP', 'NPL', 'Nepal', 'Népal', 1),
(150, 528, 'NL', 'NLD', 'Netherlands', 'Pays-Bas', 1),
(151, 530, 'AN', 'ANT', 'Netherlands Antilles', 'Antilles Néerlandaises', 1),
(152, 533, 'AW', 'ABW', 'Aruba', 'Aruba', 1),
(153, 540, 'NC', 'NCL', 'New Caledonia', 'Nouvelle-Calédonie', 1),
(154, 548, 'VU', 'VUT', 'Vanuatu', 'Vanuatu', 1),
(155, 554, 'NZ', 'NZL', 'New Zealand', 'Nouvelle-Zélande', 1),
(156, 558, 'NI', 'NIC', 'Nicaragua', 'Nicaragua', 1),
(157, 562, 'NE', 'NER', 'Niger', 'Niger', 1),
(158, 566, 'NG', 'NGA', 'Nigeria', 'Nigéria', 1),
(159, 570, 'NU', 'NIU', 'Niue', 'Niué', 1),
(160, 574, 'NF', 'NFK', 'Norfolk Island', 'Île Norfolk', 1),
(161, 578, 'NO', 'NOR', 'Norway', 'Norvège', 1),
(162, 580, 'MP', 'MNP', 'Northern Mariana Islands', 'Îles Mariannes du Nord', 1),
(163, 581, 'UM', 'UMI', 'United States Minor Outlying Islands', 'Îles Mineures Éloignées des États-Unis', 1),
(164, 583, 'FM', 'FSM', 'Federated States of Micronesia', 'États Fédérés de Micronésie', 1),
(165, 584, 'MH', 'MHL', 'Marshall Islands', 'Îles Marshall', 1),
(166, 585, 'PW', 'PLW', 'Palau', 'Palaos', 1),
(167, 586, 'PK', 'PAK', 'Pakistan', 'Pakistan', 1),
(168, 591, 'PA', 'PAN', 'Panama', 'Panama', 1),
(169, 598, 'PG', 'PNG', 'Papua New Guinea', 'Papouasie-Nouvelle-Guinée', 1),
(170, 600, 'PY', 'PRY', 'Paraguay', 'Paraguay', 1),
(171, 604, 'PE', 'PER', 'Peru', 'Pérou', 1),
(172, 608, 'PH', 'PHL', 'Philippines', 'Philippines', 1),
(173, 612, 'PN', 'PCN', 'Pitcairn', 'Pitcairn', 1),
(174, 616, 'PL', 'POL', 'Poland', 'Pologne', 1),
(175, 620, 'PT', 'PRT', 'Portugal', 'Portugal', 1),
(176, 624, 'GW', 'GNB', 'Guinea-Bissau', 'Guinée-Bissau', 1),
(177, 626, 'TL', 'TLS', 'Timor-Leste', 'Timor-Leste', 1),
(178, 630, 'PR', 'PRI', 'Puerto Rico', 'Porto Rico', 1),
(179, 634, 'QA', 'QAT', 'Qatar', 'Qatar', 1),
(180, 638, 'RE', 'REU', 'Réunion', 'Réunion', 1),
(181, 642, 'RO', 'ROU', 'Romania', 'Roumanie', 1),
(182, 643, 'RU', 'RUS', 'Russian Federation', 'Fédération de Russie', 1),
(183, 646, 'RW', 'RWA', 'Rwanda', 'Rwanda', 1),
(184, 654, 'SH', 'SHN', 'Saint Helena', 'Sainte-Hélène', 1),
(185, 659, 'KN', 'KNA', 'Saint Kitts and Nevis', 'Saint-Kitts-et-Nevis', 1),
(186, 660, 'AI', 'AIA', 'Anguilla', 'Anguilla', 1),
(187, 662, 'LC', 'LCA', 'Saint Lucia', 'Sainte-Lucie', 1),
(188, 666, 'PM', 'SPM', 'Saint-Pierre and Miquelon', 'Saint-Pierre-et-Miquelon', 1),
(189, 670, 'VC', 'VCT', 'Saint Vincent and the Grenadines', 'Saint-Vincent-et-les Grenadines', 1),
(190, 674, 'SM', 'SMR', 'San Marino', 'Saint-Marin', 1),
(191, 678, 'ST', 'STP', 'Sao Tome and Principe', 'Sao Tomé-et-Principe', 1),
(192, 682, 'SA', 'SAU', 'Saudi Arabia', 'Arabie Saoudite', 1),
(193, 686, 'SN', 'SEN', 'Senegal', 'Sénégal', 1),
(194, 690, 'SC', 'SYC', 'Seychelles', 'Seychelles', 1),
(195, 694, 'SL', 'SLE', 'Sierra Leone', 'Sierra Leone', 1),
(196, 702, 'SG', 'SGP', 'Singapore', 'Singapour', 1),
(197, 703, 'SK', 'SVK', 'Slovakia', 'Slovaquie', 1),
(198, 704, 'VN', 'VNM', 'Vietnam', 'Viet Nam', 1),
(199, 705, 'SI', 'SVN', 'Slovenia', 'Slovénie', 1),
(200, 706, 'SO', 'SOM', 'Somalia', 'Somalie', 1),
(201, 710, 'ZA', 'ZAF', 'South Africa', 'Afrique du Sud', 1),
(202, 716, 'ZW', 'ZWE', 'Zimbabwe', 'Zimbabwe', 1),
(203, 724, 'ES', 'ESP', 'Spain', 'Espagne', 1),
(204, 732, 'EH', 'ESH', 'Western Sahara', 'Sahara Occidental', 1),
(205, 736, 'SD', 'SDN', 'Sudan', 'Soudan', 1),
(206, 740, 'SR', 'SUR', 'Suriname', 'Suriname', 1),
(207, 744, 'SJ', 'SJM', 'Svalbard and Jan Mayen', 'Svalbard etÎle Jan Mayen', 1),
(208, 748, 'SZ', 'SWZ', 'Swaziland', 'Swaziland', 1),
(209, 752, 'SE', 'SWE', 'Sweden', 'Suède', 1),
(210, 756, 'CH', 'CHE', 'Switzerland', 'Suisse', 1),
(211, 760, 'SY', 'SYR', 'Syrian Arab Republic', 'République Arabe Syrienne', 1),
(212, 762, 'TJ', 'TJK', 'Tajikistan', 'Tadjikistan', 1),
(213, 764, 'TH', 'THA', 'Thailand', 'Thaïlande', 1),
(214, 768, 'TG', 'TGO', 'Togo', 'Togo', 1),
(215, 772, 'TK', 'TKL', 'Tokelau', 'Tokelau', 1),
(216, 776, 'TO', 'TON', 'Tonga', 'Tonga', 1),
(217, 780, 'TT', 'TTO', 'Trinidad and Tobago', 'Trinité-et-Tobago', 1),
(218, 784, 'AE', 'ARE', 'United Arab Emirates', 'Émirats Arabes Unis', 1),
(219, 788, 'TN', 'TUN', 'Tunisia', 'Tunisie', 1),
(220, 792, 'TR', 'TUR', 'Turkey', 'Turquie', 1),
(221, 795, 'TM', 'TKM', 'Turkmenistan', 'Turkménistan', 1),
(222, 796, 'TC', 'TCA', 'Turks and Caicos Islands', 'Îles Turks et Caïques', 1),
(223, 798, 'TV', 'TUV', 'Tuvalu', 'Tuvalu', 1),
(224, 800, 'UG', 'UGA', 'Uganda', 'Ouganda', 1),
(225, 804, 'UA', 'UKR', 'Ukraine', 'Ukraine', 1),
(226, 807, 'MK', 'MKD', 'The Former Yugoslav Republic of Macedonia', 'L\'ex-République Yougoslave de Macédoine', 1),
(227, 818, 'EG', 'EGY', 'Egypt', 'Égypte', 1),
(228, 826, 'GB', 'GBR', 'United Kingdom', 'Royaume-Uni', 1),
(229, 833, 'IM', 'IMN', 'Isle of Man', 'Île de Man', 1),
(230, 834, 'TZ', 'TZA', 'United Republic Of Tanzania', 'République-Unie de Tanzanie', 1),
(231, 840, 'US', 'USA', 'United States', 'États-Unis', 1),
(232, 850, 'VI', 'VIR', 'U.S. Virgin Islands', 'Îles Vierges des États-Unis', 1),
(233, 854, 'BF', 'BFA', 'Burkina Faso', 'Burkina Faso', 1),
(234, 858, 'UY', 'URY', 'Uruguay', 'Uruguay', 1),
(235, 860, 'UZ', 'UZB', 'Uzbekistan', 'Ouzbékistan', 1),
(236, 862, 'VE', 'VEN', 'Venezuela', 'Venezuela', 1),
(237, 876, 'WF', 'WLF', 'Wallis and Futuna', 'Wallis et Futuna', 1),
(238, 882, 'WS', 'WSM', 'Samoa', 'Samoa', 1),
(239, 887, 'YE', 'YEM', 'Yemen', 'Yémen', 1),
(240, 891, 'CS', 'SCG', 'Serbia and Montenegro', 'Serbie-et-Monténégro', 1),
(241, 894, 'ZM', 'ZMB', 'Zambia', 'Zambie', 1);

-- --------------------------------------------------------

--
-- Structure de la table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(150) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_Equipment_Label` (`label`),
  KEY `IDX_Equipment_Description` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipment`
--

INSERT INTO `equipment` (`id`, `label`, `description`, `is_active`) VALUES
(1, 'Equipement #1', 'Description de l\'équipement #1', 1),
(2, 'Equipement #2', 'Description de l\'équipement #2', 1),
(3, 'Equipement #3', 'Description de l\'équipement #3', 1),
(4, 'Equipement #4', 'Description de l\'équipement #4', 1),
(5, 'Equipement #5', 'Description de l\'équipement #5', 1),
(6, 'Equipement #6', 'Description de l\'équipement #6', 1),
(7, 'Equipement #7', 'Description de l\'équipement #7', 1),
(8, 'Equipement #8', 'Description de l\'équipement #8', 1),
(9, 'Equipement #9', 'Description de l\'équipement #9', 1),
(10, 'Equipement #10', 'Description de l\'équipement #10', 1);

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `rank` tinyint(4) UNSIGNED NOT NULL DEFAULT '255',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_FAQ_Rank` (`rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
CREATE TABLE IF NOT EXISTS `favorite` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ride_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_Favorite_Ride_ID` (`ride_id`),
  KEY `IDX_Favorite_User_ID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `identification_type`
--

DROP TABLE IF EXISTS `identification_type`;
CREATE TABLE IF NOT EXISTS `identification_type` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_Identification_Type_Label` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `identification_type`
--

INSERT INTO `identification_type` (`id`, `label`, `is_active`) VALUES
(1, 'Carte d\'identité', 1),
(2, 'Passeport', 1);

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alpha2` varchar(2) NOT NULL,
  `alpha3` varchar(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_Language_Alpha2` (`alpha2`),
  UNIQUE KEY `U_Language_Alpha3` (`alpha3`),
  UNIQUE KEY `U_Language_Name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `language`
--

INSERT INTO `language` (`id`, `alpha2`, `alpha3`, `name`, `is_active`) VALUES
(1, 'en', 'eng', 'English', 1),
(2, 'fr', 'fra', 'Français', 1);

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `log_date` datetime NOT NULL,
  `log_type` varchar(10) NOT NULL,
  `message` varchar(255) NOT NULL,
  `context` text NOT NULL,
  `calling_file` varchar(255) NOT NULL,
  `is_read` tinyint(1) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_Log_Date` (`log_date`),
  KEY `IDX_Log_Type` (`log_type`),
  KEY `IDX_Log_Message` (`message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `date_sent` datetime NOT NULL,
  `content` text NOT NULL,
  `is_seen` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_Message_Token` (`token`),
  KEY `IDX_Message_Sender_ID` (`sender_id`),
  KEY `IDX_Message_Receiver_ID` (`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `notification_type` varchar(30) NOT NULL,
  `is_read` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_notification_owner_ID` (`owner_id`),
  KEY `IDX_Notification_Type` (`notification_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `page_category_id` int(10) UNSIGNED DEFAULT NULL,
  `author_id` int(10) UNSIGNED DEFAULT NULL,
  `preview_image` varchar(255) NOT NULL,
  `page_status_id` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_Page_Slug` (`slug`),
  KEY `IDX_Page_Title` (`title`),
  KEY `IDX_Page_Description` (`description`),
  KEY `IDX_Page_Category_ID` (`page_category_id`),
  KEY `IDX_Page_Author_ID` (`author_id`),
  KEY `IDX_Page_Status_ID` (`page_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `page_category`
--

DROP TABLE IF EXISTS `page_category`;
CREATE TABLE IF NOT EXISTS `page_category` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_Page_Category_Slug` (`slug`),
  KEY `IDX_Page_Category_Parent_ID` (`parent_id`),
  KEY `IDX_Page_Category_Name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `page_status`
--

DROP TABLE IF EXISTS `page_status`;
CREATE TABLE IF NOT EXISTS `page_status` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_Page_Status_Label` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ride`
--

DROP TABLE IF EXISTS `ride`;
CREATE TABLE IF NOT EXISTS `ride` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `driver_id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `departure_label` varchar(255) NOT NULL,
  `departure_date` datetime NOT NULL,
  `departure_position_long` float NOT NULL,
  `departure_position_lat` float NOT NULL,
  `arrival_label` varchar(255) NOT NULL,
  `arrival_date` datetime NOT NULL,
  `arrival_position_long` float NOT NULL,
  `arrival_position_lat` float NOT NULL,
  `seats_available` tinyint(1) UNSIGNED NOT NULL,
  `woman_only` tinyint(1) UNSIGNED NOT NULL,
  `price` float NOT NULL,
  `ride_status_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_Ride_Owner_ID` (`owner_id`),
  KEY `IDX_Vehicle_ID` (`vehicle_id`),
  KEY `IDX_Ride_Driver_ID` (`driver_id`),
  KEY `IDX_Ride_Label` (`label`),
  KEY `IDX_Ride_Departure_Date` (`departure_date`),
  KEY `IDX_Ride_Arrival_Date` (`arrival_date`),
  KEY `IDX_Ride_Status_ID` (`ride_status_id`),
  KEY `IDX_Ride_Departure_Label` (`departure_label`),
  KEY `IDX_Ride_Arrival_Label` (`arrival_label`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ride`
--

INSERT INTO `ride` (`id`, `owner_id`, `vehicle_id`, `driver_id`, `label`, `departure_label`, `departure_date`, `departure_position_long`, `departure_position_lat`, `arrival_label`, `arrival_date`, `arrival_position_long`, `arrival_position_lat`, `seats_available`, `woman_only`, `price`, `ride_status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, 'Champ de Mars, Rue Dauphine, Port Louis, Maurice', '2022-11-07 12:00:00', 57.5098, -20.1655, 'La Croisette, Chemin Vingt Pieds, Grand Baie, Maurice', '2022-11-07 12:45:00', 57.5788, -20.022, 2, 0, 1, 1, '2022-11-05 06:44:15', '2022-11-05 06:44:15'),
(2, 1, 1, 1, NULL, 'Curepipe Police Station, Curepipe, Maurice', '2022-11-05 12:00:00', 57.5265, -20.3171, 'Port Louis Waterfront by Landscope Mauritius, Port Louis, Maurice', '2022-11-05 12:50:00', 57.5007, -20.1609, 1, 1, 1, 1, '2022-11-05 06:46:19', '2022-11-05 06:46:19');

-- --------------------------------------------------------

--
-- Structure de la table `ride_comment`
--

DROP TABLE IF EXISTS `ride_comment`;
CREATE TABLE IF NOT EXISTS `ride_comment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ride_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `is_like` tinyint(1) DEFAULT NULL,
  `is_dislike` tinyint(1) DEFAULT NULL,
  `note` smallint(1) UNSIGNED NOT NULL,
  `content` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_Ride_Comment_Ride_ID` (`ride_id`),
  KEY `IDX_Ride_Comment_User_ID` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ride_status`
--

DROP TABLE IF EXISTS `ride_status`;
CREATE TABLE IF NOT EXISTS `ride_status` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_Ride_Status` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ride_status`
--

INSERT INTO `ride_status` (`id`, `label`, `is_active`) VALUES
(1, 'Planifié', 1),
(2, 'En cours de trajet', 1),
(3, 'Arrivé', 1),
(4, 'Annulé', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ride_stop`
--

DROP TABLE IF EXISTS `ride_stop`;
CREATE TABLE IF NOT EXISTS `ride_stop` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ride_id` int(10) UNSIGNED NOT NULL,
  `position_long` float DEFAULT NULL,
  `position_lat` float DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `town_id` int(10) UNSIGNED DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_Ride_Stop_Ride_ID` (`ride_id`),
  KEY `IDX_Ride_Stop_Label` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sexe`
--

DROP TABLE IF EXISTS `sexe`;
CREATE TABLE IF NOT EXISTS `sexe` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_Sexe_Name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sexe`
--

INSERT INTO `sexe` (`id`, `name`, `is_active`) VALUES
(1, 'Homme', 1),
(2, 'Femme', 1),
(3, 'Non spécifié', 1);

-- --------------------------------------------------------

--
-- Structure de la table `town`
--

DROP TABLE IF EXISTS `town`;
CREATE TABLE IF NOT EXISTS `town` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `code_INSEE` varchar(50) DEFAULT NULL,
  `commune` varchar(150) DEFAULT NULL,
  `region` varchar(150) DEFAULT NULL,
  `department` varchar(150) DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_Town_Country` (`country_id`),
  KEY `IDX_Town_Label` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `user_type_id` smallint(5) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address_line1` varchar(512) DEFAULT NULL,
  `address_line2` varchar(512) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `town_id` int(10) UNSIGNED DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `language_id` int(10) UNSIGNED DEFAULT NULL,
  `sexe_id` smallint(5) UNSIGNED DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `biography` tinytext,
  `avatar` varchar(255) DEFAULT NULL,
  `identification_number` varchar(50) DEFAULT NULL,
  `identification_type_id` smallint(5) UNSIGNED DEFAULT NULL,
  `identification_release_place` varchar(150) DEFAULT NULL,
  `identification_date` datetime DEFAULT NULL,
  `user_status_id` smallint(5) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_User_Login` (`login`),
  KEY `IDX_User_Password` (`password`),
  KEY `U_User_Email` (`email`),
  KEY `IDX_User_Type_ID` (`user_type_id`),
  KEY `IDX_User_Firstname` (`firstname`),
  KEY `IDX_User_Lastname` (`lastname`),
  KEY `IDX_User_Town_ID` (`town_id`),
  KEY `IDX_User_Country_ID` (`country_id`),
  KEY `IDX_User_Language_ID` (`language_id`),
  KEY `IDX_User_Sexe_ID` (`sexe_id`),
  KEY `IDX_User_Identification_Type_ID` (`identification_type_id`),
  KEY `IDX_User_Status_ID` (`user_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `user_type_id`, `firstname`, `lastname`, `address_line1`, `address_line2`, `zip_code`, `town_id`, `country_id`, `language_id`, `sexe_id`, `birthdate`, `tel`, `mobile`, `biography`, `avatar`, `identification_number`, `identification_type_id`, `identification_release_place`, `identification_date`, `user_status_id`, `created_at`, `updated_at`) VALUES
(1, 'donatkamary@gmail.com', '$2y$10$ChYDJAYMhBZ9KQ3qN/yfpuDCirCzSA5vUtscxIopLn37DLydThlQC', 'donatkamary@gmail.com', 4, 'Donat', 'Kamary', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'https://lh3.googleusercontent.com/a/ALm5wu16lScEie_JWnMuH4DSpY-05ZsOqo7EUXUeoHHAoA=s96-c', NULL, NULL, NULL, NULL, 1, '2022-11-04 15:54:52', '2022-11-04 15:54:52');

-- --------------------------------------------------------

--
-- Structure de la table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_User_Status_Label` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_status`
--

INSERT INTO `user_status` (`id`, `label`, `is_active`) VALUES
(1, 'Actif', 1),
(2, 'Inactif', 1),
(3, 'En cours de validation', 1),
(4, 'Bloqué', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(150) NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `label` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_type`
--

INSERT INTO `user_type` (`id`, `label`, `is_active`) VALUES
(1, 'Administrateur', 1),
(2, 'Conducteur', 1),
(3, 'Propriétaire', 1),
(4, 'Passager', 1),
(5, 'Anonyme', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `registration` varchar(50) NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `vehicle_brand_id` int(10) UNSIGNED NOT NULL,
  `vehicle_model_id` int(10) UNSIGNED NOT NULL,
  `allow_animal` tinyint(1) UNSIGNED DEFAULT NULL,
  `allow_smoker` tinyint(1) UNSIGNED DEFAULT NULL,
  `seats_available` tinyint(2) UNSIGNED DEFAULT '3',
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_Vehicle_Registration` (`registration`),
  KEY `IDX_Vehicle_Brand_ID` (`vehicle_brand_id`),
  KEY `IDX_Vehicle_Model_ID` (`vehicle_model_id`),
  KEY `IDX_Vehicle_Country_ID` (`country_id`),
  KEY `IDX_Vehicle_Owner` (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vehicle`
--

INSERT INTO `vehicle` (`id`, `owner_id`, `registration`, `country_id`, `vehicle_brand_id`, `vehicle_model_id`, `allow_animal`, `allow_smoker`, `seats_available`, `is_active`) VALUES
(1, 1, '', NULL, 67, 1149, 0, 0, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicle_brand`
--

DROP TABLE IF EXISTS `vehicle_brand`;
CREATE TABLE IF NOT EXISTS `vehicle_brand` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_Vehicule_Brand_Code` (`code`),
  KEY `IDX_Vehicule_Brand_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vehicle_brand`
--

INSERT INTO `vehicle_brand` (`id`, `code`, `name`, `logo`, `is_active`) VALUES
(1, 'ACURA', 'Acura', NULL, 1),
(2, 'ALFA', 'Alfa Romeo', NULL, 1),
(3, 'AMC', 'AMC', NULL, 1),
(4, 'ASTON', 'Aston Martin', NULL, 1),
(5, 'AUDI', 'Audi', NULL, 1),
(6, 'AVANTI', 'Avanti', NULL, 1),
(7, 'BENTL', 'Bentley', NULL, 1),
(8, 'BMW', 'BMW', NULL, 1),
(9, 'BUICK', 'Buick', NULL, 1),
(10, 'CAD', 'Cadillac', NULL, 1),
(11, 'CHEV', 'Chevrolet', NULL, 1),
(12, 'CHRY', 'Chrysler', NULL, 1),
(13, 'DAEW', 'Daewoo', NULL, 1),
(14, 'DAIHAT', 'Daihatsu', NULL, 1),
(15, 'DATSUN', 'Datsun', NULL, 1),
(16, 'DELOREAN', 'DeLorean', NULL, 1),
(17, 'DODGE', 'Dodge', NULL, 1),
(18, 'EAGLE', 'Eagle', NULL, 1),
(19, 'FER', 'Ferrari', NULL, 1),
(20, 'FIAT', 'FIAT', NULL, 1),
(21, 'FISK', 'Fisker', NULL, 1),
(22, 'FORD', 'Ford', NULL, 1),
(23, 'FREIGHT', 'Freightliner', NULL, 1),
(24, 'GEO', 'Geo', NULL, 1),
(25, 'GMC', 'GMC', NULL, 1),
(26, 'HONDA', 'Honda', NULL, 1),
(27, 'AMGEN', 'HUMMER', NULL, 1),
(28, 'HYUND', 'Hyundai', NULL, 1),
(29, 'INFIN', 'Infiniti', NULL, 1),
(30, 'ISU', 'Isuzu', NULL, 1),
(31, 'JAG', 'Jaguar', NULL, 1),
(32, 'JEEP', 'Jeep', NULL, 1),
(33, 'KIA', 'Kia', NULL, 1),
(34, 'LAM', 'Lamborghini', NULL, 1),
(35, 'LAN', 'Lancia', NULL, 1),
(36, 'ROV', 'Land Rover', NULL, 1),
(37, 'LEXUS', 'Lexus', NULL, 1),
(38, 'LINC', 'Lincoln', NULL, 1),
(39, 'LOTUS', 'Lotus', NULL, 1),
(40, 'MAS', 'Maserati', NULL, 1),
(41, 'MAYBACH', 'Maybach', NULL, 1),
(42, 'MAZDA', 'Mazda', NULL, 1),
(43, 'MCLAREN', 'McLaren', NULL, 1),
(44, 'MB', 'Mercedes-Benz', NULL, 1),
(45, 'MERC', 'Mercury', NULL, 1),
(46, 'MERKUR', 'Merkur', NULL, 1),
(47, 'MINI', 'MINI', NULL, 1),
(48, 'MIT', 'Mitsubishi', NULL, 1),
(49, 'NISSAN', 'Nissan', NULL, 1),
(50, 'OLDS', 'Oldsmobile', NULL, 1),
(51, 'PEUG', 'Peugeot', NULL, 1),
(52, 'PLYM', 'Plymouth', NULL, 1),
(53, 'PONT', 'Pontiac', NULL, 1),
(54, 'POR', 'Porsche', NULL, 1),
(55, 'RAM', 'RAM', NULL, 1),
(56, 'REN', 'Renault', NULL, 1),
(57, 'RR', 'Rolls-Royce', NULL, 1),
(58, 'SAAB', 'Saab', NULL, 1),
(59, 'SATURN', 'Saturn', NULL, 1),
(60, 'SCION', 'Scion', NULL, 1),
(61, 'SMART', 'smart', NULL, 1),
(62, 'SRT', 'SRT', NULL, 1),
(63, 'STERL', 'Sterling', NULL, 1),
(64, 'SUB', 'Subaru', NULL, 1),
(65, 'SUZUKI', 'Suzuki', NULL, 1),
(66, 'TESLA', 'Tesla', NULL, 1),
(67, 'TOYOTA', 'Toyota', NULL, 1),
(68, 'TRI', 'Triumph', NULL, 1),
(69, 'VOLKS', 'Volkswagen', NULL, 1),
(70, 'VOLVO', 'Volvo', NULL, 1),
(71, 'YUGO', 'Yugo', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicle_equipment`
--

DROP TABLE IF EXISTS `vehicle_equipment`;
CREATE TABLE IF NOT EXISTS `vehicle_equipment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `equipment_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_Vehicle_Equipement_Vehicle_ID` (`vehicle_id`),
  KEY `IDX_Vehicle_Equipment_Equipment_ID` (`equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `vehicle_gallery`
--

DROP TABLE IF EXISTS `vehicle_gallery`;
CREATE TABLE IF NOT EXISTS `vehicle_gallery` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `image_uri` varchar(255) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(512) NOT NULL,
  `alternate_text` varchar(255) NOT NULL,
  `rank` tinyint(3) UNSIGNED NOT NULL DEFAULT '255',
  PRIMARY KEY (`id`),
  KEY `IDX_Vehicle_Gallery_Vehicle_ID` (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `vehicle_model`
--

DROP TABLE IF EXISTS `vehicle_model`;
CREATE TABLE IF NOT EXISTS `vehicle_model` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vehicule_brand_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(30) NOT NULL,
  `label` varchar(150) NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_Vehicle_Model_Brand_ID` (`vehicule_brand_id`),
  KEY `IDX_Vehicule_Model_Code` (`code`),
  KEY `IDX_Vehicule_Model_Label` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=1315 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vehicle_model`
--

INSERT INTO `vehicle_model` (`id`, `vehicule_brand_id`, `code`, `label`, `is_active`) VALUES
(1, 1, 'CL_MODELS', 'CL Models (4)', 1),
(2, 1, '2.2CL', ' - 2.2CL', 1),
(3, 1, '2.3CL', ' - 2.3CL', 1),
(4, 1, '3.0CL', ' - 3.0CL', 1),
(5, 1, '3.2CL', ' - 3.2CL', 1),
(6, 1, 'ILX', 'ILX', 1),
(7, 1, 'INTEG', 'Integra', 1),
(8, 1, 'LEGEND', 'Legend', 1),
(9, 1, 'MDX', 'MDX', 1),
(10, 1, 'NSX', 'NSX', 1),
(11, 1, 'RDX', 'RDX', 1),
(12, 1, 'RL_MODELS', 'RL Models (2)', 1),
(13, 1, '3.5RL', ' - 3.5 RL', 1),
(14, 1, 'RL', ' - RL', 1),
(15, 1, 'RSX', 'RSX', 1),
(16, 1, 'SLX', 'SLX', 1),
(17, 1, 'TL_MODELS', 'TL Models (3)', 1),
(18, 1, '2.5TL', ' - 2.5TL', 1),
(19, 1, '3.2TL', ' - 3.2TL', 1),
(20, 1, 'TL', ' - TL', 1),
(21, 1, 'TSX', 'TSX', 1),
(22, 1, 'VIGOR', 'Vigor', 1),
(23, 1, 'ZDX', 'ZDX', 1),
(24, 1, 'ACUOTH', 'Other Acura Models', 1),
(25, 2, 'ALFA164', '164', 1),
(26, 2, 'ALFA8C', '8C Competizione', 1),
(27, 2, 'ALFAGT', 'GTV-6', 1),
(28, 2, 'MIL', 'Milano', 1),
(29, 2, 'SPID', 'Spider', 1),
(30, 2, 'ALFAOTH', 'Other Alfa Romeo Models', 1),
(31, 3, 'AMCALLIAN', 'Alliance', 1),
(32, 3, 'CON', 'Concord', 1),
(33, 3, 'EAGLE', 'Eagle', 1),
(34, 3, 'AMCENC', 'Encore', 1),
(35, 3, 'AMCSPIRIT', 'Spirit', 1),
(36, 3, 'AMCOTH', 'Other AMC Models', 1),
(37, 4, 'DB7', 'DB7', 1),
(38, 4, 'DB9', 'DB9', 1),
(39, 4, 'DBS', 'DBS', 1),
(40, 4, 'LAGONDA', 'Lagonda', 1),
(41, 4, 'RAPIDE', 'Rapide', 1),
(42, 4, 'V12VANT', 'V12 Vantage', 1),
(43, 4, 'VANTAGE', 'V8 Vantage', 1),
(44, 4, 'VANQUISH', 'Vanquish', 1),
(45, 4, 'VIRAGE', 'Virage', 1),
(46, 4, 'UNAVAILAST', 'Other Aston Martin Models', 1),
(47, 5, 'AUDI100', '100', 1),
(48, 5, 'AUDI200', '200', 1),
(49, 5, '4000', '4000', 1),
(50, 5, '5000', '5000', 1),
(51, 5, '80', '80', 1),
(52, 5, '90', '90', 1),
(53, 5, 'A3', 'A3', 1),
(54, 5, 'A4', 'A4', 1),
(55, 5, 'A5', 'A5', 1),
(56, 5, 'A6', 'A6', 1),
(57, 5, 'A7', 'A7', 1),
(58, 5, 'A8', 'A8', 1),
(59, 5, 'ALLRDQUA', 'allroad', 1),
(60, 5, 'AUDICABRI', 'Cabriolet', 1),
(61, 5, 'AUDICOUPE', 'Coupe', 1),
(62, 5, 'Q3', 'Q3', 1),
(63, 5, 'Q5', 'Q5', 1),
(64, 5, 'Q7', 'Q7', 1),
(65, 5, 'QUATTR', 'Quattro', 1),
(66, 5, 'R8', 'R8', 1),
(67, 5, 'RS4', 'RS 4', 1),
(68, 5, 'RS5', 'RS 5', 1),
(69, 5, 'RS6', 'RS 6', 1),
(70, 5, 'S4', 'S4', 1),
(71, 5, 'S5', 'S5', 1),
(72, 5, 'S6', 'S6', 1),
(73, 5, 'S7', 'S7', 1),
(74, 5, 'S8', 'S8', 1),
(75, 5, 'TT', 'TT', 1),
(76, 5, 'TTRS', 'TT RS', 1),
(77, 5, 'TTS', 'TTS', 1),
(78, 5, 'V8', 'V8 Quattro', 1),
(79, 5, 'AUDOTH', 'Other Audi Models', 1),
(80, 6, 'CONVERT', 'Convertible', 1),
(81, 6, 'COUPEAVANT', 'Coupe', 1),
(82, 6, 'SEDAN', 'Sedan', 1),
(83, 6, 'UNAVAILAVA', 'Other Avanti Models', 1),
(84, 7, 'ARNAGE', 'Arnage', 1),
(85, 7, 'AZURE', 'Azure', 1),
(86, 7, 'BROOKLANDS', 'Brooklands', 1),
(87, 7, 'BENCONT', 'Continental', 1),
(88, 7, 'CORNICHE', 'Corniche', 1),
(89, 7, 'BENEIGHT', 'Eight', 1),
(90, 7, 'BENMUL', 'Mulsanne', 1),
(91, 7, 'BENTURBO', 'Turbo R', 1),
(92, 7, 'UNAVAILBEN', 'Other Bentley Models', 1),
(93, 8, '1_SERIES', '1 Series (3)', 1),
(94, 8, '128I', ' - 128i', 1),
(95, 8, '135I', ' - 135i', 1),
(96, 8, '135IS', ' - 135is', 1),
(97, 8, '3_SERIES', '3 Series (29)', 1),
(98, 8, '318I', ' - 318i', 1),
(99, 8, '318IC', ' - 318iC', 1),
(100, 8, '318IS', ' - 318iS', 1),
(101, 8, '318TI', ' - 318ti', 1),
(102, 8, '320I', ' - 320i', 1),
(103, 8, '323CI', ' - 323ci', 1),
(104, 8, '323I', ' - 323i', 1),
(105, 8, '323IS', ' - 323is', 1),
(106, 8, '323IT', ' - 323iT', 1),
(107, 8, '325CI', ' - 325Ci', 1),
(108, 8, '325E', ' - 325e', 1),
(109, 8, '325ES', ' - 325es', 1),
(110, 8, '325I', ' - 325i', 1),
(111, 8, '325IS', ' - 325is', 1),
(112, 8, '325IX', ' - 325iX', 1),
(113, 8, '325XI', ' - 325xi', 1),
(114, 8, '328CI', ' - 328Ci', 1),
(115, 8, '328I', ' - 328i', 1),
(116, 8, '328IS', ' - 328iS', 1),
(117, 8, '328XI', ' - 328xi', 1),
(118, 8, '330CI', ' - 330Ci', 1),
(119, 8, '330I', ' - 330i', 1),
(120, 8, '330XI', ' - 330xi', 1),
(121, 8, '335D', ' - 335d', 1),
(122, 8, '335I', ' - 335i', 1),
(123, 8, '335IS', ' - 335is', 1),
(124, 8, '335XI', ' - 335xi', 1),
(125, 8, 'ACTIVE3', ' - ActiveHybrid 3', 1),
(126, 8, 'BMW325', ' - 325', 1),
(127, 8, '5_SERIES', '5 Series (19)', 1),
(128, 8, '524TD', ' - 524td', 1),
(129, 8, '525I', ' - 525i', 1),
(130, 8, '525XI', ' - 525xi', 1),
(131, 8, '528E', ' - 528e', 1),
(132, 8, '528I', ' - 528i', 1),
(133, 8, '528IT', ' - 528iT', 1),
(134, 8, '528XI', ' - 528xi', 1),
(135, 8, '530I', ' - 530i', 1),
(136, 8, '530IT', ' - 530iT', 1),
(137, 8, '530XI', ' - 530xi', 1),
(138, 8, '533I', ' - 533i', 1),
(139, 8, '535I', ' - 535i', 1),
(140, 8, '535IGT', ' - 535i Gran Turismo', 1),
(141, 8, '535XI', ' - 535xi', 1),
(142, 8, '540I', ' - 540i', 1),
(143, 8, '545I', ' - 545i', 1),
(144, 8, '550I', ' - 550i', 1),
(145, 8, '550IGT', ' - 550i Gran Turismo', 1),
(146, 8, 'ACTIVE5', ' - ActiveHybrid 5', 1),
(147, 8, '6_SERIES', '6 Series (8)', 1),
(148, 8, '633CSI', ' - 633CSi', 1),
(149, 8, '635CSI', ' - 635CSi', 1),
(150, 8, '640I', ' - 640i', 1),
(151, 8, '640IGC', ' - 640i Gran Coupe', 1),
(152, 8, '645CI', ' - 645Ci', 1),
(153, 8, '650I', ' - 650i', 1),
(154, 8, '650IGC', ' - 650i Gran Coupe', 1),
(155, 8, 'L6', ' - L6', 1),
(156, 8, '7_SERIES', '7 Series (15)', 1),
(157, 8, '733I', ' - 733i', 1),
(158, 8, '735I', ' - 735i', 1),
(159, 8, '735IL', ' - 735iL', 1),
(160, 8, '740I', ' - 740i', 1),
(161, 8, '740IL', ' - 740iL', 1),
(162, 8, '740LI', ' - 740Li', 1),
(163, 8, '745I', ' - 745i', 1),
(164, 8, '745LI', ' - 745Li', 1),
(165, 8, '750I', ' - 750i', 1),
(166, 8, '750IL', ' - 750iL', 1),
(167, 8, '750LI', ' - 750Li', 1),
(168, 8, '760I', ' - 760i', 1),
(169, 8, '760LI', ' - 760Li', 1),
(170, 8, 'ACTIVE7', ' - ActiveHybrid 7', 1),
(171, 8, 'ALPINAB7', ' - Alpina B7', 1),
(172, 8, '8_SERIES', '8 Series (4)', 1),
(173, 8, '840CI', ' - 840Ci', 1),
(174, 8, '850CI', ' - 850Ci', 1),
(175, 8, '850CSI', ' - 850CSi', 1),
(176, 8, '850I', ' - 850i', 1),
(177, 8, 'L_SERIES', 'L Series (1)', 1),
(178, 8, 'L7', ' - L7', 1),
(179, 8, 'M_SERIES', 'M Series (8)', 1),
(180, 8, '1SERIESM', ' - 1 Series M', 1),
(181, 8, 'BMWMCOUPE', ' - M Coupe', 1),
(182, 8, 'BMWROAD', ' - M Roadster', 1),
(183, 8, 'M3', ' - M3', 1),
(184, 8, 'M5', ' - M5', 1),
(185, 8, 'M6', ' - M6', 1),
(186, 8, 'X5M', ' - X5 M', 1),
(187, 8, 'X6M', ' - X6 M', 1),
(188, 8, 'X_SERIES', 'X Series (5)', 1),
(189, 8, 'ACTIVEX6', ' - ActiveHybrid X6', 1),
(190, 8, 'X1', ' - X1', 1),
(191, 8, 'X3', ' - X3', 1),
(192, 8, 'X5', ' - X5', 1),
(193, 8, 'X6', ' - X6', 1),
(194, 8, 'Z_SERIES', 'Z Series (3)', 1),
(195, 8, 'Z3', ' - Z3', 1),
(196, 8, 'Z4', ' - Z4', 1),
(197, 8, 'Z8', ' - Z8', 1),
(198, 8, 'BMWOTH', 'Other BMW Models', 1),
(199, 9, 'CENT', 'Century', 1),
(200, 9, 'ELEC', 'Electra', 1),
(201, 9, 'ENCLAVE', 'Enclave', 1),
(202, 9, 'BUIENC', 'Encore', 1),
(203, 9, 'LACROSSE', 'LaCrosse', 1),
(204, 9, 'LESA', 'Le Sabre', 1),
(205, 9, 'LUCERNE', 'Lucerne', 1),
(206, 9, 'PARK', 'Park Avenue', 1),
(207, 9, 'RAINIER', 'Rainier', 1),
(208, 9, 'REATTA', 'Reatta', 1),
(209, 9, 'REG', 'Regal', 1),
(210, 9, 'RENDEZVOUS', 'Rendezvous', 1),
(211, 9, 'RIV', 'Riviera', 1),
(212, 9, 'BUICKROAD', 'Roadmaster', 1),
(213, 9, 'SKYH', 'Skyhawk', 1),
(214, 9, 'SKYL', 'Skylark', 1),
(215, 9, 'SOMER', 'Somerset', 1),
(216, 9, 'TERRAZA', 'Terraza', 1),
(217, 9, 'BUVERANO', 'Verano', 1),
(218, 9, 'BUOTH', 'Other Buick Models', 1),
(219, 10, 'ALLANT', 'Allante', 1),
(220, 10, 'ATS', 'ATS', 1),
(221, 10, 'BROUGH', 'Brougham', 1),
(222, 10, 'CATERA', 'Catera', 1),
(223, 10, 'CIMA', 'Cimarron', 1),
(224, 10, 'CTS', 'CTS', 1),
(225, 10, 'DEV', 'De Ville', 1),
(226, 10, 'DTS', 'DTS', 1),
(227, 10, 'ELDO', 'Eldorado', 1),
(228, 10, 'ESCALA', 'Escalade', 1),
(229, 10, 'ESCALAESV', 'Escalade ESV', 1),
(230, 10, 'EXT', 'Escalade EXT', 1),
(231, 10, 'FLEE', 'Fleetwood', 1),
(232, 10, 'SEV', 'Seville', 1),
(233, 10, 'SRX', 'SRX', 1),
(234, 10, 'STS', 'STS', 1),
(235, 10, 'XLR', 'XLR', 1),
(236, 10, 'XTS', 'XTS', 1),
(237, 10, 'CADOTH', 'Other Cadillac Models', 1),
(238, 11, 'ASTRO', 'Astro', 1),
(239, 11, 'AVALNCH', 'Avalanche', 1),
(240, 11, 'AVEO', 'Aveo', 1),
(241, 11, 'AVEO5', 'Aveo5', 1),
(242, 11, 'BERETT', 'Beretta', 1),
(243, 11, 'BLAZER', 'Blazer', 1),
(244, 11, 'CAM', 'Camaro', 1),
(245, 11, 'CAP', 'Caprice', 1),
(246, 11, 'CHECAPS', 'Captiva Sport', 1),
(247, 11, 'CAV', 'Cavalier', 1),
(248, 11, 'CELE', 'Celebrity', 1),
(249, 11, 'CHEVETTE', 'Chevette', 1),
(250, 11, 'CITATION', 'Citation', 1),
(251, 11, 'COBALT', 'Cobalt', 1),
(252, 11, 'COLORADO', 'Colorado', 1),
(253, 11, 'CORSI', 'Corsica', 1),
(254, 11, 'CORV', 'Corvette', 1),
(255, 11, 'CRUZE', 'Cruze', 1),
(256, 11, 'ELCAM', 'El Camino', 1),
(257, 11, 'EQUINOX', 'Equinox', 1),
(258, 11, 'G15EXP', 'Express Van', 1),
(259, 11, 'G10', 'G Van', 1),
(260, 11, 'HHR', 'HHR', 1),
(261, 11, 'CHEVIMP', 'Impala', 1),
(262, 11, 'KODC4500', 'Kodiak C4500', 1),
(263, 11, 'LUMINA', 'Lumina', 1),
(264, 11, 'LAPV', 'Lumina APV', 1),
(265, 11, 'LUV', 'LUV', 1),
(266, 11, 'MALI', 'Malibu', 1),
(267, 11, 'CHVMETR', 'Metro', 1),
(268, 11, 'CHEVMONT', 'Monte Carlo', 1),
(269, 11, 'NOVA', 'Nova', 1),
(270, 11, 'CHEVPRIZM', 'Prizm', 1),
(271, 11, 'CHVST', 'S10 Blazer', 1),
(272, 11, 'S10PICKUP', 'S10 Pickup', 1),
(273, 11, 'CHEV150', 'Silverado and other C/K1500', 1),
(274, 11, 'CHEVC25', 'Silverado and other C/K2500', 1),
(275, 11, 'CH3500PU', 'Silverado and other C/K3500', 1),
(276, 11, 'SONIC', 'Sonic', 1),
(277, 11, 'SPARK', 'Spark', 1),
(278, 11, 'CHEVSPEC', 'Spectrum', 1),
(279, 11, 'CHSPRINT', 'Sprint', 1),
(280, 11, 'SSR', 'SSR', 1),
(281, 11, 'CHEVSUB', 'Suburban', 1),
(282, 11, 'TAHOE', 'Tahoe', 1),
(283, 11, 'TRACKE', 'Tracker', 1),
(284, 11, 'TRAILBLZ', 'TrailBlazer', 1),
(285, 11, 'TRAILBZEXT', 'TrailBlazer EXT', 1),
(286, 11, 'TRAVERSE', 'Traverse', 1),
(287, 11, 'UPLANDER', 'Uplander', 1),
(288, 11, 'VENTUR', 'Venture', 1),
(289, 11, 'VOLT', 'Volt', 1),
(290, 11, 'CHEOTH', 'Other Chevrolet Models', 1),
(291, 12, 'CHRYS200', '200', 1),
(292, 12, '300', '300', 1),
(293, 12, 'CHRY300', '300M', 1),
(294, 12, 'ASPEN', 'Aspen', 1),
(295, 12, 'CARAVAN', 'Caravan', 1),
(296, 12, 'CIRRUS', 'Cirrus', 1),
(297, 12, 'CONC', 'Concorde', 1),
(298, 12, 'CHRYCONQ', 'Conquest', 1),
(299, 12, 'CORDOBA', 'Cordoba', 1),
(300, 12, 'CROSSFIRE', 'Crossfire', 1),
(301, 12, 'ECLASS', 'E Class', 1),
(302, 12, 'FIFTH', 'Fifth Avenue', 1),
(303, 12, 'CHRYGRANDV', 'Grand Voyager', 1),
(304, 12, 'IMPE', 'Imperial', 1),
(305, 12, 'INTREPID', 'Intrepid', 1),
(306, 12, 'CHRYLAS', 'Laser', 1),
(307, 12, 'LEBA', 'LeBaron', 1),
(308, 12, 'LHS', 'LHS', 1),
(309, 12, 'CHRYNEON', 'Neon', 1),
(310, 12, 'NY', 'New Yorker', 1),
(311, 12, 'NEWPORT', 'Newport', 1),
(312, 12, 'PACIFICA', 'Pacifica', 1),
(313, 12, 'CHPROWLE', 'Prowler', 1),
(314, 12, 'PTCRUIS', 'PT Cruiser', 1),
(315, 12, 'CHRYSEB', 'Sebring', 1),
(316, 12, 'CHRYTC', 'TC by Maserati', 1),
(317, 12, 'TANDC', 'Town & Country', 1),
(318, 12, 'VOYAGER', 'Voyager', 1),
(319, 12, 'CHOTH', 'Other Chrysler Models', 1),
(320, 13, 'LANOS', 'Lanos', 1),
(321, 13, 'LEGANZA', 'Leganza', 1),
(322, 13, 'NUBIRA', 'Nubira', 1),
(323, 13, 'DAEOTH', 'Other Daewoo Models', 1),
(324, 14, 'CHAR', 'Charade', 1),
(325, 14, 'ROCKY', 'Rocky', 1),
(326, 14, 'DAIHOTH', 'Other Daihatsu Models', 1),
(327, 15, 'DAT200SX', '200SX', 1),
(328, 15, 'DAT210', '210', 1),
(329, 15, '280Z', '280ZX', 1),
(330, 15, '300ZX', '300ZX', 1),
(331, 15, '310', '310', 1),
(332, 15, '510', '510', 1),
(333, 15, '720', '720', 1),
(334, 15, '810', '810', 1),
(335, 15, 'DATMAX', 'Maxima', 1),
(336, 15, 'DATPU', 'Pickup', 1),
(337, 15, 'PUL', 'Pulsar', 1),
(338, 15, 'DATSENT', 'Sentra', 1),
(339, 15, 'STAN', 'Stanza', 1),
(340, 15, 'DATOTH', 'Other Datsun Models', 1),
(341, 16, 'DMC12', 'DMC-12', 1),
(342, 17, '400', '400', 1),
(343, 17, 'DOD600', '600', 1),
(344, 17, 'ARI', 'Aries', 1),
(345, 17, 'AVENGR', 'Avenger', 1),
(346, 17, 'CALIBER', 'Caliber', 1),
(347, 17, 'DODCARA', 'Caravan', 1),
(348, 17, 'CHALLENGER', 'Challenger', 1),
(349, 17, 'DODCHAR', 'Charger', 1),
(350, 17, 'DODCOLT', 'Colt', 1),
(351, 17, 'DODCONQ', 'Conquest', 1),
(352, 17, 'DODDW', 'D/W Truck', 1),
(353, 17, 'DAKOTA', 'Dakota', 1),
(354, 17, 'DODDART', 'Dart', 1),
(355, 17, 'DAY', 'Daytona', 1),
(356, 17, 'DIPLOMA', 'Diplomat', 1),
(357, 17, 'DURANG', 'Durango', 1),
(358, 17, 'DODDYNA', 'Dynasty', 1),
(359, 17, 'GRANDCARAV', 'Grand Caravan', 1),
(360, 17, 'INTRE', 'Intrepid', 1),
(361, 17, 'JOURNEY', 'Journey', 1),
(362, 17, 'LANCERDODG', 'Lancer', 1),
(363, 17, 'MAGNUM', 'Magnum', 1),
(364, 17, 'MIRADA', 'Mirada', 1),
(365, 17, 'MONACO', 'Monaco', 1),
(366, 17, 'DODNEON', 'Neon', 1),
(367, 17, 'NITRO', 'Nitro', 1),
(368, 17, 'OMNI', 'Omni', 1),
(369, 17, 'RAIDER', 'Raider', 1),
(370, 17, 'RAM1504WD', 'Ram 1500 Truck', 1),
(371, 17, 'RAM25002WD', 'Ram 2500 Truck', 1),
(372, 17, 'RAM3502WD', 'Ram 3500 Truck', 1),
(373, 17, 'RAM4500', 'Ram 4500 Truck', 1),
(374, 17, 'DODD50', 'Ram 50 Truck', 1),
(375, 17, 'CV', 'RAM C/V', 1),
(376, 17, 'RAMSRT10', 'Ram SRT-10', 1),
(377, 17, 'RAMVANV8', 'Ram Van', 1),
(378, 17, 'RAMWAGON', 'Ram Wagon', 1),
(379, 17, 'RAMCGR', 'Ramcharger', 1),
(380, 17, 'RAMPAGE', 'Rampage', 1),
(381, 17, 'DODSHAD', 'Shadow', 1),
(382, 17, 'DODSPIR', 'Spirit', 1),
(383, 17, 'SPRINTER', 'Sprinter', 1),
(384, 17, 'SRT4', 'SRT-4', 1),
(385, 17, 'STREGIS', 'St. Regis', 1),
(386, 17, 'STEAL', 'Stealth', 1),
(387, 17, 'STRATU', 'Stratus', 1),
(388, 17, 'VIPER', 'Viper', 1),
(389, 17, 'DOOTH', 'Other Dodge Models', 1),
(390, 18, 'EAGLEMED', 'Medallion', 1),
(391, 18, 'EAGLEPREM', 'Premier', 1),
(392, 18, 'SUMMIT', 'Summit', 1),
(393, 18, 'TALON', 'Talon', 1),
(394, 18, 'VISION', 'Vision', 1),
(395, 18, 'EAGOTH', 'Other Eagle Models', 1),
(396, 19, '308GTB', '308 GTB Quattrovalvole', 1),
(397, 19, '308TBI', '308 GTBI', 1),
(398, 19, '308GTS', '308 GTS Quattrovalvole', 1),
(399, 19, '308TSI', '308 GTSI', 1),
(400, 19, '328GTB', '328 GTB', 1),
(401, 19, '328GTS', '328 GTS', 1),
(402, 19, '348GTB', '348 GTB', 1),
(403, 19, '348GTS', '348 GTS', 1),
(404, 19, '348SPI', '348 Spider', 1),
(405, 19, '348TB', '348 TB', 1),
(406, 19, '348TS', '348 TS', 1),
(407, 19, '360', '360', 1),
(408, 19, '456GT', '456 GT', 1),
(409, 19, '456MGT', '456M GT', 1),
(410, 19, '458ITALIA', '458 Italia', 1),
(411, 19, '512BBI', '512 BBi', 1),
(412, 19, '512M', '512M', 1),
(413, 19, '512TR', '512TR', 1),
(414, 19, '550M', '550 Maranello', 1),
(415, 19, '575M', '575M Maranello', 1),
(416, 19, '599GTB', '599 GTB Fiorano', 1),
(417, 19, '599GTO', '599 GTO', 1),
(418, 19, '612SCAGLIE', '612 Scaglietti', 1),
(419, 19, 'FERCALIF', 'California', 1),
(420, 19, 'ENZO', 'Enzo', 1),
(421, 19, 'F355', 'F355', 1),
(422, 19, 'F40', 'F40', 1),
(423, 19, 'F430', 'F430', 1),
(424, 19, 'F50', 'F50', 1),
(425, 19, 'FERFF', 'FF', 1),
(426, 19, 'MOND', 'Mondial', 1),
(427, 19, 'TEST', 'Testarossa', 1),
(428, 19, 'UNAVAILFER', 'Other Ferrari Models', 1),
(429, 20, '2000', '2000 Spider', 1),
(430, 20, 'FIAT500', '500', 1),
(431, 20, 'BERTON', 'Bertone X1/9', 1),
(432, 20, 'BRAVA', 'Brava', 1),
(433, 20, 'PININ', 'Pininfarina Spider', 1),
(434, 20, 'STRADA', 'Strada', 1),
(435, 20, 'FIATX19', 'X1/9', 1),
(436, 20, 'UNAVAILFIA', 'Other Fiat Models', 1),
(437, 21, 'KARMA', 'Karma', 1),
(438, 22, 'AERO', 'Aerostar', 1),
(439, 22, 'ASPIRE', 'Aspire', 1),
(440, 22, 'BRON', 'Bronco', 1),
(441, 22, 'B2', 'Bronco II', 1),
(442, 22, 'FOCMAX', 'C-MAX', 1),
(443, 22, 'FORDCLUB', 'Club Wagon', 1),
(444, 22, 'CONTOUR', 'Contour', 1),
(445, 22, 'COURIER', 'Courier', 1),
(446, 22, 'CROWNVIC', 'Crown Victoria', 1),
(447, 22, 'E150ECON', 'E-150 and Econoline 150', 1),
(448, 22, 'E250ECON', 'E-250 and Econoline 250', 1),
(449, 22, 'E350ECON', 'E-350 and Econoline 350', 1),
(450, 22, 'EDGE', 'Edge', 1),
(451, 22, 'ESCAPE', 'Escape', 1),
(452, 22, 'ESCO', 'Escort', 1),
(453, 22, 'EXCURSION', 'Excursion', 1),
(454, 22, 'EXP', 'EXP', 1),
(455, 22, 'EXPEDI', 'Expedition', 1),
(456, 22, 'EXPEDIEL', 'Expedition EL', 1),
(457, 22, 'EXPLOR', 'Explorer', 1),
(458, 22, 'SPORTTRAC', 'Explorer Sport Trac', 1),
(459, 22, 'F100', 'F100', 1),
(460, 22, 'F150PICKUP', 'F150', 1),
(461, 22, 'F250', 'F250', 1),
(462, 22, 'F350', 'F350', 1),
(463, 22, 'F450', 'F450', 1),
(464, 22, 'FAIRM', 'Fairmont', 1),
(465, 22, 'FESTIV', 'Festiva', 1),
(466, 22, 'FIESTA', 'Fiesta', 1),
(467, 22, 'FIVEHUNDRE', 'Five Hundred', 1),
(468, 22, 'FLEX', 'Flex', 1),
(469, 22, 'FOCUS', 'Focus', 1),
(470, 22, 'FREESTAR', 'Freestar', 1),
(471, 22, 'FREESTYLE', 'Freestyle', 1),
(472, 22, 'FUSION', 'Fusion', 1),
(473, 22, 'GRANADA', 'Granada', 1),
(474, 22, 'GT', 'GT', 1),
(475, 22, 'LTD', 'LTD', 1),
(476, 22, 'MUST', 'Mustang', 1),
(477, 22, 'PROBE', 'Probe', 1),
(478, 22, 'RANGER', 'Ranger', 1),
(479, 22, 'TAURUS', 'Taurus', 1),
(480, 22, 'TAURUSX', 'Taurus X', 1),
(481, 22, 'TEMPO', 'Tempo', 1),
(482, 22, 'TBIRD', 'Thunderbird', 1),
(483, 22, 'TRANSCONN', 'Transit Connect', 1),
(484, 22, 'WINDST', 'Windstar', 1),
(485, 22, 'FORDZX2', 'ZX2 Escort', 1),
(486, 22, 'FOOTH', 'Other Ford Models', 1),
(487, 23, 'FRESPRINT', 'Sprinter', 1),
(488, 24, 'GEOMETRO', 'Metro', 1),
(489, 24, 'GEOPRIZM', 'Prizm', 1),
(490, 24, 'SPECT', 'Spectrum', 1),
(491, 24, 'STORM', 'Storm', 1),
(492, 24, 'GEOTRACK', 'Tracker', 1),
(493, 24, 'GEOOTH', 'Other Geo Models', 1),
(494, 25, 'ACADIA', 'Acadia', 1),
(495, 25, 'CABALLERO', 'Caballero', 1),
(496, 25, 'CANYON', 'Canyon', 1),
(497, 25, 'ENVOY', 'Envoy', 1),
(498, 25, 'ENVOYXL', 'Envoy XL', 1),
(499, 25, 'ENVOYXUV', 'Envoy XUV', 1),
(500, 25, 'JIM', 'Jimmy', 1),
(501, 25, 'RALLYWAG', 'Rally Wagon', 1),
(502, 25, 'GMCS15', 'S15 Jimmy', 1),
(503, 25, 'S15', 'S15 Pickup', 1),
(504, 25, 'SAFARIGMC', 'Safari', 1),
(505, 25, 'GMCSAVANA', 'Savana', 1),
(506, 25, '15SIPU4WD', 'Sierra C/K1500', 1),
(507, 25, 'GMCC25PU', 'Sierra C/K2500', 1),
(508, 25, 'GMC3500PU', 'Sierra C/K3500', 1),
(509, 25, 'SONOMA', 'Sonoma', 1),
(510, 25, 'SUB', 'Suburban', 1),
(511, 25, 'GMCSYCLON', 'Syclone', 1),
(512, 25, 'TERRAIN', 'Terrain', 1),
(513, 25, 'TOPC4500', 'TopKick C4500', 1),
(514, 25, 'TYPH', 'Typhoon', 1),
(515, 25, 'GMCVANDUR', 'Vandura', 1),
(516, 25, 'YUKON', 'Yukon', 1),
(517, 25, 'YUKONXL', 'Yukon XL', 1),
(518, 25, 'GMCOTH', 'Other GMC Models', 1),
(519, 26, 'ACCORD', 'Accord', 1),
(520, 26, 'CIVIC', 'Civic', 1),
(521, 26, 'CRV', 'CR-V', 1),
(522, 26, 'CRZ', 'CR-Z', 1),
(523, 26, 'CRX', 'CRX', 1),
(524, 26, 'CROSSTOUR_MODELS', 'Crosstour and Accord Crosstour Models (2)', 1),
(525, 26, 'CROSSTOUR', ' - Accord Crosstour', 1),
(526, 26, 'HONCROSS', ' - Crosstour', 1),
(527, 26, 'HONDELSOL', 'Del Sol', 1),
(528, 26, 'ELEMENT', 'Element', 1),
(529, 26, 'FIT', 'Fit', 1),
(530, 26, 'INSIGHT', 'Insight', 1),
(531, 26, 'ODYSSEY', 'Odyssey', 1),
(532, 26, 'PASSPO', 'Passport', 1),
(533, 26, 'PILOT', 'Pilot', 1),
(534, 26, 'PRE', 'Prelude', 1),
(535, 26, 'RIDGELINE', 'Ridgeline', 1),
(536, 26, 'S2000', 'S2000', 1),
(537, 26, 'HONOTH', 'Other Honda Models', 1),
(538, 27, 'HUMMER', 'H1', 1),
(539, 27, 'H2', 'H2', 1),
(540, 27, 'H3', 'H3', 1),
(541, 27, 'H3T', 'H3T', 1),
(542, 27, 'AMGOTH', 'Other Hummer Models', 1),
(543, 28, 'ACCENT', 'Accent', 1),
(544, 28, 'AZERA', 'Azera', 1),
(545, 28, 'ELANTR', 'Elantra', 1),
(546, 28, 'HYUELANCPE', 'Elantra Coupe', 1),
(547, 28, 'ELANTOUR', 'Elantra Touring', 1),
(548, 28, 'ENTOURAGE', 'Entourage', 1),
(549, 28, 'EQUUS', 'Equus', 1),
(550, 28, 'HYUEXCEL', 'Excel', 1),
(551, 28, 'GENESIS', 'Genesis', 1),
(552, 28, 'GENESISCPE', 'Genesis Coupe', 1),
(553, 28, 'SANTAFE', 'Santa Fe', 1),
(554, 28, 'SCOUPE', 'Scoupe', 1),
(555, 28, 'SONATA', 'Sonata', 1),
(556, 28, 'TIBURO', 'Tiburon', 1),
(557, 28, 'TUCSON', 'Tucson', 1),
(558, 28, 'VELOSTER', 'Veloster', 1),
(559, 28, 'VERACRUZ', 'Veracruz', 1),
(560, 28, 'XG300', 'XG300', 1),
(561, 28, 'XG350', 'XG350', 1),
(562, 28, 'HYUOTH', 'Other Hyundai Models', 1),
(563, 29, 'EX_MODELS', 'EX Models (2)', 1),
(564, 29, 'EX35', ' - EX35', 1),
(565, 29, 'EX37', ' - EX37', 1),
(566, 29, 'FX_MODELS', 'FX Models (4)', 1),
(567, 29, 'FX35', ' - FX35', 1),
(568, 29, 'FX37', ' - FX37', 1),
(569, 29, 'FX45', ' - FX45', 1),
(570, 29, 'FX50', ' - FX50', 1),
(571, 29, 'G_MODELS', 'G Models (4)', 1),
(572, 29, 'G20', ' - G20', 1),
(573, 29, 'G25', ' - G25', 1),
(574, 29, 'G35', ' - G35', 1),
(575, 29, 'G37', ' - G37', 1),
(576, 29, 'I_MODELS', 'I Models (2)', 1),
(577, 29, 'I30', ' - I30', 1),
(578, 29, 'I35', ' - I35', 1),
(579, 29, 'J_MODELS', 'J Models (1)', 1),
(580, 29, 'J30', ' - J30', 1),
(581, 29, 'JX_MODELS', 'JX Models (1)', 1),
(582, 29, 'JX35', ' - JX35', 1),
(583, 29, 'M_MODELS', 'M Models (6)', 1),
(584, 29, 'M30', ' - M30', 1),
(585, 29, 'M35', ' - M35', 1),
(586, 29, 'M35HYBRID', ' - M35h', 1),
(587, 29, 'M37', ' - M37', 1),
(588, 29, 'M45', ' - M45', 1),
(589, 29, 'M56', ' - M56', 1),
(590, 29, 'Q_MODELS', 'Q Models (1)', 1),
(591, 29, 'Q45', ' - Q45', 1),
(592, 29, 'QX_MODELS', 'QX Models (2)', 1),
(593, 29, 'QX4', ' - QX4', 1),
(594, 29, 'QX56', ' - QX56', 1),
(595, 29, 'INFOTH', 'Other Infiniti Models', 1),
(596, 30, 'AMIGO', 'Amigo', 1),
(597, 30, 'ASCENDER', 'Ascender', 1),
(598, 30, 'AXIOM', 'Axiom', 1),
(599, 30, 'HOMBRE', 'Hombre', 1),
(600, 30, 'I280', 'i-280', 1),
(601, 30, 'I290', 'i-290', 1),
(602, 30, 'I350', 'i-350', 1),
(603, 30, 'I370', 'i-370', 1),
(604, 30, 'ISUMARK', 'I-Mark', 1),
(605, 30, 'ISUIMP', 'Impulse', 1),
(606, 30, 'OASIS', 'Oasis', 1),
(607, 30, 'ISUPU', 'Pickup', 1),
(608, 30, 'RODEO', 'Rodeo', 1),
(609, 30, 'STYLUS', 'Stylus', 1),
(610, 30, 'TROOP', 'Trooper', 1),
(611, 30, 'TRP2', 'Trooper II', 1),
(612, 30, 'VEHICROSS', 'VehiCROSS', 1),
(613, 30, 'ISUOTH', 'Other Isuzu Models', 1),
(614, 31, 'STYPE', 'S-Type', 1),
(615, 31, 'XTYPE', 'X-Type', 1),
(616, 31, 'XF', 'XF', 1),
(617, 31, 'XJ_SERIES', 'XJ Series (10)', 1),
(618, 31, 'JAGXJ12', ' - XJ12', 1),
(619, 31, 'JAGXJ6', ' - XJ6', 1),
(620, 31, 'JAGXJR', ' - XJR', 1),
(621, 31, 'JAGXJRS', ' - XJR-S', 1),
(622, 31, 'JAGXJS', ' - XJS', 1),
(623, 31, 'VANDEN', ' - XJ Vanden Plas', 1),
(624, 31, 'XJ', ' - XJ', 1),
(625, 31, 'XJ8', ' - XJ8', 1),
(626, 31, 'XJ8L', ' - XJ8 L', 1),
(627, 31, 'XJSPORT', ' - XJ Sport', 1),
(628, 31, 'XK_SERIES', 'XK Series (3)', 1),
(629, 31, 'JAGXK8', ' - XK8', 1),
(630, 31, 'XK', ' - XK', 1),
(631, 31, 'XKR', ' - XKR', 1),
(632, 31, 'JAGOTH', 'Other Jaguar Models', 1),
(633, 32, 'CHER', 'Cherokee', 1),
(634, 32, 'JEEPCJ', 'CJ', 1),
(635, 32, 'COMANC', 'Comanche', 1),
(636, 32, 'COMMANDER', 'Commander', 1),
(637, 32, 'COMPASS', 'Compass', 1),
(638, 32, 'JEEPGRAND', 'Grand Cherokee', 1),
(639, 32, 'GRWAG', 'Grand Wagoneer', 1),
(640, 32, 'LIBERTY', 'Liberty', 1),
(641, 32, 'PATRIOT', 'Patriot', 1),
(642, 32, 'JEEPPU', 'Pickup', 1),
(643, 32, 'SCRAMBLE', 'Scrambler', 1),
(644, 32, 'WAGONE', 'Wagoneer', 1),
(645, 32, 'WRANGLER', 'Wrangler', 1),
(646, 32, 'JEOTH', 'Other Jeep Models', 1),
(647, 33, 'AMANTI', 'Amanti', 1),
(648, 33, 'BORREGO', 'Borrego', 1),
(649, 33, 'FORTE', 'Forte', 1),
(650, 33, 'FORTEKOUP', 'Forte Koup', 1),
(651, 33, 'OPTIMA', 'Optima', 1),
(652, 33, 'RIO', 'Rio', 1),
(653, 33, 'RIO5', 'Rio5', 1),
(654, 33, 'RONDO', 'Rondo', 1),
(655, 33, 'SEDONA', 'Sedona', 1),
(656, 33, 'SEPHIA', 'Sephia', 1),
(657, 33, 'SORENTO', 'Sorento', 1),
(658, 33, 'SOUL', 'Soul', 1),
(659, 33, 'SPECTRA', 'Spectra', 1),
(660, 33, 'SPECTRA5', 'Spectra5', 1),
(661, 33, 'SPORTA', 'Sportage', 1),
(662, 33, 'KIAOTH', 'Other Kia Models', 1),
(663, 34, 'AVENT', 'Aventador', 1),
(664, 34, 'COUNT', 'Countach', 1),
(665, 34, 'DIABLO', 'Diablo', 1),
(666, 34, 'GALLARDO', 'Gallardo', 1),
(667, 34, 'JALPA', 'Jalpa', 1),
(668, 34, 'LM002', 'LM002', 1),
(669, 34, 'MURCIELAGO', 'Murcielago', 1),
(670, 34, 'UNAVAILLAM', 'Other Lamborghini Models', 1),
(671, 35, 'BETA', 'Beta', 1),
(672, 35, 'ZAGATO', 'Zagato', 1),
(673, 35, 'UNAVAILLAN', 'Other Lancia Models', 1),
(674, 36, 'DEFEND', 'Defender', 1),
(675, 36, 'DISCOV', 'Discovery', 1),
(676, 36, 'FRELNDR', 'Freelander', 1),
(677, 36, 'LR2', 'LR2', 1),
(678, 36, 'LR3', 'LR3', 1),
(679, 36, 'LR4', 'LR4', 1),
(680, 36, 'RANGE', 'Range Rover', 1),
(681, 36, 'EVOQUE', 'Range Rover Evoque', 1),
(682, 36, 'RANGESPORT', 'Range Rover Sport', 1),
(683, 36, 'ROVOTH', 'Other Land Rover Models', 1),
(684, 37, 'CT_MODELS', 'CT Models (1)', 1),
(685, 37, 'CT200H', ' - CT 200h', 1),
(686, 37, 'ES_MODELS', 'ES Models (5)', 1),
(687, 37, 'ES250', ' - ES 250', 1),
(688, 37, 'ES300', ' - ES 300', 1),
(689, 37, 'ES300H', ' - ES 300h', 1),
(690, 37, 'ES330', ' - ES 330', 1),
(691, 37, 'ES350', ' - ES 350', 1),
(692, 37, 'GS_MODELS', 'GS Models (6)', 1),
(693, 37, 'GS300', ' - GS 300', 1),
(694, 37, 'GS350', ' - GS 350', 1),
(695, 37, 'GS400', ' - GS 400', 1),
(696, 37, 'GS430', ' - GS 430', 1),
(697, 37, 'GS450H', ' - GS 450h', 1),
(698, 37, 'GS460', ' - GS 460', 1),
(699, 37, 'GX_MODELS', 'GX Models (2)', 1),
(700, 37, 'GX460', ' - GX 460', 1),
(701, 37, 'GX470', ' - GX 470', 1),
(702, 37, 'HS_MODELS', 'HS Models (1)', 1),
(703, 37, 'HS250H', ' - HS 250h', 1),
(704, 37, 'IS_MODELS', 'IS Models (6)', 1),
(705, 37, 'IS250', ' - IS 250', 1),
(706, 37, 'IS250C', ' - IS 250C', 1),
(707, 37, 'IS300', ' - IS 300', 1),
(708, 37, 'IS350', ' - IS 350', 1),
(709, 37, 'IS350C', ' - IS 350C', 1),
(710, 37, 'ISF', ' - IS F', 1),
(711, 37, 'LEXLFA', 'LFA', 1),
(712, 37, 'LS_MODELS', 'LS Models (4)', 1),
(713, 37, 'LS400', ' - LS 400', 1),
(714, 37, 'LS430', ' - LS 430', 1),
(715, 37, 'LS460', ' - LS 460', 1),
(716, 37, 'LS600H', ' - LS 600h', 1),
(717, 37, 'LX_MODELS', 'LX Models (3)', 1),
(718, 37, 'LX450', ' - LX 450', 1),
(719, 37, 'LX470', ' - LX 470', 1),
(720, 37, 'LX570', ' - LX 570', 1),
(721, 37, 'RX_MODELS', 'RX Models (5)', 1),
(722, 37, 'RX300', ' - RX 300', 1),
(723, 37, 'RX330', ' - RX 330', 1),
(724, 37, 'RX350', ' - RX 350', 1),
(725, 37, 'RX400H', ' - RX 400h', 1),
(726, 37, 'RX450H', ' - RX 450h', 1),
(727, 37, 'SC_MODELS', 'SC Models (3)', 1),
(728, 37, 'SC300', ' - SC 300', 1),
(729, 37, 'SC400', ' - SC 400', 1),
(730, 37, 'SC430', ' - SC 430', 1),
(731, 37, 'LEXOTH', 'Other Lexus Models', 1),
(732, 38, 'AVIATOR', 'Aviator', 1),
(733, 38, 'BLKWOOD', 'Blackwood', 1),
(734, 38, 'CONT', 'Continental', 1),
(735, 38, 'LSLINCOLN', 'LS', 1),
(736, 38, 'MARKLT', 'Mark LT', 1),
(737, 38, 'MARK6', 'Mark VI', 1),
(738, 38, 'MARK7', 'Mark VII', 1),
(739, 38, 'MARK8', 'Mark VIII', 1),
(740, 38, 'MKS', 'MKS', 1),
(741, 38, 'MKT', 'MKT', 1),
(742, 38, 'MKX', 'MKX', 1),
(743, 38, 'MKZ', 'MKZ', 1),
(744, 38, 'NAVIGA', 'Navigator', 1),
(745, 38, 'NAVIGAL', 'Navigator L', 1),
(746, 38, 'LINCTC', 'Town Car', 1),
(747, 38, 'ZEPHYR', 'Zephyr', 1),
(748, 38, 'LINOTH', 'Other Lincoln Models', 1),
(749, 39, 'ELAN', 'Elan', 1),
(750, 39, 'LOTELISE', 'Elise', 1),
(751, 39, 'ESPRIT', 'Esprit', 1),
(752, 39, 'EVORA', 'Evora', 1),
(753, 39, 'EXIGE', 'Exige', 1),
(754, 39, 'UNAVAILLOT', 'Other Lotus Models', 1),
(755, 40, '430', '430', 1),
(756, 40, 'BITRBO', 'Biturbo', 1),
(757, 40, 'COUPEMAS', 'Coupe', 1),
(758, 40, 'GRANSPORT', 'GranSport', 1),
(759, 40, 'GRANTURISM', 'GranTurismo', 1),
(760, 40, 'QP', 'Quattroporte', 1),
(761, 40, 'SPYDER', 'Spyder', 1),
(762, 40, 'UNAVAILMAS', 'Other Maserati Models', 1),
(763, 41, '57MAYBACH', '57', 1),
(764, 41, '62MAYBACH', '62', 1),
(765, 41, 'UNAVAILMAY', 'Other Maybach Models', 1),
(766, 42, 'MAZDA323', '323', 1),
(767, 42, 'MAZDA626', '626', 1),
(768, 42, '929', '929', 1),
(769, 42, 'B-SERIES', 'B-Series Pickup', 1),
(770, 42, 'CX-5', 'CX-5', 1),
(771, 42, 'CX-7', 'CX-7', 1),
(772, 42, 'CX-9', 'CX-9', 1),
(773, 42, 'GLC', 'GLC', 1),
(774, 42, 'MAZDA2', 'MAZDA2', 1),
(775, 42, 'MAZDA3', 'MAZDA3', 1),
(776, 42, 'MAZDA5', 'MAZDA5', 1),
(777, 42, 'MAZDA6', 'MAZDA6', 1),
(778, 42, 'MAZDASPD3', 'MAZDASPEED3', 1),
(779, 42, 'MAZDASPD6', 'MAZDASPEED6', 1),
(780, 42, 'MIATA', 'Miata MX5', 1),
(781, 42, 'MILL', 'Millenia', 1),
(782, 42, 'MPV', 'MPV', 1),
(783, 42, 'MX3', 'MX3', 1),
(784, 42, 'MX6', 'MX6', 1),
(785, 42, 'NAVAJO', 'Navajo', 1),
(786, 42, 'PROTE', 'Protege', 1),
(787, 42, 'PROTE5', 'Protege5', 1),
(788, 42, 'RX7', 'RX-7', 1),
(789, 42, 'RX8', 'RX-8', 1),
(790, 42, 'TRIBUTE', 'Tribute', 1),
(791, 42, 'MAZOTH', 'Other Mazda Models', 1),
(792, 43, 'MP4', 'MP4-12C', 1),
(793, 44, '190_CLASS', '190 Class (2)', 1),
(794, 44, '190D', ' - 190D', 1),
(795, 44, '190E', ' - 190E', 1),
(796, 44, '240_CLASS', '240 Class (1)', 1),
(797, 44, '240D', ' - 240D', 1),
(798, 44, '300_CLASS_E_CLASS', '300 Class / E Class (6)', 1),
(799, 44, '300CD', ' - 300CD', 1),
(800, 44, '300CE', ' - 300CE', 1),
(801, 44, '300D', ' - 300D', 1),
(802, 44, '300E', ' - 300E', 1),
(803, 44, '300TD', ' - 300TD', 1),
(804, 44, '300TE', ' - 300TE', 1),
(805, 44, 'C_CLASS', 'C Class (13)', 1),
(806, 44, 'C220', ' - C220', 1),
(807, 44, 'C230', ' - C230', 1),
(808, 44, 'C240', ' - C240', 1),
(809, 44, 'C250', ' - C250', 1),
(810, 44, 'C280', ' - C280', 1),
(811, 44, 'C300', ' - C300', 1),
(812, 44, 'C320', ' - C320', 1),
(813, 44, 'C32AMG', ' - C32 AMG', 1),
(814, 44, 'C350', ' - C350', 1),
(815, 44, 'C36AMG', ' - C36 AMG', 1),
(816, 44, 'C43AMG', ' - C43 AMG', 1),
(817, 44, 'C55AMG', ' - C55 AMG', 1),
(818, 44, 'C63AMG', ' - C63 AMG', 1),
(819, 44, 'CL_CLASS', 'CL Class (6)', 1),
(820, 44, 'CL500', ' - CL500', 1),
(821, 44, 'CL550', ' - CL550', 1),
(822, 44, 'CL55AMG', ' - CL55 AMG', 1),
(823, 44, 'CL600', ' - CL600', 1),
(824, 44, 'CL63AMG', ' - CL63 AMG', 1),
(825, 44, 'CL65AMG', ' - CL65 AMG', 1),
(826, 44, 'CLK_CLASS', 'CLK Class (7)', 1),
(827, 44, 'CLK320', ' - CLK320', 1),
(828, 44, 'CLK350', ' - CLK350', 1),
(829, 44, 'CLK430', ' - CLK430', 1),
(830, 44, 'CLK500', ' - CLK500', 1),
(831, 44, 'CLK550', ' - CLK550', 1),
(832, 44, 'CLK55AMG', ' - CLK55 AMG', 1),
(833, 44, 'CLK63AMG', ' - CLK63 AMG', 1),
(834, 44, 'CLS_CLASS', 'CLS Class (4)', 1),
(835, 44, 'CLS500', ' - CLS500', 1),
(836, 44, 'CLS550', ' - CLS550', 1),
(837, 44, 'CLS55AMG', ' - CLS55 AMG', 1),
(838, 44, 'CLS63AMG', ' - CLS63 AMG', 1),
(839, 44, 'E_CLASS', 'E Class (18)', 1),
(840, 44, '260E', ' - 260E', 1),
(841, 44, '280CE', ' - 280CE', 1),
(842, 44, '280E', ' - 280E', 1),
(843, 44, '400E', ' - 400E', 1),
(844, 44, '500E', ' - 500E', 1),
(845, 44, 'E300', ' - E300', 1),
(846, 44, 'E320', ' - E320', 1),
(847, 44, 'E320BLUE', ' - E320 Bluetec', 1),
(848, 44, 'E320CDI', ' - E320 CDI', 1),
(849, 44, 'E350', ' - E350', 1),
(850, 44, 'E350BLUE', ' - E350 Bluetec', 1),
(851, 44, 'E400', ' - E400 Hybrid', 1),
(852, 44, 'E420', ' - E420', 1),
(853, 44, 'E430', ' - E430', 1),
(854, 44, 'E500', ' - E500', 1),
(855, 44, 'E550', ' - E550', 1),
(856, 44, 'E55AMG', ' - E55 AMG', 1),
(857, 44, 'E63AMG', ' - E63 AMG', 1),
(858, 44, 'G_CLASS', 'G Class (4)', 1),
(859, 44, 'G500', ' - G500', 1),
(860, 44, 'G550', ' - G550', 1),
(861, 44, 'G55AMG', ' - G55 AMG', 1),
(862, 44, 'G63AMG', ' - G63 AMG', 1),
(863, 44, 'GL_CLASS', 'GL Class (5)', 1),
(864, 44, 'GL320BLUE', ' - GL320 Bluetec', 1),
(865, 44, 'GL320CDI', ' - GL320 CDI', 1),
(866, 44, 'GL350BLUE', ' - GL350 Bluetec', 1),
(867, 44, 'GL450', ' - GL450', 1),
(868, 44, 'GL550', ' - GL550', 1),
(869, 44, 'GLK_CLASS', 'GLK Class (1)', 1),
(870, 44, 'GLK350', ' - GLK350', 1),
(871, 44, 'M_CLASS', 'M Class (11)', 1),
(872, 44, 'ML320', ' - ML320', 1),
(873, 44, 'ML320BLUE', ' - ML320 Bluetec', 1),
(874, 44, 'ML320CDI', ' - ML320 CDI', 1),
(875, 44, 'ML350', ' - ML350', 1),
(876, 44, 'ML350BLUE', ' - ML350 Bluetec', 1),
(877, 44, 'ML430', ' - ML430', 1),
(878, 44, 'ML450HY', ' - ML450 Hybrid', 1),
(879, 44, 'ML500', ' - ML500', 1),
(880, 44, 'ML550', ' - ML550', 1),
(881, 44, 'ML55AMG', ' - ML55 AMG', 1),
(882, 44, 'ML63AMG', ' - ML63 AMG', 1),
(883, 44, 'R_CLASS', 'R Class (6)', 1),
(884, 44, 'R320BLUE', ' - R320 Bluetec', 1),
(885, 44, 'R320CDI', ' - R320 CDI', 1),
(886, 44, 'R350', ' - R350', 1),
(887, 44, 'R350BLUE', ' - R350 Bluetec', 1),
(888, 44, 'R500', ' - R500', 1),
(889, 44, 'R63AMG', ' - R63 AMG', 1),
(890, 44, 'S_CLASS', 'S Class (30)', 1),
(891, 44, '300SD', ' - 300SD', 1),
(892, 44, '300SDL', ' - 300SDL', 1),
(893, 44, '300SE', ' - 300SE', 1),
(894, 44, '300SEL', ' - 300SEL', 1),
(895, 44, '350SD', ' - 350SD', 1),
(896, 44, '350SDL', ' - 350SDL', 1),
(897, 44, '380SE', ' - 380SE', 1),
(898, 44, '380SEC', ' - 380SEC', 1),
(899, 44, '380SEL', ' - 380SEL', 1),
(900, 44, '400SE', ' - 400SE', 1),
(901, 44, '400SEL', ' - 400SEL', 1),
(902, 44, '420SEL', ' - 420SEL', 1),
(903, 44, '500SEC', ' - 500SEC', 1),
(904, 44, '500SEL', ' - 500SEL', 1),
(905, 44, '560SEC', ' - 560SEC', 1),
(906, 44, '560SEL', ' - 560SEL', 1),
(907, 44, '600SEC', ' - 600SEC', 1),
(908, 44, '600SEL', ' - 600SEL', 1),
(909, 44, 'S320', ' - S320', 1),
(910, 44, 'S350', ' - S350', 1),
(911, 44, 'S350BLUE', ' - S350 Bluetec', 1),
(912, 44, 'S400HY', ' - S400 Hybrid', 1),
(913, 44, 'S420', ' - S420', 1),
(914, 44, 'S430', ' - S430', 1),
(915, 44, 'S500', ' - S500', 1),
(916, 44, 'S550', ' - S550', 1),
(917, 44, 'S55AMG', ' - S55 AMG', 1),
(918, 44, 'S600', ' - S600', 1),
(919, 44, 'S63AMG', ' - S63 AMG', 1),
(920, 44, 'S65AMG', ' - S65 AMG', 1),
(921, 44, 'SL_CLASS', 'SL Class (13)', 1),
(922, 44, '300SL', ' - 300SL', 1),
(923, 44, '380SL', ' - 380SL', 1),
(924, 44, '380SLC', ' - 380SLC', 1),
(925, 44, '500SL', ' - 500SL', 1),
(926, 44, '560SL', ' - 560SL', 1),
(927, 44, '600SL', ' - 600SL', 1),
(928, 44, 'SL320', ' - SL320', 1),
(929, 44, 'SL500', ' - SL500', 1),
(930, 44, 'SL550', ' - SL550', 1),
(931, 44, 'SL55AMG', ' - SL55 AMG', 1),
(932, 44, 'SL600', ' - SL600', 1),
(933, 44, 'SL63AMG', ' - SL63 AMG', 1),
(934, 44, 'SL65AMG', ' - SL65 AMG', 1),
(935, 44, 'SLK_CLASS', 'SLK Class (8)', 1),
(936, 44, 'SLK230', ' - SLK230', 1),
(937, 44, 'SLK250', ' - SLK250', 1),
(938, 44, 'SLK280', ' - SLK280', 1),
(939, 44, 'SLK300', ' - SLK300', 1),
(940, 44, 'SLK320', ' - SLK320', 1),
(941, 44, 'SLK32AMG', ' - SLK32 AMG', 1),
(942, 44, 'SLK350', ' - SLK350', 1),
(943, 44, 'SLK55AMG', ' - SLK55 AMG', 1),
(944, 44, 'SLR_CLASS', 'SLR Class (1)', 1),
(945, 44, 'SLR', ' - SLR', 1),
(946, 44, 'SLS_CLASS', 'SLS Class (1)', 1),
(947, 44, 'SLSAMG', ' - SLS AMG', 1),
(948, 44, 'SPRINTER_CLASS', 'Sprinter Class (1)', 1),
(949, 44, 'MBSPRINTER', ' - Sprinter', 1),
(950, 44, 'MBOTH', 'Other Mercedes-Benz Models', 1),
(951, 45, 'CAPRI', 'Capri', 1),
(952, 45, 'COUGAR', 'Cougar', 1),
(953, 45, 'MERCGRAND', 'Grand Marquis', 1),
(954, 45, 'LYNX', 'Lynx', 1),
(955, 45, 'MARAUDER', 'Marauder', 1),
(956, 45, 'MARINER', 'Mariner', 1),
(957, 45, 'MARQ', 'Marquis', 1),
(958, 45, 'MILAN', 'Milan', 1),
(959, 45, 'MONTEGO', 'Montego', 1),
(960, 45, 'MONTEREY', 'Monterey', 1),
(961, 45, 'MOUNTA', 'Mountaineer', 1),
(962, 45, 'MYSTIQ', 'Mystique', 1),
(963, 45, 'SABLE', 'Sable', 1),
(964, 45, 'TOPAZ', 'Topaz', 1),
(965, 45, 'TRACER', 'Tracer', 1),
(966, 45, 'VILLA', 'Villager', 1),
(967, 45, 'MERCZEP', 'Zephyr', 1),
(968, 45, 'MEOTH', 'Other Mercury Models', 1),
(969, 46, 'SCORP', 'Scorpio', 1),
(970, 46, 'XR4TI', 'XR4Ti', 1),
(971, 46, 'MEROTH', 'Other Merkur Models', 1),
(972, 47, 'COOPRCLUB_MODELS', 'Cooper Clubman Models (2)', 1),
(973, 47, 'COOPERCLUB', ' - Cooper Clubman', 1),
(974, 47, 'COOPRCLUBS', ' - Cooper S Clubman', 1),
(975, 47, 'COOPCOUNTRY_MODELS', 'Cooper Countryman Models (2)', 1),
(976, 47, 'COUNTRYMAN', ' - Cooper Countryman', 1),
(977, 47, 'COUNTRYMNS', ' - Cooper S Countryman', 1),
(978, 47, 'COOPCOUP_MODELS', 'Cooper Coupe Models (2)', 1),
(979, 47, 'MINICOUPE', ' - Cooper Coupe', 1),
(980, 47, 'MINISCOUPE', ' - Cooper S Coupe', 1),
(981, 47, 'COOPER_MODELS', 'Cooper Models (2)', 1),
(982, 47, 'COOPER', ' - Cooper', 1),
(983, 47, 'COOPERS', ' - Cooper S', 1),
(984, 47, 'COOPRROAD_MODELS', 'Cooper Roadster Models (2)', 1),
(985, 47, 'COOPERROAD', ' - Cooper Roadster', 1),
(986, 47, 'COOPERSRD', ' - Cooper S Roadster', 1),
(987, 48, '3000GT', '3000GT', 1),
(988, 48, 'CORD', 'Cordia', 1),
(989, 48, 'DIAMAN', 'Diamante', 1),
(990, 48, 'ECLIP', 'Eclipse', 1),
(991, 48, 'ENDEAVOR', 'Endeavor', 1),
(992, 48, 'MITEXP', 'Expo', 1),
(993, 48, 'GALANT', 'Galant', 1),
(994, 48, 'MITI', 'i', 1),
(995, 48, 'LANCERMITS', 'Lancer', 1),
(996, 48, 'LANCEREVO', 'Lancer Evolution', 1),
(997, 48, 'MITPU', 'Mighty Max', 1),
(998, 48, 'MIRAGE', 'Mirage', 1),
(999, 48, 'MONT', 'Montero', 1),
(1000, 48, 'MONTSPORT', 'Montero Sport', 1),
(1001, 48, 'OUTLANDER', 'Outlander', 1),
(1002, 48, 'OUTLANDSPT', 'Outlander Sport', 1),
(1003, 48, 'PRECIS', 'Precis', 1),
(1004, 48, 'RAIDERMITS', 'Raider', 1),
(1005, 48, 'SIGMA', 'Sigma', 1),
(1006, 48, 'MITSTAR', 'Starion', 1),
(1007, 48, 'TRED', 'Tredia', 1),
(1008, 48, 'MITVAN', 'Van', 1),
(1009, 48, 'MITOTH', 'Other Mitsubishi Models', 1),
(1010, 49, 'NIS200SX', '200SX', 1),
(1011, 49, '240SX', '240SX', 1),
(1012, 49, '300ZXTURBO', '300ZX', 1),
(1013, 49, '350Z', '350Z', 1),
(1014, 49, '370Z', '370Z', 1),
(1015, 49, 'ALTIMA', 'Altima', 1),
(1016, 49, 'PATHARMADA', 'Armada', 1),
(1017, 49, 'AXXESS', 'Axxess', 1),
(1018, 49, 'CUBE', 'Cube', 1),
(1019, 49, 'FRONTI', 'Frontier', 1),
(1020, 49, 'GT-R', 'GT-R', 1),
(1021, 49, 'JUKE', 'Juke', 1),
(1022, 49, 'LEAF', 'Leaf', 1),
(1023, 49, 'MAX', 'Maxima', 1),
(1024, 49, 'MURANO', 'Murano', 1),
(1025, 49, 'MURANOCROS', 'Murano CrossCabriolet', 1),
(1026, 49, 'NV', 'NV', 1),
(1027, 49, 'NX', 'NX', 1),
(1028, 49, 'PATH', 'Pathfinder', 1),
(1029, 49, 'NISPU', 'Pickup', 1),
(1030, 49, 'PULSAR', 'Pulsar', 1),
(1031, 49, 'QUEST', 'Quest', 1),
(1032, 49, 'ROGUE', 'Rogue', 1),
(1033, 49, 'SENTRA', 'Sentra', 1),
(1034, 49, 'STANZA', 'Stanza', 1),
(1035, 49, 'TITAN', 'Titan', 1),
(1036, 49, 'NISVAN', 'Van', 1),
(1037, 49, 'VERSA', 'Versa', 1),
(1038, 49, 'XTERRA', 'Xterra', 1),
(1039, 49, 'NISSOTH', 'Other Nissan Models', 1),
(1040, 50, '88', '88', 1),
(1041, 50, 'ACHIEV', 'Achieva', 1),
(1042, 50, 'ALERO', 'Alero', 1),
(1043, 50, 'AURORA', 'Aurora', 1),
(1044, 50, 'BRAV', 'Bravada', 1),
(1045, 50, 'CUCR', 'Custom Cruiser', 1),
(1046, 50, 'OLDCUS', 'Cutlass', 1),
(1047, 50, 'OLDCALAIS', 'Cutlass Calais', 1),
(1048, 50, 'CIERA', 'Cutlass Ciera', 1),
(1049, 50, 'CSUPR', 'Cutlass Supreme', 1),
(1050, 50, 'OLDSFIR', 'Firenza', 1),
(1051, 50, 'INTRIG', 'Intrigue', 1),
(1052, 50, '98', 'Ninety-Eight', 1),
(1053, 50, 'OMEG', 'Omega', 1),
(1054, 50, 'REGEN', 'Regency', 1),
(1055, 50, 'SILHO', 'Silhouette', 1),
(1056, 50, 'TORO', 'Toronado', 1),
(1057, 50, 'OLDOTH', 'Other Oldsmobile Models', 1),
(1058, 51, '405', '405', 1),
(1059, 51, '504', '504', 1),
(1060, 51, '505', '505', 1),
(1061, 51, '604', '604', 1),
(1062, 51, 'UNAVAILPEU', 'Other Peugeot Models', 1),
(1063, 52, 'ACC', 'Acclaim', 1),
(1064, 52, 'ARROW', 'Arrow', 1),
(1065, 52, 'BREEZE', 'Breeze', 1),
(1066, 52, 'CARAVE', 'Caravelle', 1),
(1067, 52, 'CHAMP', 'Champ', 1),
(1068, 52, 'COLT', 'Colt', 1),
(1069, 52, 'PLYMCONQ', 'Conquest', 1),
(1070, 52, 'GRANFURY', 'Gran Fury', 1),
(1071, 52, 'PLYMGRANV', 'Grand Voyager', 1),
(1072, 52, 'HORI', 'Horizon', 1),
(1073, 52, 'LASER', 'Laser', 1),
(1074, 52, 'NEON', 'Neon', 1),
(1075, 52, 'PROWLE', 'Prowler', 1),
(1076, 52, 'RELI', 'Reliant', 1),
(1077, 52, 'SAPPOROPLY', 'Sapporo', 1),
(1078, 52, 'SCAMP', 'Scamp', 1),
(1079, 52, 'SUNDAN', 'Sundance', 1),
(1080, 52, 'TRAILDUST', 'Trailduster', 1),
(1081, 52, 'VOYA', 'Voyager', 1),
(1082, 52, 'PLYOTH', 'Other Plymouth Models', 1),
(1083, 53, 'T-1000', '1000', 1),
(1084, 53, '6000', '6000', 1),
(1085, 53, 'AZTEK', 'Aztek', 1),
(1086, 53, 'BON', 'Bonneville', 1),
(1087, 53, 'CATALINA', 'Catalina', 1),
(1088, 53, 'FIERO', 'Fiero', 1),
(1089, 53, 'FBIRD', 'Firebird', 1),
(1090, 53, 'G3', 'G3', 1),
(1091, 53, 'G5', 'G5', 1),
(1092, 53, 'G6', 'G6', 1),
(1093, 53, 'G8', 'G8', 1),
(1094, 53, 'GRNDAM', 'Grand Am', 1),
(1095, 53, 'GP', 'Grand Prix', 1),
(1096, 53, 'GTO', 'GTO', 1),
(1097, 53, 'J2000', 'J2000', 1),
(1098, 53, 'LEMANS', 'Le Mans', 1),
(1099, 53, 'MONTANA', 'Montana', 1),
(1100, 53, 'PARISI', 'Parisienne', 1),
(1101, 53, 'PHOENIX', 'Phoenix', 1),
(1102, 53, 'SAFARIPONT', 'Safari', 1),
(1103, 53, 'SOLSTICE', 'Solstice', 1),
(1104, 53, 'SUNBIR', 'Sunbird', 1),
(1105, 53, 'SUNFIR', 'Sunfire', 1),
(1106, 53, 'TORRENT', 'Torrent', 1),
(1107, 53, 'TS', 'Trans Sport', 1),
(1108, 53, 'VIBE', 'Vibe', 1),
(1109, 53, 'PONOTH', 'Other Pontiac Models', 1),
(1110, 54, '911', '911', 1),
(1111, 54, '924', '924', 1),
(1112, 54, '928', '928', 1),
(1113, 54, '944', '944', 1),
(1114, 54, '968', '968', 1),
(1115, 54, 'BOXSTE', 'Boxster', 1),
(1116, 54, 'CARRERAGT', 'Carrera GT', 1),
(1117, 54, 'CAYENNE', 'Cayenne', 1),
(1118, 54, 'CAYMAN', 'Cayman', 1),
(1119, 54, 'PANAMERA', 'Panamera', 1),
(1120, 54, 'POROTH', 'Other Porsche Models', 1),
(1121, 55, 'RAM1504WD', '1500', 1),
(1122, 55, 'RAM25002WD', '2500', 1),
(1123, 55, 'RAM3502WD', '3500', 1),
(1124, 55, 'RAM4500', '4500', 1),
(1125, 56, '18I', '18i', 1),
(1126, 56, 'FU', 'Fuego', 1),
(1127, 56, 'LECAR', 'Le Car', 1),
(1128, 56, 'R18', 'R18', 1),
(1129, 56, 'RENSPORT', 'Sportwagon', 1),
(1130, 56, 'UNAVAILREN', 'Other Renault Models', 1),
(1131, 57, 'CAMAR', 'Camargue', 1),
(1132, 57, 'CORN', 'Corniche', 1),
(1133, 57, 'GHOST', 'Ghost', 1),
(1134, 57, 'PARKWARD', 'Park Ward', 1),
(1135, 57, 'PHANT', 'Phantom', 1),
(1136, 57, 'DAWN', 'Silver Dawn', 1),
(1137, 57, 'SILSERAPH', 'Silver Seraph', 1),
(1138, 57, 'RRSPIR', 'Silver Spirit', 1),
(1139, 57, 'SPUR', 'Silver Spur', 1),
(1140, 57, 'UNAVAILRR', 'Other Rolls-Royce Models', 1),
(1141, 58, '9-2X', '9-2X', 1),
(1142, 58, '9-3', '9-3', 1),
(1143, 58, '9-4X', '9-4X', 1),
(1144, 58, '9-5', '9-5', 1),
(1145, 58, '97X', '9-7X', 1),
(1146, 58, '900', '900', 1),
(1147, 58, '9000', '9000', 1),
(1148, 58, 'SAOTH', 'Other Saab Models', 1),
(1149, 59, 'ASTRA', 'Astra', 1),
(1150, 59, 'AURA', 'Aura', 1),
(1151, 59, 'ION', 'ION', 1),
(1152, 59, 'L_SERIES', 'L Series (3)', 1),
(1153, 59, 'L100', ' - L100', 1),
(1154, 59, 'L200', ' - L200', 1),
(1155, 59, 'L300', ' - L300', 1),
(1156, 59, 'LSSATURN', 'LS', 1),
(1157, 59, 'LW_SERIES', 'LW Series (4)', 1),
(1158, 59, 'LW', ' - LW1', 1),
(1159, 59, 'LW2', ' - LW2', 1),
(1160, 59, 'LW200', ' - LW200', 1),
(1161, 59, 'LW300', ' - LW300', 1),
(1162, 59, 'OUTLOOK', 'Outlook', 1),
(1163, 59, 'RELAY', 'Relay', 1),
(1164, 59, 'SC_SERIES', 'SC Series (2)', 1),
(1165, 59, 'SC1', ' - SC1', 1),
(1166, 59, 'SC2', ' - SC2', 1),
(1167, 59, 'SKY', 'Sky', 1),
(1168, 59, 'SL_SERIES', 'SL Series (3)', 1),
(1169, 59, 'SL', ' - SL', 1),
(1170, 59, 'SL1', ' - SL1', 1),
(1171, 59, 'SL2', ' - SL2', 1),
(1172, 59, 'SW_SERIES', 'SW Series (2)', 1),
(1173, 59, 'SW1', ' - SW1', 1),
(1174, 59, 'SW2', ' - SW2', 1),
(1175, 59, 'VUE', 'Vue', 1),
(1176, 59, 'SATOTH', 'Other Saturn Models', 1),
(1177, 60, 'SCIFRS', 'FR-S', 1),
(1178, 60, 'IQ', 'iQ', 1),
(1179, 60, 'TC', 'tC', 1),
(1180, 60, 'XA', 'xA', 1),
(1181, 60, 'XB', 'xB', 1),
(1182, 60, 'XD', 'xD', 1),
(1183, 61, 'FORTWO', 'fortwo', 1),
(1184, 61, 'SMOTH', 'Other smart Models', 1),
(1185, 62, 'SRTVIPER', 'Viper', 1),
(1186, 63, '825', '825', 1),
(1187, 63, '827', '827', 1),
(1188, 63, 'UNAVAILSTE', 'Other Sterling Models', 1),
(1189, 64, 'BAJA', 'Baja', 1),
(1190, 64, 'BRAT', 'Brat', 1),
(1191, 64, 'SUBBRZ', 'BRZ', 1),
(1192, 64, 'FOREST', 'Forester', 1),
(1193, 64, 'IMPREZ', 'Impreza', 1),
(1194, 64, 'IMPWRX', 'Impreza WRX', 1),
(1195, 64, 'JUSTY', 'Justy', 1),
(1196, 64, 'SUBL', 'L Series', 1),
(1197, 64, 'LEGACY', 'Legacy', 1),
(1198, 64, 'LOYALE', 'Loyale', 1),
(1199, 64, 'SUBOUTBK', 'Outback', 1),
(1200, 64, 'SVX', 'SVX', 1),
(1201, 64, 'B9TRIBECA', 'Tribeca', 1),
(1202, 64, 'XT', 'XT', 1),
(1203, 64, 'XVCRSSTREK', 'XV Crosstrek', 1),
(1204, 64, 'SUBOTH', 'Other Subaru Models', 1),
(1205, 65, 'AERIO', 'Aerio', 1),
(1206, 65, 'EQUATOR', 'Equator', 1),
(1207, 65, 'ESTEEM', 'Esteem', 1),
(1208, 65, 'FORENZA', 'Forenza', 1),
(1209, 65, 'GRANDV', 'Grand Vitara', 1),
(1210, 65, 'KIZASHI', 'Kizashi', 1),
(1211, 65, 'RENO', 'Reno', 1),
(1212, 65, 'SAMUR', 'Samurai', 1),
(1213, 65, 'SIDE', 'Sidekick', 1),
(1214, 65, 'SWIFT', 'Swift', 1),
(1215, 65, 'SX4', 'SX4', 1),
(1216, 65, 'VERONA', 'Verona', 1),
(1217, 65, 'VITARA', 'Vitara', 1),
(1218, 65, 'X90', 'X-90', 1),
(1219, 65, 'XL7', 'XL7', 1),
(1220, 65, 'SUZOTH', 'Other Suzuki Models', 1),
(1221, 66, 'ROADSTER', 'Roadster', 1),
(1222, 67, '4RUN', '4Runner', 1),
(1223, 67, 'AVALON', 'Avalon', 1),
(1224, 67, 'CAMRY', 'Camry', 1),
(1225, 67, 'CELICA', 'Celica', 1),
(1226, 67, 'COROL', 'Corolla', 1),
(1227, 67, 'CORONA', 'Corona', 1),
(1228, 67, 'CRESS', 'Cressida', 1),
(1229, 67, 'ECHO', 'Echo', 1),
(1230, 67, 'FJCRUIS', 'FJ Cruiser', 1),
(1231, 67, 'HIGHLANDER', 'Highlander', 1),
(1232, 67, 'LC', 'Land Cruiser', 1),
(1233, 67, 'MATRIX', 'Matrix', 1),
(1234, 67, 'MR2', 'MR2', 1),
(1235, 67, 'MR2SPYDR', 'MR2 Spyder', 1),
(1236, 67, 'PASEO', 'Paseo', 1),
(1237, 67, 'PICKUP', 'Pickup', 1),
(1238, 67, 'PREVIA', 'Previa', 1),
(1239, 67, 'PRIUS', 'Prius', 1),
(1240, 67, 'PRIUSC', 'Prius C', 1),
(1241, 67, 'PRIUSV', 'Prius V', 1),
(1242, 67, 'RAV4', 'RAV4', 1),
(1243, 67, 'SEQUOIA', 'Sequoia', 1),
(1244, 67, 'SIENNA', 'Sienna', 1),
(1245, 67, 'SOLARA', 'Solara', 1),
(1246, 67, 'STARLET', 'Starlet', 1),
(1247, 67, 'SUPRA', 'Supra', 1),
(1248, 67, 'T100', 'T100', 1),
(1249, 67, 'TACOMA', 'Tacoma', 1),
(1250, 67, 'TERCEL', 'Tercel', 1),
(1251, 67, 'TUNDRA', 'Tundra', 1),
(1252, 67, 'TOYVAN', 'Van', 1),
(1253, 67, 'VENZA', 'Venza', 1),
(1254, 67, 'YARIS', 'Yaris', 1),
(1255, 67, 'TOYOTH', 'Other Toyota Models', 1),
(1256, 68, 'TR7', 'TR7', 1),
(1257, 68, 'TR8', 'TR8', 1),
(1258, 68, 'TRIOTH', 'Other Triumph Models', 1),
(1259, 69, 'BEETLE', 'Beetle', 1),
(1260, 69, 'VOLKSCAB', 'Cabrio', 1),
(1261, 69, 'CAB', 'Cabriolet', 1),
(1262, 69, 'CC', 'CC', 1),
(1263, 69, 'CORR', 'Corrado', 1),
(1264, 69, 'DASHER', 'Dasher', 1),
(1265, 69, 'EOS', 'Eos', 1),
(1266, 69, 'EUROVAN', 'Eurovan', 1),
(1267, 69, 'VOLKSFOX', 'Fox', 1),
(1268, 69, 'GLI', 'GLI', 1),
(1269, 69, 'GOLFR', 'Golf R', 1),
(1270, 69, 'GTI', 'GTI', 1),
(1271, 69, 'GOLFANDRABBITMODELS', 'Golf and Rabbit Models (2)', 1),
(1272, 69, 'GOLF', ' - Golf', 1),
(1273, 69, 'RABBIT', ' - Rabbit', 1),
(1274, 69, 'JET', 'Jetta', 1),
(1275, 69, 'PASS', 'Passat', 1),
(1276, 69, 'PHAETON', 'Phaeton', 1),
(1277, 69, 'RABBITPU', 'Pickup', 1),
(1278, 69, 'QUAN', 'Quantum', 1),
(1279, 69, 'R32', 'R32', 1),
(1280, 69, 'ROUTAN', 'Routan', 1),
(1281, 69, 'SCIR', 'Scirocco', 1),
(1282, 69, 'TIGUAN', 'Tiguan', 1),
(1283, 69, 'TOUAREG', 'Touareg', 1),
(1284, 69, 'VANAG', 'Vanagon', 1),
(1285, 69, 'VWOTH', 'Other Volkswagen Models', 1),
(1286, 70, '240', '240', 1),
(1287, 70, '260', '260', 1),
(1288, 70, '740', '740', 1),
(1289, 70, '760', '760', 1),
(1290, 70, '780', '780', 1),
(1291, 70, '850', '850', 1),
(1292, 70, '940', '940', 1),
(1293, 70, '960', '960', 1),
(1294, 70, 'C30', 'C30', 1),
(1295, 70, 'C70', 'C70', 1),
(1296, 70, 'S40', 'S40', 1),
(1297, 70, 'S60', 'S60', 1),
(1298, 70, 'S70', 'S70', 1),
(1299, 70, 'S80', 'S80', 1),
(1300, 70, 'S90', 'S90', 1),
(1301, 70, 'V40', 'V40', 1),
(1302, 70, 'V50', 'V50', 1),
(1303, 70, 'V70', 'V70', 1),
(1304, 70, 'V90', 'V90', 1),
(1305, 70, 'XC60', 'XC60', 1),
(1306, 70, 'XC', 'XC70', 1),
(1307, 70, 'XC90', 'XC90', 1),
(1308, 70, 'VOLOTH', 'Other Volvo Models', 1),
(1309, 71, 'GV', 'GV', 1),
(1310, 71, 'GVC', 'GVC', 1),
(1311, 71, 'GVL', 'GVL', 1),
(1312, 71, 'GVS', 'GVS', 1),
(1313, 71, 'GVX', 'GVX', 1),
(1314, 71, 'YUOTH', 'Other Yugo Models', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicle_type`
--

DROP TABLE IF EXISTS `vehicle_type`;
CREATE TABLE IF NOT EXISTS `vehicle_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_Vehicle_Type_Label` (`label`),
  KEY `IDX_Vehicle_Type_Description` (`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `city`
--
ALTER TABLE `city` ADD FULLTEXT KEY `FT_City_Alternate_Names` (`alternatenames`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq` ADD FULLTEXT KEY `FT_FAQ_Question` (`question`);
ALTER TABLE `faq` ADD FULLTEXT KEY `FT_FAQ_Answer` (`answer`);

--
-- Index pour la table `log`
--
ALTER TABLE `log` ADD FULLTEXT KEY `FT_Log_Context` (`context`);

--
-- Index pour la table `message`
--
ALTER TABLE `message` ADD FULLTEXT KEY `FT_Message_Content` (`content`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification` ADD FULLTEXT KEY `FT_Notification_Content` (`content`);

--
-- Index pour la table `page`
--
ALTER TABLE `page` ADD FULLTEXT KEY `FT_Page_Content` (`content`);

--
-- Index pour la table `page_category`
--
ALTER TABLE `page_category` ADD FULLTEXT KEY `FT_Page_Category_Description` (`description`);

--
-- Index pour la table `ride_comment`
--
ALTER TABLE `ride_comment` ADD FULLTEXT KEY `FT_Ride_Comment_Content` (`content`);

--
-- Index pour la table `user`
--
ALTER TABLE `user` ADD FULLTEXT KEY `FT_User_Biography` (`biography`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_User_Country_ID` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `FK_User_Identification_Type_ID` FOREIGN KEY (`identification_type_id`) REFERENCES `identification_type` (`id`),
  ADD CONSTRAINT `FK_User_Language_ID` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `FK_User_Sexe_ID` FOREIGN KEY (`sexe_id`) REFERENCES `sexe` (`id`),
  ADD CONSTRAINT `FK_User_Status_ID` FOREIGN KEY (`user_status_id`) REFERENCES `user_status` (`id`),
  ADD CONSTRAINT `FK_User_Town_ID` FOREIGN KEY (`town_id`) REFERENCES `town` (`id`),
  ADD CONSTRAINT `FK_User_Type_ID` FOREIGN KEY (`user_status_id`) REFERENCES `user_status` (`id`);

--
-- Contraintes pour la table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `FK_Vehicule_Brand` FOREIGN KEY (`vehicle_brand_id`) REFERENCES `vehicle_brand` (`id`),
  ADD CONSTRAINT `FK_Vehicule_Country` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `FK_Vehicule_Model` FOREIGN KEY (`vehicle_model_id`) REFERENCES `vehicle_model` (`id`),
  ADD CONSTRAINT `FK_Vehicule_Owner` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
