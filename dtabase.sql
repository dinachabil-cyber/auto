
CREATE TABLE `professionel` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `product` varchar(50) DEFAULT NULL,
  `demarrage` varchar(255) DEFAULT NULL,
  `raison_sociale` varchar(255) DEFAULT NULL,
  `activite` varchar(255) DEFAULT NULL,
  `assure` varchar(255) DEFAULT NULL,
  `code_postal` varchar(255) DEFAULT NULL,
  `ancienne` varchar(255) DEFAULT NULL,
  `motif` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `tele` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
