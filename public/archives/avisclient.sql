
-- --------------------------------------------------------

--
-- Structure de la table `avisclient`
--

CREATE TABLE `avisclient` (
  `idpost` int(11) NOT NULL, AUTO_INCREMENT,
  `pseudopost` varchar(250) DEFAULT NULL,
  `mailpost` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `datepost` bigint(15) NOT NULL,
  `idproduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `avisclient`
--

INSERT INTO `avisclient` (`idpost`, `pseudopost`, `mailpost`, `content`, `datepost`, `idproduit`) VALUES
(1, 'joezer42', 'joezerbouraima@yahoo.fr', 'superbe robe', 0, 3),
(2, 'totorato', 'joezer@together.com', 'shshrh', 1466673655, 3),
(3, 'totorato', 'rent@benin.com', 'totorato approuve beaucoup cette robe', 1466674699, 3),
(4, 'Anonyme', 'kaffojamaldineishola@yahoo.fr', 'sddd sgsergsg sgsgs dgsgsg', 1466679289, 3),
(5, '  ', 'jbouraima@karthsolutions.com', 'ddfb sssbd bb bsbsb', 1466679520, 23),
(6, '    ', 'kaffojamaldineishola@yahoo.fr', '  desolz', 1466679641, 23);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `avisclient`
--
ALTER TABLE `avisclient`
  ADD PRIMARY KEY (`idpost`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `avisclient`
--
ALTER TABLE `avisclient`
  MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
